<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
