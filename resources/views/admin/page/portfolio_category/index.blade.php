@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Portfolio Category</h4>
                <a class="float-right text-danger" href="{{ route('Pc.trash.page') }}">Trash <i class="fa fa-arrow-right"></i></a>
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
                                <th>Portfolios</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($all_category as $category)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $category -> name }}</td>
                                    <td>{{ $category -> slug }}</td>
                                    <td>
                                        <ul class="ul-back-end">
                                            @forelse ($category -> portfolios as $port)
                                                <li><i style="margin-right:3px" class="fa fa-angle-right"></i>{{ $port -> title }}</li>
                                            @empty
                                                Empty!
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>{{ $category -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if ($category -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('Pc.status.update',$category -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('Pc.status.update',$category -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('contact-admin.edit',$category -> id) }}"><i class="fa fa-edit"></i></a>
    
                                     <a class="btn btn-sm btn-danger" href="{{ route('Pc.trash.update', $category -> id ) }}"><i class="fa fa-trash"></i></a>
                                    </td>
                             </tr>
                           @empty
                               <tr>
                                <td colspan="7" class="text-light bg-dark text-center">Record No Found!</td>
                               </tr>
                           @endforelse

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
                <h4 class="card-title">Add Portfolio Category</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('portfolio-category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="text-right">
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
                <h4 class="card-title">Add Expertise</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('portfolio-category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    @endif
   --}}
</div>

@endsection