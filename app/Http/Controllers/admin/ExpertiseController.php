<?php

namespace App\Http\Controllers\admin;

use App\Models\Expertise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expertise = Expertise::latest()->where('trash', false)->get();
        return view('admin.page.expertise.index',[
            'form_type' => 'create',
            'all_exper' => $expertise,
        ]);
    }

    
    /**
     *  Expertise Move To Trash 
     */

    public function ExMoveTrash()
    {
       $ex_trash = Expertise::latest()->where('trash', true)->get();
       return view('admin.page.expertise.trash',[
           'trash_exper' => $ex_trash,
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
            'brand_name'     => ['required'],
            'paragraph'      => ['required'],
            'icon'           => ['required'],
        ]);

        // Photo upload

        if($request->hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/expertise/'. $file_name));
        }
        
        // Data Store
        Expertise::create([
            'brand_name'            => $request -> brand_name,
            'brand_paragraph'       => $request -> paragraph,
            'brand_logo'            => $request -> icon,
            'ex_photo'              => $file_name,

        ]);

        // Retrun back
        return back()->with('success', 'Espertise Added Successful');
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
        $expertise = Expertise::latest()->where('trash', false)->get();
        $edit_exper = Expertise::FindOrFail($id);
        return view('admin.page.expertise.index',[
            'form_type' => 'edit',
            'all_exper' => $expertise,
            'edit_id'   => $edit_exper,
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
      $update_exper = Expertise::findOrFail($id);
        // Photo update

        if($request->hasFile('new_photo')){
            $img = $request -> file('new_photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/expertise/'. $file_name));
            unlink('storage/expertise/'.$update_exper -> ex_photo );
        }else{
            $file_name = $request -> old_photo;
        }
        
        // Data Update
       $update_exper -> update([
            'brand_name'            => $request -> brand_name,
            'brand_paragraph'       => $request -> paragraph,
            'brand_logo'            => $request -> icon,
            'ex_photo'              => $file_name,

        ]);

        return back()->with('success', 'Expertise Updated Successful!');

    }

    /**
     *  Expertise Trash Update
     */

     public function ExStatusUpdate($id)
     {
       $status_update = Expertise::findOrFail($id);
       if($status_update -> status){
            $status_update -> update([
                'status'     => false,
            ]);
            return back()->with('danger-main', 'Expertise Is Blocked!');
        }else{
            $status_update -> update([
                'status'     => true,
            ]);
            return back()->with('success-main', 'Now Activate!');
        }
     }
    /**
     *  Expertise Trash Update
     */

     public function ExUpdateTrash($id)
     {
       $ex_trash_update = Expertise::findOrFail($id);
       if($ex_trash_update -> trash){
            $ex_trash_update -> update([
                'trash'     => false,
            ]);
            return back()->with('success-main', 'Expertise Restore!');
       }else{
        $ex_trash_update -> update([
            'trash'     => true,
        ]);
        return back()->with('danger-main', 'Expertise Move To Trash!');
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
        $ex_delete = Expertise::findOrFail($id);
        $ex_delete -> delete();
        return back()->with('danger', 'Expertise Deleted!');
    }
}
