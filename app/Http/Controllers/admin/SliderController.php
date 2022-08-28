<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use function GuzzleHttp\Promise\all;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_slide = Slide::latest()->where('trash', false)->get();
        return view('admin.page.slider.index',[
            'form_type'    => 'create',
            'all_slide'     => $all_slide,
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
            'subtitle'     => 'required',
            'photo'     => 'required',
        ]);

      
        
        // Button Management System
        $buttons = [];
        for($i = 0; $i < count($request -> btn_title); $i++){
            array_push($buttons,[
               'btn_title'     => $request -> btn_title[$i],
                'btn_link'     => $request -> btn_link[$i],
                'btn_type'     => $request -> btn_type[$i],
            ]);
        }

     
        //Slider Image Upload
        if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();

            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/admin_photo/' . $file_name));
        }
        
        // Slider Data Store
        Slide::create([
            'title'        => $request -> title,
            'subtitle'     => $request -> subtitle,
            'photo'        => $file_name,
            'button'       => json_encode($buttons), 
        ]);

        // Retrun back
        return back()->with('success', 'Slider Successful Created!');
        
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
        $all_slide = Slide::latest()-> get();
        $edit_id = Slide::findOrFail($id);
        return view('admin.page.slider.index',[
            'form_type'    => 'edit',
            'all_slide'     => $all_slide,
            'edit_id'       => $edit_id,
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
        // Slider Data Update
       $slide_update = Slide::findOrFail($id);

        //Slider Image Update
        if($request -> hasFile('new_photo')){
            $img = $request -> file('new_photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();

            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/admin_photo/' . $file_name));

            // Old Photo delete system
            unlink('storage/admin_photo/'. $slide_update -> photo);
        }else{
           $file_name = $request -> old_photo;
        }

          // Button Update
          $buttons = [];
          for($i = 0; $i < count($request -> btn_title); $i++){
              array_push($buttons,[
                 'btn_title'     => $request -> btn_title[$i],
                  'btn_link'     => $request -> btn_link[$i],
                  'btn_type'     => $request -> btn_type[$i],
              ]);
          }

       $slide_update -> update([
            'title'        => $request -> title,
            'subtitle'     => $request -> subtitle,
            'photo'        => $file_name,
            'button'       => json_encode($buttons), 
        ]);

        // Retrun back
        return back()->with('success', 'Slider Updated Successful!');
        
    }


    /**
     * Status Management Systemt
     */

     public function statusForSlide($id)
     {
        $slide_status = Slide::FindOrFail($id);
        if($slide_status -> status){
            $slide_status -> update([
                'status'    => false
            ]);

            return back()->with('danger-main', 'Slide Blocked!');
        }else{
            $slide_status -> update([
                'status'    => true
            ]);

            return back()->with('success-main', 'Slide Activated!');
        }

     }
    /**
     *  Data Move Trash
     */
    public function ShowSlideTrash()
    {
       $slid_trash = Slide::latest()->where('trash', true)->get();
        return view('admin.page.slider.trash',[
            'form_type'     => 'trash',
            'all_trash'     => $slid_trash,
        ]);
    }

/**
 *  Move To Trash Method
 */

 public function TrashForSlide($id)
 {
    // Move To Trash Conditions
    $slides = Slide::findOrFail($id);
    if($slides -> trash){
        $slides -> update([
            'trash' =>false,
        ]);
        
        return back()->with('success-main', 'Slide Restore!');
    }else{
        $slides -> update([
            'trash'    => true,
        ]);
        return back()->with('warning-main', 'Move To Trash!');
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
        $slide_delete = Slide::findOrFail($id);
        $slide_delete -> delete();
        return back()->with('danger-main', 'Slide Permanetly Deleted!');
    }
}
