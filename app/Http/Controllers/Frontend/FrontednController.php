<?php

namespace App\Http\Controllers\Frontend;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontednController extends Controller
{
    /**
     * Show Home Page
     */
    public function ShowHomePage()
    {
        return view('frontend.pages.home');
    }

}
