<?php

namespace App\Http\Controllers\admin;

use App\Models\Vision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class VisionContriller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theVision = Vision::latest()->where('trash', false)->get();
        return view('admin.page.vision.index',[
            'form_type'     => 'create',
            'all_vision'    => $theVision,
        ]);
    }

    /**
     *  The Vision Trash Page
     */
    public function VisionTrashPage()
    {
        $trashVision = Vision::latest()->where('trash', true)->get();
        return view('admin.page.vision.trash',[
            'all_trash'    => $trashVision,
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
            'dec'       => 'required', 
            'photo'     => 'required', 
        ]);

        // Photo Upload
        if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/vision/'.$file_name));

        }

        // Data Store
        Vision::create([
            'title' => $request -> title,
            'dec'   => $request -> dec,
            'photo' => $file_name,
        ]);

        // Retrun Back
        return back()->with('success', 'Vision Added Successful');
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
        $visin_edit = Vision::findOrFail($id);
        $theVision = Vision::latest()->where('trash', false)->get();
        return view('admin.page.vision.index',[
            'form_type'     => 'edit',
            'all_vision'    => $theVision,
            'edit'          => $visin_edit,
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
        $vision_update = Vision::findOrfail($id);
                // Photo update
                if($request -> hasFile('new_photo')){
                    $img = $request -> file('new_photo');
                    $file_name = md5(time().rand()).'.'.$img -> clientExtension();
                    $image = Image::make($img -> getRealPath());
                    $image -> save(storage_path('app/public/vision/'.$file_name));
                    unlink('storage/vision/'.$vision_update -> photo);
                }else{
                    $file_name = $request -> old_photo;
                }
        
                // Data Update
                $vision_update -> update([
                    'title' => $request -> title,
                    'dec'   => $request -> dec,
                    'photo' => $file_name,
                ]);
                // // Retrun Back
                return back()->with('success', 'Vision Updated Successful');
    }

    /**
     *  The Vision Trash Update
     */
    public function VisionTrashupdate($id)
    {
       $trash_update = Vision::findOrFail($id);

       if($trash_update->trash){
        $trash_update -> update([
            'trash'     => false
        ]);
        return back()->with('success-main', 'Vision Restored!');
        
       }else{
        $trash_update -> update([
            'trash'     => true
        ]);
        return back()->with('danger-main', 'Vision Move To Trash!');
       }
    }
    /**
     *  The Vision Trash Update
     */
    public function VisionStatusupdate($id)
    {
       $status_update = Vision::findOrFail($id);

       if($status_update->status){
        $status_update -> update([
            'status'     => false
        ]);
        return back()->with('danger-main', 'Vision Blocked!');
        
    }else{
        $status_update -> update([
            'status'     => true
        ]);
        return back()->with('success-main', 'Vision Active!');
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
        $delete = Vision::findOrFail($id);
        $delete -> delete();
        return back()->with('danger-main', 'Data deleted!');
    }
}
