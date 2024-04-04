<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    function admin_login()
    {
        return view('admin.login');
    }


    // admin login

    function submit_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


        $checkUser = Admin::where(['username' => $request->username, 'password' => $request->password])->count();

        if ($checkUser > 0) {
            $adminData = Admin::where(['username' => $request->username, 'password' => $request->password])->first();
            session(['adminData' => $adminData]);
            return redirect('admin/dashboard')->with('message', 'Admin Login Successfully!!');
        } else {
            return redirect('admin/login')->with('error', 'Invalid crediential !!');
        }
    }


    function admin_dashboard()
    {
        return view('admin.dashboard');
    }

    public function admin_logout(){
        session()->forget(['adminData']);
        return redirect()->route('admin.login');
    }
}
