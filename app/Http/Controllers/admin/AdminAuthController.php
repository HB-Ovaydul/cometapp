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

         return redirect()->route('show.deshboard');
       }else{
         return back()->with('danger', 'Login Failed!');
       }

    }
}
