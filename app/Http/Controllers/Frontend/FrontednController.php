<?php

namespace App\Http\Controllers\Frontend;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Categorypost;
use App\Models\Categoryproduct;
use App\Models\Comment;
use App\Models\Expertise;
use App\Models\Portfolio;
use App\Models\PortfolioBanner;
use App\Models\Post;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Tagproduct;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

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
/**
 * Show Blog Page
 */
    public function ShowBlogPage()
    {
      $post_page = Post::latest()->where('trash', false)->get();
        return view('frontend.pages.blog',[
            'all_post_page'    => $post_page,
        ]);
    }
/**
 * Search Post
 */
    public function ShowCategoryBySlugPage($slug)
    {
      $category = Categorypost::where('slug', $slug)->first();
      $post_page = $category -> catposts;
      return view('frontend.pages.blog',[
        'all_post_page'    => $post_page,
    ]);
    }
/**
 * Search Post
 */
    public function searchByTagPost($slug)
    {
       $tag = Tag::where('slug', $slug)->first();
       $tags = $tag -> posts;
       return view('frontend.pages.blog',[
        'all_post_page'    => $tags,
    ]);
    }

    /**
     *  Show Single Blog page
     */
    public function ShowSingleblog($slug)
    {
       $post_page = Post::where('slug', $slug)->first();
        return view('frontend.pages.blog-single',[
            'post_page'       => $post_page,
        ]);
    }
    
    /**
     * Product Page
     */
    public function ShowProductPage()
    {
        $all_product = Product::latest()->where('trash', false)->get();
       return view('frontend.pages.product-page',[
        'all_product'       => $all_product,
       ]); 
    }

    /**
     *  Product Search By Category
     */
    public function ProductSearchByCategory($slug)
    {
        $all_product = Categoryproduct::where('slug', $slug)->first();
        $cat_pros = $all_product -> cat_products;
        return view('frontend.pages.product-page',[
            'all_product' => $cat_pros,
        ]);
    }

    /**
     *  Product Search By Tag
     */
    public function ProductSearchBytag($slug)
    {
        $all_product = Tagproduct::where('slug', $slug)->first();
        $tag_products = $all_product -> tagproduct;
        return view('frontend.pages.product-page',[
            'all_product' => $tag_products,
        ]);
    }
    /**
     *  Product Search By Brand
     */
    public function ProductSearchByBrand($slug)
    {
        $all_product = Brand::where('slug', $slug)->first();
        $brand_products = $all_product -> brand_product;
        return view('frontend.pages.product-page',[
            'all_product' => $brand_products,
        ]);
    }

    /**
     * Show Single Product Page
     */
    public function SingleProduct($slug)
    {
        $all_products = Product::where('slug', $slug)->first();
        // $releted = Product::where('categoryproduct_id', $slug)->get();
        return view('frontend.pages.single-product',[
            'all_product'       => $all_products,
            // 'releted'       => $releted,
        ]);
    }

// categoryproduct_id
}


            

            