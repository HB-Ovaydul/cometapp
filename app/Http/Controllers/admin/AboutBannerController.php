<?php

namespace App\Http\Controllers\admin;

use App\Models\Aboutbanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class AboutBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Aboutbanner::latest()->where('trash', false)->get();
        return view('admin.page.about.banner.index',[
            'form_type' => 'create',
            'all_banner'    => $banner,
        ]);
    }

    /**
     *  About Banner Trash page
     */
    public function BannerTrashPage()
    {
        $trash = Aboutbanner::latest()->where('trash', true)->get();
        return view('admin.page.about.banner.trash',[
            'all_trash'    => $trash,
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
            'title'     => 'required',
            'sub'       => 'required',
            'photo'     => 'required',
        ]);

        // Banner Photo Upload
        if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $banner_img = Image::make($img -> getRealPath());
            $banner_img -> save(storage_path('app/public/about_banner/'. $file_name));
        }

        // Data Store
        Aboutbanner::create([
            'title'     => $request -> title,
            'subtitle'  => $request -> sub,
            'image'     => $file_name,
        ]);

        return back()->with('success', 'Banner Added Successful');
        

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
        $banner = Aboutbanner::latest()->where('trash', false)->get();
        $banner_edit = Aboutbanner::findOrFail($id);
        return view('admin.page.about.banner.index',[
            'form_type' => 'edit',
            'all_banner'    => $banner,
            'edit_banner'    => $banner_edit,
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
        $update = Aboutbanner::findOrFail($id);
          // Banner Photo update
          if($request -> hasFile('new_photo')){
            $img = $request -> file('new_photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $banner_img = Image::make($img -> getRealPath());
            $banner_img -> save(storage_path('app/public/about_banner/'. $file_name));
            // Old Image Delete
            unlink('storage/about_banner/'. $update -> image);
        }else{
            $file_name = $request -> old_photo;
        }

        // Data Update
        $update -> update([
            'title'     => $request -> title,
            'subtitle'  => $request -> sub,
            'image'     => $file_name,
        ]);

        return back()->with('success', 'Banner Updated Successful');
    }

    /**
     *  Trash Update Management
     */
    public function BannerTrashUpdate($id)
    {
        $trash_update = Aboutbanner::findOrFail($id);
        if($trash_update -> trash){
            $trash_update -> update([
                'trash'   => false,
            ]);
            return back()->with('success-main', 'Banner Restored');
        }else{
            $trash_update -> update([
                'trash'   => true,
            ]);
            return back()->with('danger-main', 'Banner Move To Trash');
        }
    }
    /**
     *  Trash Update Management
     */
    public function BannerStatus($id)
    {
        $status_update = Aboutbanner::findOrFail($id);
        if($status_update -> status){
            $status_update -> update([
                'status'   => false,
            ]);
            return back()->with('danger-main', 'Blocked');
        }else{
            $status_update -> update([
                'status'   => true,
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
        $delete = Aboutbanner::findOrFail($id);
        $delete -> delete();
        return back()->with('danger-main', 'Banner Deleted Successful');
        
    }
}
