<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin;
use App\Models\admin\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $all_admin = admin::latest() -> where('trash', false) -> get();
       $role = role::latest()->get();
        return view('admin.page.user.index',[
            'all_admin'     => $all_admin,
            'form_type'     => 'create',
            'role'          => $role
    ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'name'        => 'required', 
            'email'       => 'required|email|unique:admins', 
            'cell'        => 'required|unique:admins',
            'username'    => 'required|unique:admins'
        ]);

      // Passwoard Generate
      $pass_string = str_shuffle('asdfghjklzxcvbnmqwertyuiop1234567890?><KL:"@#$%^&*()_+');
      $pass = substr($pass_string, 10,10);

        // Admin Data Store
        admin::create([
            'name'          => $request -> name,
            'role_id'       => $request -> role,
            'username'      => $request -> username,
            'email'         => $request -> email,
            'cell'          => $request -> cell,
            'password'      => Hash::make($pass)
        ]);

        return back()->with('success', 'Accout Create Successful!');

       
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Status Update Switch
     */
    public function UpdateStatus($id)
    {
        // Get Status Id
       $status_id = admin::findOrFail($id);

       // Check And Update
       if($status_id -> status){
           $status_id -> update([
               'status' => false,
           ]);
           return back()->with('danger-main', 'User Blocked!');
       }else{
        $status_id -> update([
            'status' => true,
        ]);

        return back()->with('success-main', 'User Activated Successful!');
       }

    }
    /**
     * Trash Update
     */

    public function TrashUpdate($id)
    {
        // Get Status Id
       $trash = admin::findOrFail($id);

       // Check And Update
       if($trash -> trash){
           $trash -> update([
               'trash' => false,
           ]);
           return back()->with('success-main', 'Restore User!');
       }else{
        $trash -> update([
            'trash' => true,
        ]);

        return back()->with('danger-main', 'Move To Trash');
       }

    }

/**
 * Recycle Bin & Trash
 */
public function Trash()
{
    $all_admin = admin::latest() -> where('trash', true) -> get();
        return view('admin.page.user.trash',[
            'all_admin'     => $all_admin,
            'form_type'     => 'trash',
    ]); 
}
}
