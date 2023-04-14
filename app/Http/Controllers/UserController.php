<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Mail;
use Carbon\Carbon;

class UserController extends Controller
{
    public function allUsers() {
        if(session()->has('admin')) {
            $users = User::paginate(10);
            return view('allUsers')->with(compact('users'));
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        } 
    }
    
    public function MyProfile(Request $request) {
        $id = $request->user_id;
        $userExists = User::where('id',$id)->exists();
        if($userExists) {
            $users = User::where('id',$id)->first();
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'User details available',
                    'data' => $users
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'User details unavailable',
                    'data' => ''
                ]
            );
        }
        
    }
    
    public function ForgotPasword(Request $request) {
        $email = $request->email;
        $password_str = Str::random(10);
        $password = md5($password_str);
        $userExists = User::where('email',$email)->exists();
        if($userExists) {
            Mail::send('forget-password', ['password' => $password_str], function ($message) use($email) {
                $message->to($email,'Fitnessway')->subject('Reset Password');
                $message->from('ratipriya.inforoot@gmail.com');
            });
            User::where('email',$email)->update(
                [
                    'password' => $password
                ]
            );
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'New Password sent to your email',
                    'data' => $password_str
                ]
            );
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'email not registered',
                    'data' => ''
                ]
            );
        }
        
        
    }
    
    public function register(Request $request) {
        $fname = $request->fname;
        $lname = $request->lname;
        $email = $request->email;
        $mobile = $request->mobile;
        $country = $request->country;
        $dob = $request->dob;
        $gender = $request->gender;
        $password = $request->password;
        $userExists = User::where('email',$email)->exists();
        if($userExists) {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'Email Already Registered',
                    'data' => ''
                ]
            );
        }else {
            //$password = Str::random(10);
            $user = User::updateOrCreate(
                [
                    'email' => $email
                ],[
                    'fname' => $fname,
                    'lname' => $lname,
                    'dob' => $dob,
                    'email' => $email,
                    'mobile' => $mobile,
                    'country' => $country,
                    'password' => md5($password),
                    'gender' => $gender,
                    'dated' => Carbon::now('Asia/Kolkata')->format('Y-m-d')
                ]
            );
            return response()->json(
                [
                    'code' => 1,
                    'message' => 'Registration successfull',
                    'data' => $user,
                    'password' => $password
                ]
            );
        }
    }
    
    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $userExists = User::where('email',$email)->exists();
        if($userExists) {
            $user = User::where('email',$email)->first();
            if($user->password == md5($password)) {
                return response()->json(
                    [
                        'code' => 1,
                        'message' => 'Login successfully',
                        'data' => $user
                    ]
                ); 
            }else {
                return response()->json(
                    [
                        'code' => 0,
                        'message' => 'Password not matched',
                        'data' => ''
                    ]
                ); 
            }
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'Email Not Registered',
                    'data' => ''
                ]
            ); 
        }
    }
    

    public function editUser(Request $request)  {
        $id = $request->id;
        $fname = $request->fname;
        $lname = $request->lname;
        $dob = $request->dob;
        $email = $request->email;
        $mobile = $request->mobile;
        $gander = $request->gander;
        $country = $request->country;
        User::where('id',$id)
        ->update(
            [
                'fname' => $fname,
                'lname' => $lname,
                'dob' => $dob,
                'email' => $email,
                'mobile' => $mobile,
                'gender' => $gander,
                'country' => $country
            ]
        );
        return redirect()->route('all-users')
        ->with('success','User updated');
    }

    public function editProfile(Request $request)  {
        $id = $request->user_id;
        $fname = $request->fname;
        $lname = $request->lname;
        $dob = $request->dob;
        $email = $request->email;
        $mobile = $request->mobile;
        $gender = $request->gender;
        $country = $request->country;
        $data = User::where('id',$id)
        ->update(
            [
                'fname' => $fname,
                'lname' => $lname,
                'dob' => $dob,
                'email' => $email,
                'mobile' => $mobile,
                'gender' => $gender,
                'country' => $country
            ]
        );
        return response()->json(
            [
                'code' => 1,
                'message' => 'Profile Updated',
                'data' => $data
            ]
        );
    }

    public function changePassword(Request $request) {
        $old_password = $request->old_password;
        $password = $request->password;
        $rePassword = $request->rePassword;
        $user_id = $request->user_id;
        $user = User::where('id',$user_id)->first();
        if(md5($old_password) == $user->password) {
            if($password == $rePassword) {
                $data= User::where('id',$user_id)
                ->update(
                    [
                        'password' => md5($password)
                    ]
                );
                return response()->json(
                    [
                        'code' => 1,
                        'message' => 'Password changed',
                        'data' => $data
                    ]
                );
            }else {
                return response()->json(
                    [
                        'code' => 0,
                        'message' => 'Password and repeat password not match'
                    ]
                );
            }
        }else {
            return response()->json(
                [
                    'code' => 0,
                    'message' => 'Old password not match'
                ]
            );
        }
    }

    public function deleteUser(Request $request) {
        $id = $request->id;
        User::where('id',$id)->delete();
        return redirect()->route('all-users')
        ->with('success','User deleted');
    }
}
