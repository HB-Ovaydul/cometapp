<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_product = Brand::latest()->where('trash', false)->get();
        return view('admin.page.products.brand.index',[
            'form_type'     => 'create',
            'brand_product'   => $brand_product,

        ]);
    }

    /**
     *  Product Trash Page
     */
    public function ProductBrandPage()
    {
        $product_trash = Brand::latest()->where('trash', true)->get();
        return view('admin.page.products.brand.trash',[
            'product_trash'   => $product_trash,

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
        // Validate
        $this->validate($request,[
            'bname' => 'required',
        ]);

        // Data Store
        Brand::create([
            'bname'     => $request -> bname,
            'slug'      => Str::slug($request -> bname),
        ]);

        return back()->with('success', 'Data Created Successful!');  
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
        $brand_product = Brand::latest()->where('trash', false)->get();
        $edit = Brand::findOrFail($id);
        return view('admin.page.products.brand.index',[
            'form_type'     => 'edit',
            'brand_product'   => $brand_product,
            'edit'          => $edit,

        ]);
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
        $brand_update = Brand::findOrFail($id);
        
        $brand_update -> update([
            'bname'     => $request -> bname,
            'slug'      => Str::slug($request -> bname),
        ]);

        return back()->with('success', 'Data Updated Successful!');
    }

    /**
     * Product Trash Update
     *
     */
    public function ProductBrandUpdate($id)
    {
       $product_brand_trash_update = Brand::findOrFail($id);
       if($product_brand_trash_update -> trash){
        $product_brand_trash_update -> update([
            'trash'     => false,
            'status'     => true,
        ]);
        return back()->with('success-main', 'Data Restored!');
       }else{
        $product_brand_trash_update -> update([
            'trash'     => true,
            'status'     => false,
        ]);
        return back()->with('danger-main', 'Data Move To Trash!');
       }
    }
    /**
     * Product Status Update
     *
     */
    public function productTagStatusUpdate($id)
    {
       $product_brand_satatus_update = Brand::findOrFail($id);
       if($product_brand_satatus_update -> status){
        $product_brand_satatus_update -> update([
            'status'     => false,
        ]);
        return back()->with('danger-main', 'Blocked!');
       }else{
        $product_brand_satatus_update -> update([
            'status'     => true,
        ]);
        return back()->with('success-main', 'Active!');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand_delete = Brand::findOrFail($id);
        $brand_delete -> delete();
        return back()-> with('success-main', 'Data Deleted Successful');
    }
}
