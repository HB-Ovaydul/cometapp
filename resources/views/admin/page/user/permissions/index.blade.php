@extends('admin.layouts.app')
@section('main-content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All permissions</h4>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_permission as $permission)
                            <tr>
                                <td>{{ $loop -> index + 1}}</td>
                                <td>{{ $permission -> name }}</td>
                                <td>{{ $permission -> slug }}</td>
                                <td>{{ $permission -> created_at -> diffForHumans()}}</td>
                                <td>  
                                    <a class="btn btn-sm btn-warning" href="{{ route('permission.edit',$permission -> id) }}"><i class="fa fa-edit"></i></a>

                                    <form  class="d-inline" action="{{ route('permission.destroy',$permission->id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                       <button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </form>

                                    
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="bg-dark text-center text-light">Data Not Found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($form_type == 'create')
    <div class="col-xl-4 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4 class="card-title">Add Permission</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
    @endif
    
    {{-- Edit Form --}}
    @if ($form_type == 'edit')
    <div class="col-xl-4 d-flex">
        <div class="card flex-fill">
            <div class="card-header justify content between">
                <h4 class="card-title">Edit Permission</h4>
                <a class="primary" href="{{ route('permission.index') }}">Back</a>

            </div>
           
            @include('validate')
            <div class="card-body">
                <form action="{{ route('permission.update', $edit -> id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input name="name" type="text" value="{{ $edit -> name }}" class="form-control">
                        </div>
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