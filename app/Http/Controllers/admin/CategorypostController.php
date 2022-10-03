<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategorypostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorypost = Categorypost::latest()->where('trash', false)->get();
        return view('admin.page.posts.category.index',[
            'form_type'     => 'create',
            'categorypost'  => $categorypost,
        ]);
    }

    /**
     * Post Category Trash Page 
     */
    public function CategorypostTrashPage()
    {
        $cat_post_trash = Categorypost::latest()->where('trash', true)->get();
        return view('admin.page.posts.category.trash',[
            'cat_post_trash'  => $cat_post_trash
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
        $this->validate($request,[
            'cname'     => 'required|unique:categoryposts'
        ]);

        // Data Store
        Categorypost::create([
            'cname'     => $request -> cname,
            'slug'     => Str::slug($request -> cname),
        ]);
        // Return back
        return back()->with('success', 'Category Created Successfull!');
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
        $categorypost = Categorypost::latest()->where('trash', false)->get();
        $edit_cat = Categorypost::findOrFail($id);
        return view('admin.page.posts.category.index',[
            'form_type'     => 'edit',
            'categorypost'  => $categorypost,
            'edit_cat'  => $edit_cat,
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

        // Validation
        // $this->validate($request,[
        //     'cname'     => 'required|unique:categoryposts'
        // ]);

        $cat_update = Categorypost::findOrFail($id);

        $cat_update -> update([
            'cname'     => $request -> cname,
            'slug'     => Str::slug($request -> cname),
        ]);

        // Return back
        return back()->with('success', 'Category Updated Successfull!');
    }

    /**
     *  Category Post Trash Update
     */
    public function categorypostupdate($id)
    {
        $update_trash = Categorypost::findOrFail($id);
       if($update_trash -> trash){
        $update_trash -> update([
            'trash'     => false,
            'status'     => true,
        ]);
        // Return back
        return back()->with('success-main', 'Data Restored!');
       }else{
        $update_trash -> update([
            'trash'     => true,
            'status'     => false,
        ]);
        // Return back
        return back()->with('danger-main', 'Data Move To Trash!');
       }
    }
    /**
     *  Category Post Status Update
     */
    public function categorypostStatusupdate($id)
    {
        $update_status = Categorypost::findOrFail($id);
       if($update_status -> status){
        $update_status -> update([
            'status'     => false,
        ]);
        // Return back
        return back()->with('danger-main', 'Blocked!');
    }else{
        $update_status -> update([
            'status'     => true,
        ]);
        // Return back
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
        $delete = Categorypost::findOrFail($id);
        $delete -> delete();
        return back()->with('danger-main', 'Data deleted!');
    }
}
