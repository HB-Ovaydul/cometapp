<?php

namespace App\Http\Controllers\admin;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $all_post = Post::latest()->where('trash', false)->get();
      $post_category = Categorypost::latest()->get();
      $post_tag = Tag::latest()->get();
      return view('admin.page.posts.post.index', [
        'form_type'          => 'create',
        'all_post'           => $all_post,
        'post_category'      => $post_category,
        'post_tag'      => $post_tag,
      ]);
    }

    /**
     * Post Trash page 
     */
    public function PostTrashPage()
    {
        $post_trash = Post::latest()->where('trash', true)->get();
      $post_category = Categorypost::latest()->get();
      $post_tag = Tag::latest()->get();
      return view('admin.page.posts.post.trash', [
        'post_trash'           => $post_trash,
        'post_category'      => $post_category,
        'post_tag'      => $post_tag,
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
            'title'   => 'required|unique:posts',
            'content'   => 'required',
        ]);

         // Featured Image Upload 
         if($request->hasFile('featured')){
            $img = $request -> file('featured');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/post_feature/'. $file_name));
        }

         //Gallery Image Uploade
         $gallery = [];
         if($request -> hasFile('gallery')){
             $gall = $request -> file('gallery');
             foreach ($gall as $gal) {
                 $gall_name = md5(time().rand()).'.'.$gal -> clientExtension();
                 $gall_image = Image::make($gal -> getRealPath());
                 $gall_image -> save(storage_path('app/public/post_gallery/'. $gall_name));
                  array_push($gallery, $gall_name);
             }
         }


        // Bolg feature Image, Video, Audio, Gallery, Qoute Managment
       $post_type = [
            'post_type'     => $request -> type,
            'standerd'      => $file_name ?? '',
            'gallery'       => json_encode($gallery),
            'video'         => $this->embed($request -> video),
            'audio'         => $request -> audio,
            'qoute'         => $request -> qoute,
        ];

        // Data Store
       $posts = Post::create([
            'admin_id'      => Auth::guard('admin')->user()->id,
            'title'         => $request -> title,
            'slug'          =>  $this->slugconvert($request -> title),
            'content'       => $request -> content,
            'feature_image' => json_encode($post_type),
        ]);

        $posts -> postcat() -> attach($request -> category);
        $posts -> tag() -> attach($request -> tag);

        // return back
        return back()->with('success', 'Post Created Successful!');
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
        $all_post = Post::latest()->where('trash', false)->get();
        $post_category = Categorypost::latest()->get();
        $post_tag = Tag::latest()->get();
        $post_edit = Post::findOrFail($id);
        return view('admin.page.posts.post.index', [
          'form_type'          => 'edit',
          'all_post'           => $all_post,
          'post_category'      => $post_category,
          'post_tag'           => $post_tag,
          'edit'               => $post_edit,
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
        //  $this->validate($request,[
        //     'title'   => 'required|unique:posts',
        //     'content'   => 'required',
        // ]);

       $update = Post::findOrFail($id);
         // Featured Image Upload 
        //  $update_featur = json_decode($update -> post_type);
        //  if($request->hasFile('new_featured')){
        //     $img = $request -> file('new_featured');
        //     $file_name = md5(time().rand()).'.'.$img -> clientExtension();
        //     $image = Image::make($img -> getRealPath());
        //     $image -> save(storage_path('app/public/post_feature/'.$file_name));
        //     unlink('storage/post_feature/'. $update_featur -> standard);
           
        // }else{
        //     $file_name = $update -> standard;
        // }

         //Gallery Image Uploade
        //  $gallery = json_decode();
        //  if($request -> hasFile('gallery')){
        //      $gall = $request -> file('gallery');
        //      foreach ($gall as $gal) {
        //          $gall_name = md5(time().rand()).'.'.$gal -> clientExtension();
        //          $gall_image = Image::make($gal -> getRealPath());
        //          $gall_image -> save(storage_path('app/public/post_gallery/'. $gall_name));
        //           array_push($gallery, $gall_name);
        //      }
        //  }


        // Bolg feature Image, Video, Audio, Gallery, Qoute Managment
    //    $post_type = [
    //         'post_type'     => $request -> type,
    //         'standerd'      => $file_name ?? '',
    //         'gallery'       => json_encode($gallery),
    //         'video'         => $request -> video,
    //         'audio'         => $request -> audio,
    //         'qoute'         => $request -> qoute,
    //     ];

        // Data Store
        $update -> update([
            'admin_id'      => Auth::guard('admin')->user()->id,
            'title'         => $request -> title,
            'slug'          =>  Str::slug($request -> title),
            'content'       => $request -> content,
        ]);
        $update -> postcat() -> sync($request -> category);
        $update -> tag() -> sync($request -> tag);
        // return back
        return back()->with('success', 'Post Created Successful!');
    }

    // Post Trash update
    public function postupdate($id)
    {
        $post_trash = Post::findOrFail($id);
        if($post_trash -> trash){
            $post_trash -> update([
                'trash'     => false,
                'status'    => true,
            ]);
            // Return Back
            return back()->with('success-main', 'Data Restore!');
        }else{
            $post_trash -> update([
                'trash'     => true,
                'status'    => false,
            ]);
            // Return Back
            return back()->with('danger-main', 'Data Move To trash!');
        }

    }

    // Post Status update
    public function PostStatusupdate($id)
    {
        $post_status = Post::findOrFail($id);
        if($post_status -> status){
            $post_status -> update([
                'status'    => false,
            ]);
            // Return Back
            return back()->with('danger-main', 'Blocked');
        }else{
            $post_status -> update([
                'status'    => true,
            ]);
            // Return Back
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
        
    }
}
