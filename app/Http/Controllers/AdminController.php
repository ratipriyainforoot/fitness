<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function adminLogin(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $adminExists = Admin::where('email',$email)->exists();
        if($adminExists) {
            $admin = Admin::where('email',$email)->first();
            if($password == $admin->password) {
                session()->put('admin',$email);
                return redirect()->route('adminDashboard')
                ->with('success','Logged in successfully');
            }else {
                return redirect()->route('home')
                ->with('error','Password not match');
            }
        }else {
            return redirect()->route('home')
            ->with('error','Record Not Found');
        }
    }

    public function adminDashboard() {
        if(session()->has('admin')) {
            return view('adminDashboard');
        }else {
            return redirect()->route('home')
            ->with('error','Please login first');
        }
    }

    public function logout() {
        session()->flush();
        return redirect()->route('home')
        ->with('success','Logout successfully');
    }
}
