<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\PortfolioBanner;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PortfolioBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $port_banner = PortfolioBanner::latest()->where('trash', false)->get();
        return view('admin.page.portfolio-banner.index',[
            'form_type'     => 'create',
            'port_banner'   => $port_banner, 
        ]);
    }

    /**
     *  Portfolio banner Trash Page
     */
    public function PortfolioBannerTrashPage()
    {
        $port_trash = PortfolioBanner::latest()->where('trash', true)->get();
        return view('admin.page.portfolio-banner.trash',[
            'port_trash'   => $port_trash, 
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
            'title' => 'required',
            'sub' => 'required',
            'photo' => 'required',
        ]);

        // Banner Photo Upload
        if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/port_banner/'.$file_name));
        }

        // Data Store
        PortfolioBanner::create([
            'title'     => $request -> title,
            'subtitle'  => $request -> sub,
            'photo'     => $file_name,
        ]);
        
        // Return Back
        return back()->with('success', 'Portfolio-Banner Created Successful');
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
        $port_banner = PortfolioBanner::latest()->where('trash', false)->get();
        $edit = PortfolioBanner::findOrFail($id);
        return view('admin.page.portfolio-banner.index',[
            'form_type'     => 'edit',
            'port_banner'   => $port_banner, 
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
        
        $update_data = PortfolioBanner::findOrFail($id);

        // $this->validate($request,[
        //     'title' => 'required',
        //     'sub' => 'required',
        //     'photo' => 'required',
        // ]);
        // Banner Photo update
        if($request -> hasFile('new_photo')){
            $img = $request -> file('new_photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/port_banner/'.$file_name));
            unlink('storage/port_banner/'.$update_data -> photo);
        }else{
            $file_name = $update_data -> photo; 
        }

        // Data Update
        $update_data -> update([
            'title'     => $request -> title,
            'subtitle'  => $request -> sub,
            'photo'     => $file_name,
        ]);
        
        // Return Back
        return back()->with('success', 'Banner Updated Successful');

    }

    /**
     *  Portfolio Banner Status Update
     */
    public function PortfolioBannerStatusUpdate($id)
    {
        $ban_Update = PortfolioBanner::findOrFail($id);
        if($ban_Update -> status){
            $ban_Update -> update([
                'status'    => false,
            ]);
            return back()->with('danger-main', 'Portfolio Banner Blocked');
        }else{
            $ban_Update -> update([
                'status'    => true,
            ]);
            return back()->with('success-main', 'Portfolio Banner Active');
        }
    }

    /**
     *  Portfolio Banner Status Update
     */
    public function PortfolioBannerTrashUpdate($id)
    {
        $trash_Update = PortfolioBanner::findOrFail($id);
        if($trash_Update -> trash){
            $trash_Update -> update([
                'trash'    => false,
                'status'    => true,
            ]);
            return back()->with('success-main', 'Portfolio Banner Restore');
        }else{
            $trash_Update -> update([
                'trash'    => true,
                'status'    => false
            ]);
            return back()->with('danger-main', 'Portfolio Banner Move To trash');
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
        $delete = PortfolioBanner::findOrFail($id);
        $delete -> delete();
        return back()->with('danger', 'Data Deleted!');
    }
}
