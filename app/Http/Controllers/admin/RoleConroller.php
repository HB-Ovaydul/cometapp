<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\admin\permission;
use App\Http\Controllers\Controller;

class RoleConroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $role = role::latest()->get();
       $permissions = permission::latest()->get();
        return view('admin.page.user.role.index',[
            'all_role' => $role,
            'form_type' => 'create',
            'permissions' => $permissions,
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
            'name' => ['required'],
        ]);
        
        // Data Store
        role::create([
            'name' => $request->name,
            'slug' => Str::slug( $request->name),
            'permission' => json_encode($request->permission),
            
        ]);

        // Retrun back
        return back()->with('success', 'Role Added Successful!');
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
        $role = role::latest()->get();
       $permissions = permission::latest()->get();
       $edit = role::findOrfail($id);
        return view('admin.page.user.role.index',[
            'all_role' => $role,
            'form_type' => 'edit',
            'permissions' => $permissions,
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
        // Validate
        $this->validate($request,[
            'name' => ['required'],
        ]);

        // Role Update
        $role_update = role::findOrFail($id);
        $role_update -> update([
            'name' => $request->name,
            'slug' => Str::slug( $request->name),
            'permission' => json_encode($request->permission),
        ]);

         // Retrun back
         return back()->with('success', 'Role Update Successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Role Delete 
        $delete_role = role::findOrFail($id);
        $delete_role -> delete();

         // Retrun back
         return back()->with('success-main', 'Role Deleted Successful!');

    }
}
