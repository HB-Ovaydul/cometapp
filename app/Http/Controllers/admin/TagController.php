<?php

namespace App\Http\Controllers\admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psy\CodeCleaner\ReturnTypePass;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_tag = Tag::latest()->where('trash', false)->get();
        return view('admin.page.posts.tag.index',[
            'form_type'     => 'create',
            'post_tag'  => $post_tag,
        ]);
    }

    /**
     * Post Tag Trash Page 
     */
    public function TagTrashPage()
    {
        $tag_post_trash = Tag::latest()->where('trash', true)->get();
        return view('admin.page.posts.tag.trash',[
            'tag_post_trash'  => $tag_post_trash,
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
        'tname'     => 'required|unique:tags',
       ],
       [
        'tname.required' => 'Doya Kore Boxti puron korun',
       ]);
       // Data Store
       Tag::create([
            'tname'     => $request -> tname,
            'slug'     => Str::slug($request -> tname),
        ]);
        // Return back
        return back()->with('success', 'tag Created Successfull!');


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
        $post_tag = Tag::latest()->where('trash', false)->get();
        $edit_tag = Tag::findOrFail($id);
        return view('admin.page.posts.tag.index',[
            'form_type'     => 'edit',
            'post_tag'  => $post_tag,
            'edit_tag'  => $edit_tag,
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
    //    $this->validate($request,[
    //     'tname'     => 'required|unique:tags',
    //    ],
    //    [
    //     'tname.required' => 'Doya Kore Boxti puron korun',
    //    ]);
        $cat_update = Tag::findOrFail($id);

        $cat_update -> update([
            'tname'     => $request -> tname,
            'slug'     => Str::slug($request -> tname),
        ]);

        // Return back
        return back()->with('success', 'Tag Updated Successfull!');
    }

     /**
     *  Post Tag Trash Update
     */
    public function tagupdate($id)
    {
        $update_trash = Tag::findOrFail($id);
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
     *  Post Tag Status Update
     */
    public function TagStatusupdate($id)
    {
        $update_status = Tag::findOrFail($id);
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
        $delete = Tag::findOrFail($id);
        $delete -> delete();
        return back()->with('danger-main', 'Data deleted!');
    }
}
