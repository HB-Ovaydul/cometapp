@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Vision</h4>
                <a class="float-right text-danger" href="{{ route('vision.trash.page') }}">Trash<i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Photo</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($all_vision as $vision)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $vision -> title }}</td>
                                    <td><img style="width: 60px;height:60px;object-fit:cover;" src="{{ url('storage/vision/'.$vision -> photo) }}" alt=""></td>
                                    <td>{{ $vision -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if ($vision -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('vision.status.update',$vision -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('vision.status.update',$vision -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('vision.edit',$vision -> id) }}"><i class="fa fa-edit"></i></a>
    
                                     <a class="btn btn-sm btn-danger" href="{{ route('vision.trash.update', $vision -> id ) }}"><i class="fa fa-trash"></i></a>
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
                <h4 class="card-title">Add Vision</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('vision.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                            <textarea name="dec" rows="5" cols="5" class="form-control" placeholder="Enter text here">      
                        </textarea>
                    </div>

                    <div class="form-group">
                        <img style="max-width:100%; max-height:100%;" id="photo_viwe" src="" alt="">
                        <br>
                        <input style="display: none;" id="photo_id" name="photo" type="file" class="form-control">
                            {{-- <img style="max-width:100%; max-height:100%;" src="" alt=""> --}}
                            <label for="photo_id"><img  src="admin/assets/img/slide1.png" alt=""></label>
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
              <h4 class="card-title">Edit Vision</h4>
          </div>

          @include('validate')
          <div class="card-body">
            <form action="{{ route('vision.update', $edit -> id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Title</label>
                    <input name="title" type="text" value="{{ $edit -> title }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                        <textarea name="dec" rows="5" cols="5" class="form-control" placeholder="Enter text here"> {{  $edit -> dec }}     
                    </textarea>
                </div>
                <div class="form-group">
                    <img style="max-width:100%; max-height:100%;" id="photo_viwe" src="{{ url('storage/vision/'. $edit -> photo) }}" alt="">
                    <br>
                    <input id="photo_viwe" style="display: none;" id="photo_id" name="old_photo" type="file" class="form-control">
                    <input style="display: none;" id="photo_id" name="new_photo" type="file" class="form-control">
                    <label for="photo_id"><img src="{{ url('admin/assets/img/slide1.png') }}" alt=""></label>
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