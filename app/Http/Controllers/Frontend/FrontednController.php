<?php

namespace App\Http\Controllers\Frontend;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Expertise;
use App\Models\Portfolio;
use App\Models\PortfolioBanner;

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
 * Show Portfolio Single Page
 */
    public function ShowSinglePortfolioPage($slug)
    {
      $portfolios = Portfolio::where('slug', $slug)->first();
      $port_page = Portfolio::latest()->where('trash', false)->get();
        return view('frontend.pages.portfolio_single',[
            'portfolios'    => $portfolios,
            'port_page'    => $port_page,
        ]);
    }
/**
 * Show Portfolio Page
 */
    public function ShowPortfolioPage()
    {
      $port_page = Portfolio::latest()->where('trash', false)->get();
      $banner = PortfolioBanner::latest()->where('trash', false)->where('status', true)->take(1)->get();
        return view('frontend.pages.portfolio',[
            'port_page'    => $port_page,
            'banner'        => $banner,
        ]);
    }

}
