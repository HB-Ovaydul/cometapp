<?php

namespace App\Http\Controllers\Frontend;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expertise;

class FrontednController extends Controller
{
    /**
     * Show Home Page
     */
    public function ShowHomePage()
    {
        return view('frontend.pages.home');
    }
/**
 * Show Contact Page
 */
    public function ShowCntactPage()
    {
        return view('frontend.pages.contact');
    }

}
