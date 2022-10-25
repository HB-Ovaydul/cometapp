@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Product Tag</h4>
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
                                <th>Slug</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($tag_product as $tag_pro)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $tag_pro -> tname }}</td>
                                    <td>{{ $tag_pro -> slug }}</td>
                                    <td>{{ $tag_pro -> created_at ->diffForHumans()}}</td>
                                    <td>
                                        @if ($tag_pro -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('product.tag.status.update',$tag_pro -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('product.tag.status.update',$tag_pro -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('tag-product.edit',$tag_pro -> id) }}"><i class="fa fa-edit"></i></a>
    
                                     <a class="btn btn-sm btn-danger" href="{{ route('product.tag.trash.update', $tag_pro -> id ) }}"><i class="fa fa-trash"></i></a>
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
                <h4 class="card-title">Add Product Tag</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('tag-product.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input name="tname" type="text" class="form-control">
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
                <h4 class="card-title">Edit Product Tag</h4>
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
    @endif
  
</div>

@endsection