@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Product Brand</h4>
                <a class="float-right text-danger" href="{{ route('product.brand.trash.page') }}">Trash <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($brand_product as $brand_pro)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $brand_pro -> bname }}</td>
                                    <td>{{ $brand_pro -> slug }}</td>
                                    <td>{{ $brand_pro -> created_at ->diffForHumans()}}</td>
                                    <td>
                                        @if ($brand_pro -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('product.brand.status.update',$brand_pro -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('product.brand.status.update',$brand_pro -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('brand-product.edit',$brand_pro -> id) }}"><i class="fa fa-edit"></i></a>
    
                                     <a class="btn btn-sm btn-danger" href="{{ route('product.brand.trash.update', $brand_pro -> id ) }}"><i class="fa fa-trash"></i></a>
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
                <h4 class="card-title">Add Product Brand</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('brand-product.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input name="bname" type="text" class="form-control">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    @endif
    
   
    @if ($form_type == 'edit')
    <div class="col-xl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4 class="card-title">Edit Product Brand</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('brand-product.update', $edit -> id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Name</label>
                        <input name="bname" type="text" value="{{ $edit -> bname }}" class="form-control">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    @endif
  
</div>

@endsection