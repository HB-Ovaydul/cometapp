@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Clients</h4>
                <a class="float-right text-danger" href="{{ route('client.trash.page') }}">Trash <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($all_client as $client)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $client -> name }}</td>
                                    <td><img style="width: 60px;height:60px;object-fit:cover;" src="{{ url('storage/clients/', $client -> photo) }}" alt=""></td>
                                    <td>{{ $client -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if ($client -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('client.status.update',$client -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('client.status.update',$client -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('client.edit',$client -> id) }}"><i class="fa fa-edit"></i></a>
    
                                     <a class="btn btn-sm btn-danger" href="{{ route('client.trash.update', $client -> id ) }}"><i class="fa fa-trash"></i></a>
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
                <h4 class="card-title">Add Client</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('client.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="mb-1">Photo</label>
                        <input style="display:none;" name="photo" type="file" class="form-control" id="slider-photo">
                        <br>
                        <img style="max-width:100%; max-height:100%;" id="slide-photo-preview" src="" alt="">
                        <label for="slider-photo">
                           <img style="width:90px; height:90px;" src="admin/assets/img/slide1.png" alt="">
                        </label>
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
                <h4 class="card-title">Edit Client</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('client.update', $edit -> id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Title</label>
                        <input name="name" type="text" value="{{ $edit -> name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="mb-1">Photo</label>
                        <input style="display:none;" value="{{ $edit -> photo }}" name="new_photo" id="new-photo"type="file" class="form-control" >
                        <input style="display:none;" name="old_photo" type="file" class="form-control">
                        <br>
                        <img style="max-width:100%; max-height:50%;object-fit:cover;" id="slide-photo-preview" src="{{ url('storage/clients/'. $edit -> photo) }}" alt="">
                        <label for="new-photo">
                           <img style="width:50%; height:50%;" src="{{ url('admin/assets/img/slide1.png') }}" alt="">
                        </label>
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