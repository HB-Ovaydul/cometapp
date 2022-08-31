<?php

namespace App\Http\Controllers\admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Prophecy\Promise\ReturnPromise;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::latest()->where('trash', false)->get();
        return view('admin.page.client.index',[
            'form_type' => 'create',
            'all_client'    => $client,
        ]);
    }

    /**
     *  Show Client Trash page 
     */

    public function ClientTrashPage()
    {
        $client_trash = Client::latest()->where('trash', true)->get();
        return view('admin.page.client.trash',[
            'client_trash'    => $client_trash,
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
        // Data Validation
       $this->validate($request,[
        'name'  => ['required'],
        'photo'  => ['required'],
       ]);

       // Client Logo Upload Systemt
       if($request -> hasFile('photo')){
            $img = $request -> file('photo');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/clients/' . $file_name));

       }
       // Data Store
       Client::create([
        'name'  => $request -> name,
        'photo'  => $file_name,
       ]);

       // Retrun Back
       return back()->with('success', 'Client Added Successful!');
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
        $client = Client::latest()->where('trash', false)->get();
        $edit = Client::FindOrFail($id);
        return view('admin.page.client.index',[
            'form_type'     => 'edit',
            'all_client'    => $client,
            'edit'          => $edit
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

 // Data Update
  $client_update = Client::FindOrFail($id); 
   // Client Logo Update
   if($request -> hasFile('new_photo')){
    $img = $request -> file('new_photo');
    $file_name = md5(time().rand()).'.'.$img -> clientExtension();
    $image = Image::make($img -> getRealPath());
    $image -> save(storage_path('app/public/clients/' . $file_name));
    // Old photo Delete System
    unlink('storage/clients/'. $client_update -> photo);
    }else
    {
        $file_name = $request -> old_photo; 
    }

// Data Update
  $client_update  -> update([
    'name'  => $request -> name,
    'photo'  => $file_name,
   ]);

   // Retrun Back
   return back()->with('success', 'Client Updated Successful!');
    }

    /**
     * Client Trash Update
     */

     public function ClientTrasUdate($id)
     {
        $trash_update = Client::FindOrFail($id);
        if($trash_update -> trash){
            $trash_update -> update([
                'trash'     => false
            ]);
            return back()->with('success-main', 'Trash Restored!');
        }else{
            $trash_update -> update([
                'trash'     => true
            ]);
            return back()->with('danger-main', 'Move To Trash!');
        }
     }
    /**
     * Client Status Update
     */

     public function ClientStatusUdate($id)
     {
        $status_update = Client::FindOrFail($id);
        if($status_update -> status){
            $status_update -> update([
                'status'     => false
            ]);
            return back()->with('danger-main', 'Blocked!');
        }else{
            $status_update -> update([
                'status'     => true
            ]);
            return back()->with('success-main', 'Activated!');
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
        $clietn_delete = Client::FindOrFail($id);
        $clietn_delete -> delete();
        return back()->with('danger-main', 'Client Deleted!');

    }
}
