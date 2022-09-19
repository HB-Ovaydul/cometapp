<?php

namespace App\Http\Controllers\Frontend;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expertise;
use App\Models\Portfolio;

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
/**
 * Show About Page
 */
    public function ShowAboutPage()
    {
        return view('frontend.pages.about');
    }
/**
 * Show About Page
 */
    public function ShowSinglePortfolioPage($slug)
    {
      $portfolios = Portfolio::where('slug', $slug)->first();
        return view('frontend.pages.portfolio_single',[
            'portfolios'    => $portfolios,
        ]);
    }

}
