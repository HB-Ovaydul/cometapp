<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacus = Contact::latest()->where('trash', false)->get();
        return view('admin.page.contact.index',[
            'form_type'     => 'create',
            'all_contact'   => $contacus,
        ]);
    }

    /**
     *  Contact Trash Page
     */
    public function ContactTrashPage()
    {
        $trash = Contact::latest()->where('trash', true)->get();
        return view('admin.page.contact.trash',[
            'all_trash'   => $trash,
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
            'title' => ['required'],
            'count' => ['required'],
            'icon' => ['required'],
        ]);

        // Data Store
       Contact::create([
        'title'     => $request -> title,
        'count'     => $request -> count,
        'icon'      => $request -> icon,
       ]);

       // Retrun back
       return back()->with('success', 'Counter Added Successful!');

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
        $contacus = Contact::latest()->where('trash', false)->get();
        $edit = Contact::findOrFail($id); 
        return view('admin.page.contact.index',[
            'form_type'     => 'edit',
            'all_contact'   => $contacus,
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
        // Validation
        $this->validate($request,[
            'title' => ['required'],
            'count' => ['required'],
            'icon' => ['required'],
        ]);

        $cout_update = Contact::findOrFail($id);
        $cout_update -> update([
            'title'     => $request -> title,
            'count'     => $request -> count,
            'icon'      => $request -> icon,
        ]);

       // Retrun back
       return back()->with('success', 'Counter Updated Successful!');
    }

    /**
     *  Counter Status Update
     */
    public function ContactStatusUpdate($id)
    {
        $count = Contact::findOrFail($id);
        if($count -> status){
            $count -> update([
                'status'    => false,
            ]);
            // Retrun back
            return back()->with('danger-main', 'Counter Blocked!');
        }else{
            $count -> update([
                'status'    => true,
            ]);
            // Retrun back
            return back()->with('success-main', 'Counter Activate!');
        }
    }

    /**
     * Counter Trash Update
     */
    public function ContactTrashupdate($id)
    {
       $trash_update = Contact::findOrFail($id);
       if($trash_update -> trash){
        $trash_update -> update([
            'trash'     => false,
        ]);

         // Retrun back
         return back()->with('success-main', 'Counter Restore!');
        }else{
            $trash_update -> update([
                'trash'     => true,
            ]);
            // Retrun back
            return back()->with('danger-main', 'Counter Move to Trash!');
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
        $delete = Contact::findOrFail($id);
        $delete -> delete();
        return back()->with('danger-main', 'Data Deleted!');
    }
}
