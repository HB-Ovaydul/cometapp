<?php

namespace App\Http\Controllers\admin;

use App\Models\Tagproduct;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag_product = Tagproduct::latest()->where('trash', false)->get();
        return view('admin.page.products.tag.index',[
            'form_type'     => 'create',
            'tag_product'   => $tag_product,

        ]);
    }

    /**
     *  Product Trash Page
     */
    public function ProductTagTrashPage()
    {
        $product_trash = Tagproduct::latest()->where('trash', true)->get();
        return view('admin.page.products.tag.trash',[
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
            'tname' => 'required',
        ]);

        // Data Store
        Tagproduct::create([
            'tname'     => $request -> tname,
            'slug'      => Str::slug($request -> tname),
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
        $tag_product = Tagproduct::latest()->where('trash', false)->get();
        $edit = Tagproduct::findOrFail($id);
        return view('admin.page.products.tag.index',[
            'form_type'     => 'edit',
            'tag_product'   => $tag_product,
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
        $tag_update = Tagproduct::findOrFail($id);
        
        $tag_update -> update([
            'tname'     => $request -> tname,
            'slug'      => Str::slug($request -> tname),
        ]);

        return back()->with('success', 'Data Updated Successful!');
    }

    
    /**
     * Product Trash Update
     *
     */
    public function ProductTagupdate($id)
    {
       $product_tag_trash_update = Tagproduct::findOrFail($id);
       if($product_tag_trash_update -> trash){
        $product_tag_trash_update -> update([
            'trash'     => false,
            'status'     => true,
        ]);
        return back()->with('success-main', 'Data Restored!');
       }else{
        $product_tag_trash_update -> update([
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
       $product_tag_satatus_update = Tagproduct::findOrFail($id);
       if($product_tag_satatus_update -> status){
        $product_tag_satatus_update -> update([
            'status'     => false,
        ]);
        return back()->with('danger-main', 'Blocked!');
       }else{
        $product_tag_satatus_update -> update([
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
        $delete = Tagproduct::findOrFail($id);
        $delete -> delete();
        return back()-> with('success-main', 'Data Deleted Successful');
        
    }
}
