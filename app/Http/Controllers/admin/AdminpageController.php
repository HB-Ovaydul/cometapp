<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminpageController extends Controller
{
    /**
     * Show Admin Deshboard page
     */
    public function ShowDeshboardPage()
    {
        return view('admin.page.deshboard');
    }
}
