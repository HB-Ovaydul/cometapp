<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PortfolioCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portcategory = Category::latest()->where('trash', false)->get();
        return view('admin.page.portfolio_category.index',[
            'form_type'     => 'create',
            'all_category'  => $portcategory,
        ]);
    }

    /**
     *  Portfolio Category Trash Page
     */
    public function PortfolioCategoryTrashPage()
    {
         $trash_category = Category::latest()->where('trash',true)->get();
        return view('admin.page.portfolio_category.trash',[
            'trash_category'  => $trash_category,
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
            'name'     => 'required',
        ]);
        
        //Data Store
        Category::create([
            'name'      => $request -> name, 
            'slug'      => Str::slug($request -> name), 
        ]);

        // Retrun back
        return back()->with('success', 'Category Created Successful!');
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

    // Portfolio Category Trash and Update
    public function PortfolioCategoryTrashUpdate($id)
    {
        $ctrash = Category::findOrFail($id);
        if($ctrash -> trash){
            // Trash update false
            $ctrash -> update([
                'trash'     => false
            ]);
            return back()->with('success-main', 'Restored Category!');
        }else{
            // Trash update true
            $ctrash -> update([
                'trash'     => true
            ]);
            return back()->with('danger-main', 'Category Move To trash!');
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
        $delete = Category::findOrFail($id);
        $delete -> delete();
        return back()->with('danger-main', 'Category Deleted!');

    }
}
