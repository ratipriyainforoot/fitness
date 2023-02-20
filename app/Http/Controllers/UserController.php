<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    public function deleteUser(Request $request) {
        $id = $request->id;
        User::where('id',$id)->delete();
        return redirect()->route('all-users')
        ->with('success','User deleted');
    }
}
