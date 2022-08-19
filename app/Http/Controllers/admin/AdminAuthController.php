<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Show Login Page
     */
    public function ShowAdminLoginPage()
    {
       return view('admin.page.login');
    }

    /**
     * Admin Login System
     */
    public function AdminLogin(Request $request)
    {
      // Validation
      $this->validate($request,[
         'auth' => 'required',
         'password' => 'required'
      ]);

       // Admin Login Process
       if(Auth::guard('admin')->attempt(['email' => $request -> auth, 'password' => $request -> password ]) || Auth::guard('admin')->attempt(['cell' => $request -> auth, 'password' => $request -> password ]) || Auth::guard('admin')->attempt(['username' => $request -> auth, 'password' => $request -> password ])){

        // Check Diseble Account
        if(Auth::guard('admin')->user()->status && Auth::guard('admin')->user()->trash == false){
          return redirect()->route('show.deshboard');
        }else{
          Auth::guard('admin')->logout();
          return redirect()->route('admin.login.page')->with('warning', 'Sorry! Your Are Blocked');
        }

       }else{
         return back()->with('danger', 'Login Failed!');
       }

    }

    /**
     *  Admin Logout
     */
    public function AdminLogout()
    {
      Auth::guard('admin')->logout();
      return redirect()->route('admin.login.page');
    }
}
