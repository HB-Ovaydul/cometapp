@extends('admin.layouts.app')
@section('main-content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All Role</h4>
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
                                <th>Permissions</th>
                                <th>Create_at</th>
                                <th>Users</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all_role as $roles)
                            <tr>
                                <td>{{ $loop -> index + 1}}</td>
                                <td>{{ $roles -> name }}</td>
                                <td>{{ $roles -> slug }}</td>
                                <td>
                                <ul style="list-style: none; padding:0px">
                                    @forelse (json_decode($roles -> permission) as $role)
                                            <li><i class="fa fa-angle-right"></i>
                                                {{ $role }}
                                            </li>
                                    @empty
                                        <li>Permission Empty!</li>       
                                    @endforelse
                                </ul>   
                                </td>
                                <td>{{ $roles -> created_at -> diffForHumans()}}</td>
                                <td>
                                    <ul style="list-style: none; padding:0px">
                                        @forelse (json_decode($roles -> users) as $role_user)
                                            <li><i class="fa fa-check"></i> {{ $role_user -> name }}</li>
                                        @empty
                                        <li>No Record Found</li>
                                        @endforelse
                                    </ul>
                                </td>
                                <td>  
                                    <a class="btn btn-sm btn-warning" href="{{ route('role.edit', $roles ->id) }}"><i class="fa fa-edit"></i></a>

                                    <form  class="d-inline" action="{{ route('role.destroy',$roles->id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                         
                                       <button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
                                    </form>

                                    
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="bg-dark text-center text-light">Data Not Found!</td>
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
                <h4 class="card-title">Add Role</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Role Name</label>
                        <div class="col-lg-9">
                            <input name="name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-grupe">
                        @forelse ($permissions as $per)
                        <ul style="list-style: none; padding:0px">
                            <li>
                                <label> <input name="permission[]" value="{{ $per -> name }}" type="checkbox"> {{ $per -> name }}</label>
                            </li>
                        
                        @empty
                        
                            <li>
                                <label>Data Not Found</label>
                            </li>
                        </ul>
                        @endforelse
                        
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
                <a class="primary" href="{{ route('role.index') }}">Back</a>

            </div>
           
            @include('validate')
            <div class="card-body">
                <form action="{{ route('role.update', $edit -> id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9">
                            <input name="name" type="text" value="{{ $edit -> name }}" class="form-control">
                        </div>    
                    </div>

                    <ul style="list-style: none; padding:0px">
                        @forelse (json_decode($permissions) as $edit_role)
                        <li><label><input name="permission[]" value="{{ $edit_role -> name}}" @if (in_array($edit_role -> name, json_decode($edit -> permission))) checked @endif type="checkbox"> {{ $edit_role -> name}}</label></li>
                        @empty
                        <li>Permission Empty!</li>
                        @endforelse
                    </ul>

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