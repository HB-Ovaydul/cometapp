@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Product's</h4>
                <a class="float-right text-danger" href="{{ route('product.tag.trash.page') }}">Trash <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Tag</th>
                                <th>Brand</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($products as $product)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $product -> title }}</td>
                                    <td>
                                        <ul class="ul-back-end">
                                            @forelse ($product -> Pro_cat as $cat)
                                            <li><i style="margin-right:3px" class="fa fa-angle-right"></i>{{ $cat -> cname }}</li> 
                                            @empty
                                                No Category
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="ul-back-end">
                                            @forelse ($product -> Pro_tag as $cat)
                                            <li><i style="margin-right:3px" class="fa fa-angle-right"></i>{{ $cat -> tname }}</li> 
                                            @empty
                                                No Tag
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>
                                        <ul class="ul-back-end">
                                            @forelse ($product -> Pro_brand as $brand)
                                            <li><i style="margin-right:3px" class="fa fa-angle-right"></i>{{ $brand -> bname }}</li> 
                                            @empty
                                                No Tag
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>{{ $product -> price }}</td>
                                    <td>{{ $product -> created_at ->diffForHumans()}}</td>
                                    <td>
                                        @if ($product -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('product.tag.status.update',$product -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('product.tag.status.update',$product -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('products.edit',$product -> id) }}"><i class="fa fa-edit"></i></a>
    
                                     <a class="btn btn-sm btn-danger" href="{{ route('product.tag.trash.update', $product -> id ) }}"><i class="fa fa-trash"></i></a>
                                    </td>
                             </tr>
                           @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($form_type == 'create')
    <div class="col-xl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4 class="card-title">Add Product's</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="form-group">
                            <label>Title</label>
                            <input name="title" type="text" class="form-control">
                            <div class="form-group">
                                <label>Featured Image</label>
                                <br>
                                <input style="display: none;" id="photo-id" name="photo" type="file" class="form-control">
                                <img style="max-width:100%; max-height:100%;" id="photo-preview" src="" alt="">
                                <label for="photo-id">
                                  <img style="width:90px; height:90px;" src="admin/assets/img/slide1.png" alt="">
                                </label>  
                            </div>
                        <div class="form-group">
                            <label>Gallery</label><br>
                           <div class="preview-gallery">
                            
                           </div>
                            <br>
                           <input style="display: none;" id="gallery" multiple name="gallery[]" type="file" class="form-control">
                           <label for="gallery"><img style="width:90px; height:90px;" src="admin/assets/img/gallery.png" alt=""></label>
                        </div> 
                        <div class="form-group">
                            <label>Product Category</label>
                            <ul class="cats-ul-devs">
                                @foreach ($products_cat as $cat)
                                    <li><input name="productcat[]" type="checkbox" value="{{ $cat -> id }}" class="form-controle">{{ $cat -> cname }}</li>
                                @endforeach
                            </ul>
                            
                        </div>
                        <div class="form-group">
                            <label>Select Tag</label>
                             <select class="form-control comet-select" multiple name="product_tag[]" id="">
                                @foreach ($products_tag as $tag)
                                <option value="{{ $tag -> id }}">{{ $tag -> tname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Brand</label>
                             <select class="form-control" name="product_brand[]" id="">
                                <option value="">-Select-</option>
                                @foreach ($products_brand as $brand)
                                <option value="{{ $brand -> id }}">{{ $brand -> bname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input name="price" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Regular Price</label>
                            <input name="regular_price" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Sort Description</label>
                            <input name="sort_des" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="des" id="" cols="5" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <input name="color" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Size</label>
                            <input name="size" type="text" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    @endif
    
   
    {{-- @if ($form_type == 'edit')
    <div class="col-xl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4 class="card-title">Edit Product's</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('tag-product.update', $edit -> id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="tname" type="text" value="{{ $edit -> tname }}" class="form-control">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    @endif --}}
  
</div>

@endsection