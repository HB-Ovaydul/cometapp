<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\admin\permission;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $permision = permission::latest()->get();
        return view('admin.page.user.permissions.index',[
            'all_permission' => $permision,
            'form_type'  => 'create',
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
        // Validate
        $this->validate($request,[
            'name' => 'required|unique:permissions',
        ]);

        //  Create User permissions
         permission::create([
            'name' => $request -> name, 
            'slug' => Str::slug( $request -> name) 
        ]);

        return back()->with('success','Permission Added Successful');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data Edit
        $permision = permission::latest()->get();
       $per_edit = permission::findOrFail($id);
        return view('admin.page.user.permissions.index',[
            'all_permission' => $permision,
            'form_type'  => 'edit',
            'edit'   => $per_edit
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
       $data_update = permission::findOrfail($id);
       $data_update ->update([
        'name' => $request -> name, 
        'slug' => Str::slug( $request -> name) 

       ]);
       
       return back()->with('success', 'Permission Updated Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $delete_data = permission::findOrFail($id);
       $delete_data -> delete();
       return back()->with('success-main', 'Permission Deleted');

    }
}
