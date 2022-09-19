<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfoilis = Portfolio::latest()->where('trash', false)->get();
        $category = Category::latest()->get();
        return view('admin.page.portfolio.index',[
            'form_type'     => 'create',
            'all_protfolio' => $portfoilis,
            'category'      => $category,
        ]);
    }

    /**
     *  Portfolio Trash Page
     */
    public function PortfolioTrashPage()
    {
        $portfoilis = Portfolio::latest()->where('trash', true)->get();
        $category = Category::latest()->get();
        return view('admin.page.portfolio.trash',[
            'all_protfolio' => $portfoilis,
            'category'      => $category,
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
        // Validate
        $this->validate($request,[
            'title' => 'required',
            'client' => 'required',
            'featured' => 'required',
        ]);

        // Featured Image Upload 
        if($request->hasFile('featured')){
            $img = $request -> file('featured');
            $file_name = md5(time().rand()).'.'.$img -> clientExtension();
            $image = Image::make($img -> getRealPath());
            $image -> save(storage_path('app/public/port_feature/'. $file_name));
        }

        //Gallery Image Uploade
        $gallery = [];
        if($request -> hasFile('gallery')){
            $gall = $request -> file('gallery');
            foreach ($gall as $gal) {
                $gall_name = md5(time().rand()).'.'.$gal -> clientExtension();
                $gall_image = Image::make($gal -> getRealPath());
                $gall_image -> save(storage_path('app/public/port_gallery/'. $gall_name));
                 array_push($gallery, $gall_name);
            }
        }

        // Staps Managment
        $staps = [];
        if(isset($request -> title)){
            $staps_arr = $request -> title;

            for($i = 0; $i < count($staps_arr); $i++){
                array_push($staps,[
                    'title'      => $request -> title[$i],
                    'dec'        => $request -> decp[$i],
                ]);
            }
        }

        // Data Store
      $portfolio = Portfolio::create([
            'title'     => $request -> tname,
            'slug'      => Str::slug($request -> tname),
            'client'    => $request -> client,
            'link'      => $request -> link,
            'date'      => $request -> date,
            'dec'       => $request -> port_dec,
            'type'       => $request -> types,
            'featured'  => $file_name,
            'gallery'   => json_encode($gallery),
            'staps'     => json_encode($staps),
        ]);

        $portfolio -> categoris() -> attach($request -> type);

        return back()->with('success', 'Portfolio created Successful');

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
        $portfoilis = Portfolio::latest()->where('trash', false)->get();
        $category = Category::latest()->get();
        $edit = Portfolio::findOrFail($id);
        return view('admin.page.portfolio.index',[
            'form_type'     => 'edit',
            'all_protfolio' => $portfoilis,
            'category'      => $category,
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
        //
    }

    /**
     *  Portfoloi Trash Update
     */
    public function PortfolioTrashUpdate($id)
    {
       $port_trash = Portfolio::findOrFail($id);
       if($port_trash -> trash){
        $port_trash -> update([
            'trash'    => false,
        ]);
        return back()->with('success-main', 'Portfolio Restored!');
       }else{
        $port_trash -> update([
            'trash'    => true,
        ]);
        return back()->with('danger-main', 'Portfolio Move To Trash!');
       } 
    }
    /**
     *  Portfoloi Status Update
     */
    public function PortfolioStatusUpdate($id)
    {
       $port_status = Portfolio::findOrFail($id);
       if($port_status -> status){
        $port_status -> update([
            'status'    => false,
        ]);
        return back()->with('danger-main', 'Blocked!');
    }else{
        $port_status -> update([
            'status'    => true,
        ]);
        return back()->with('success-main', 'Activet!');
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
        //
    }
}
