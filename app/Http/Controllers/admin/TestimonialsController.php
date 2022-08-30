<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Queue\Events\JobRetryRequested;

class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonial = Testimonial::latest()->where('trash', false)->get();
        return view('admin.page.testimonials.index',[
            'form_type'     => 'create',
            'testimonial'   => $testimonial,
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
            'text'   => 'required',
            'name'     =>  'required',
            'company'  =>  'required',
        ]);

        // Testimonials Data Store
        Testimonial::create([
            'details'       => $request -> text,
            'name'          => $request -> name,
            'company'       => $request -> company,
        ]);

        // Retrun back 
        return back()->with('success', 'Testimonial Added Successful');
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
        $testimonial = Testimonial::latest()->where('trash', false)->get();
        $edit_testi = Testimonial::FindOrFail($id);
        return view('admin.page.testimonials.index',[
            'form_type'     => 'edit',
            'testimonial'   => $testimonial,
            'edit_testi'    => $edit_testi,
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

        // Testimonials Data Update
       $update = Testimonial::FindOrFail($id);
       $update -> update([
        'details'       => $request -> text,
        'name'          => $request -> name,
        'company'       => $request -> company,
       ]);

        // Retrun back 
        return back()->with('success', 'Testimonial Updated Successful');
    }

    /**
     * Testimonials Trash page
     */
    public function TestimonialTrash()
    {
        $testimonial = Testimonial::latest()->where('trash', true)->get();
        return view('admin.page.testimonials.trash',[
            'testimonial'   => $testimonial,
        ]);
    }
    /**
     * Testimonials Trash page
     */
    public function TestimonialTrashUpdate($id)
    {
        $trash_update = Testimonial::FindOrFail($id);
        if($trash_update -> trash){
            $trash_update -> update([
                'trash'     => false,
            ]);

            return back()->with('success-main', 'Testimonial Restore');
        }else{
            $trash_update -> update([
                'trash'     => true,
            ]);

            return back()->with('warning-main', 'Testimonial Move To Trash');
        }
    }

    /**
     *  Testimonial Status Update System
     */
    public function StatushUpdate($id)
    {
        // Find id
       $status_update = Testimonial::FindOrFail($id);

       // Conditional Check Status
       if($status_update -> status){
        $status_update -> update([
            'status'    => false
        ]);
        // Retrun back
        return back()->with('danger-main', 'Testimonial Blocked');
       }else{
        $status_update -> update([
            'status'    => true
        ]);
       // Retrun back
       return back()->with('success-main', 'Testimonial Activated');
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
        $delete_id = Testimonial::FindOrFail($id);
        $delete_id -> delete();
        
        return back()->with('success-main', 'Testimonial Deleted Successful!');
    }
}
