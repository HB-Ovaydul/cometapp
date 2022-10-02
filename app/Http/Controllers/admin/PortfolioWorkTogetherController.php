<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PortfolioWorkTogether;
use Intervention\Image\Facades\Image;

class PortfolioWorkTogetherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $port_work = PortfolioWorkTogether::latest()->where('trash', false)->get();
        return view('admin.page.portfolio_work.index',[
            'form_type' => 'create',
            'port_work' => $port_work,
        ]);
    }
    /**
     *  Portfolio Work Together trash Page
     */

    public function PortWorkTrashPage()
    {
        $port_work_trash = PortfolioWorkTogether::latest()->where('trash', true)->get();
        return view('admin.page.portfolio_work.trash',[
            'port_work_trash' => $port_work_trash ,
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

       // Photo Upload

       if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $img_puth = Image::make($img -> getRealPath());
            $img_puth -> save(storage_path('app/public/port_work/'.$file_name ));
       }else{
         $file_name = NULL;
       }

       // Data Store
       PortfolioWorkTogether::create([
        'title'     => $request->title,
        'subtitle'  => $request->sub,
        'photo'     => $file_name,
       ]);

       // Retrun Back 
       return back()->with('success', 'Work Together Create Successful');
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
        $port_work = PortfolioWorkTogether::latest()->where('trash', false)->get();
        $edit = PortfolioWorkTogether::findOrFail($id);
        return view('admin.page.portfolio_work.index',[
            'form_type' => 'edit',
            'port_work' => $port_work,
            'edit' => $edit,
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
        // Find id 
        $work_update = PortfolioWorkTogether::findOrFail($id);
       // Photo Update
        if($request -> hasFile('new_photo')){
            $img = $request -> file('new_photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $img_puth = Image::make($img -> getRealPath());
            $img_puth -> save(storage_path('app/public/port_work/'.$file_name ));
            unlink('storage/port_work/'.$work_update -> photo);
       }else{
         $file_name = $work_update -> photo;
       }

       // Data Update
       $work_update -> update([
        'title'     => $request->title,
        'subtitle'  => $request->sub,
        'photo'     => $file_name,
       ]);
    
       // Retrun Back 
       return back()->with('success', 'Work Together Updated Successful');
    }

    /**
     *  Work Trash Update
     */
    public function WorkTrashupdate($id)
    {
      $trash_update = PortfolioWorkTogether::findOrFail($id);
      if($trash_update -> trash){
        $trash_update -> update([
            'trash'    => false,
            'status'    => true,
        ]);
        // return back
        return back()->with('success-main', 'Data Restored!');
      }else{
        $trash_update -> update([
            'trash'    => true,
            'status'    => false,
        ]);
        // return back
        return back()->with('danger-main', 'Data Move To trash!');
      }
    }

    /**
     *  Work Trash Update
     */
    public function WorkStatusupdate($id)
    {
      $status_update = PortfolioWorkTogether::findOrFail($id);
      if($status_update -> status){
        $status_update -> update([
            'status'    => false,
        ]);
        // return back
        return back()->with('danger-main', 'Blocked!');
    }else{
        $status_update -> update([
            'status'    => true,
        ]);
        // return back
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
        $delete = PortfolioWorkTogether::findOrFail($id);
        $delete -> delete();
        return back()->with('danger-main', 'Data Deleted Successfull!');

    }
}
