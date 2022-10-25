<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Categoryproduct;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat_product = Categoryproduct::latest()->where('trash', false)->get();
        return view('admin.page.products.category.index',[
            'form_type'     => 'create',
            'cat_product'   => $cat_product,

        ]);
    }

    /**
     *  Product Trash Page
     */
    public function ProductTrashPage()
    {
        $product_trash = Categoryproduct::latest()->where('trash', true)->get();
        return view('admin.page.products.category.trash',[
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
            'cname' => 'required',
        ]);

        // Data Store
        Categoryproduct::create([
            'cname'     => $request -> cname,
            'slug'      => Str::slug($request -> cname),
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
        $cat_product = Categoryproduct::latest()->where('trash', false)->get();
        $edit = Categoryproduct::findOrFail($id);
        return view('admin.page.products.category.index',[
            'form_type'     => 'edit',
            'cat_product'   => $cat_product,
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
        // Data Store

        $cat_update = Categoryproduct::findOrFail($id);
        
        $cat_update -> update([
            'cname'     => $request -> cname,
            'slug'      => Str::slug($request -> cname),
        ]);

        return back()->with('success', 'Data Updated Successful!');
    }

    /**
     * Product Trash Update
     *
     */
    public function productupdate($id)
    {
       $product_trash_update = Categoryproduct::findOrFail($id);
       if($product_trash_update -> trash){
        $product_trash_update -> update([
            'trash'     => false,
            'status'     => true,
        ]);
        return back()->with('success-main', 'Data Restored!');
       }else{
        $product_trash_update -> update([
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
    public function productStatusupdate($id)
    {
       $product_product_update = Categoryproduct::findOrFail($id);
       if($product_product_update -> status){
        $product_product_update -> update([
            'status'     => false,
        ]);
        return back()->with('danger-main', 'Blocked!');
       }else{
        $product_product_update -> update([
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
        //
    }
}
