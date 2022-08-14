@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Users</h4>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Photo</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_admin as $admin)
                            @if($admin -> name != 'provider' )
                            <tr>
                                <td>{{ $loop -> index + 1}}</td>
                                <td>{{ $admin -> name }}</td>
                                <td>{{ $admin -> role -> name }}</td>
                                <td>
                                    @if ($admin -> photo == 'avater.png')
                                        <img style="width: 50px; height: 50px; object-fit: cover;" src="{{ url('storage/admin_photo/avater.jpg') }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $admin -> created_at -> diffForHumans()}}</td>
                                <td>
                                    @if ($admin -> status)
                                        <span class="badge badge-success">Active User</span>
                                        <span class="badge badge-success">Active User</span>
                                        <a class="text-danger" href="{{ route('admin.sta.up',$admin -> id,) }}"><i class="fa fa-times"></i></a>
                                    @else
                                        <span class="badge badge-danger">Blocked User</span>
                                        <a class="text-success" href="{{ route('admin.sta.up',$admin -> id) }}"><i class="fa fa-check"></i></a>
                                    @endif
                                </td>
                                <td>  
                                    <a class="btn btn-sm btn-warning" href="{{ route('admin-user.index',$admin -> id) }}"><i class="fa fa-edit"></i></a>

                                    <form  class="d-inline" action="{{ route('admin-user.destroy',$admin -> id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                       <button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endif
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
    <div class="col-xl-5 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4 class="card-title">Add User</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('admin-user.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email</label>
                        <div class="col-lg-9">
                            <input name="email" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Cell</label>
                        <div class="col-lg-9">
                            <input name="cell" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Username</label>
                        <div class="col-lg-9">
                            <input name="username" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-lg-3 col-form-label">Role</label>
                        <div class="col-lg-9">
                            <select name="role" id="" class="form-control">
                                <option value="">-select-</option>
                                @foreach ($role as $item)
                                <option value="{{ $item -> id }}">{{ $item -> name }}</option> 
                                @endforeach
                            </select>
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
    {{-- @if ($form_type == 'edit')
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
   --}}
</div>
@endsection