<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Tagproduct;
use Ramsey\Uuid\Type\Time;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Categoryproduct;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = Product::latest()->where('trash', false)->get();
       $products_cat = Categoryproduct::all();
       $products_tag = Tagproduct::all();
       $products_brand = Brand::all();
        return view('admin.page.products.index',[
            'form_type'     => 'create',
            'products'      => $products,
            'products_cat'  => $products_cat,
            'products_tag'  => $products_tag,
            'products_brand'  => $products_brand,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        // $this->validate($request,[
        //     'title'     => 'required',
        //     'photo'     => 'required',
        //     'gallery'     => 'required',
        // ]);
        
        // Photo Uploade
        if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/product_single/'.$file_name));
        }

        // Product Gallery image uploade
        $gellery = [];
        if($request -> hasFile('gallery')){
            $gell_image = $request -> file('gallery');
            foreach($gell_image as $gell){
                $gell_name = md5(time().rand()).'.'.$gell -> clientExtension();
                $gell_make = Image::make($gell -> getRealPath());
                $gell_make -> save(storage_path('app/public/product_gell/'.$gell_name));
                array_push($gellery, $gell_name);
            }
        }

        // Data Store
       $products = Product::create([
            'title'             => $request -> title,
            'slug'              => Str::slug($request -> title),
            'sort_des'          => $request -> sort_des,
            'long_des'          => $request -> des,
            'color'             => $request -> color,
            'size'              => $request -> size,
            'price'             => $request -> price,
            'regular_price'     => $request -> regular_price,
            'photo'             => $file_name ?? '',
            'gallery'           => json_encode($gellery),
        ]);

        $products -> Pro_cat() -> attach($request -> productcat);
        $products -> Pro_tag() -> attach($request -> product_tag);
        $products -> Pro_brand() -> attach($request -> product_brand);

        return back()->with('success','Product Added Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
