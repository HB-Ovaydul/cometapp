@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Sliders</h4>
                <a class="float-right text-danger" href="{{ route('slide.tash') }}">Trash <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Photo</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($all_slide as $slide)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $slide -> title }}</td>
                                    <td>{{ $slide -> subtitle }}</td>
                                    <td><img style="width: 60px;height:60px;object-fit:cover;" src="{{ url('storage/admin_photo/', $slide -> photo) }}" alt=""></td>
                                    <td>{{ $slide -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if ($slide -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('slide.status',$slide -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('slide.status',$slide -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('slide.edit',$slide -> id) }}"><i class="fa fa-edit"></i></a>
    
                                        {{-- <form  class="d-inline" action="{{ route('admin-user.destroy',$admin -> id ) }}" method="post">
                                        @csrf
                                        @method('DELETE')
    
                                           <button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
                                        </form> --}}
    
                                        <a class="btn btn-sm btn-danger" href="{{ route('slide.move.tash', $slide -> id ) }}"><i class="fa fa-trash"></i></a>
                                    </td>
                               </tr>
                           @empty
                               <tr>
                                <td colspan="5" class="text-light bg-dark center center">Record No Found!</td>
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
                <h4 class="card-title">Add Slider</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('slide.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Subtitle</label>
                        <input name="subtitle" type="text" class="form-control">
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
                    <div class="form-group btn-slide-option">
                        <hr>

                        <a id="add-slide-preview-option" class="btn btn-sm btn-info" href="#">Add New Button</a>
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
                <h4 class="card-title">Edit Slider</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('slide.update', $edit_id -> id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Title</label>
                        <input name="title" type="text" value="{{ $edit_id -> title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Subtitle</label>
                        <input name="subtitle" type="text" value="{{ $edit_id -> subtitle }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="mb-1">Photo</label>
                        <input style="display:none;" value="{{ $edit_id -> photo }}" name="new_photo" id="new-photo"type="file" class="form-control" >
                        <input style="display:none;" name="old_photo" type="file" class="form-control">
                        <br>
                        <img style="max-width:100%; max-height:50%;object-fit:cover;" id="slide-photo-preview" src="{{ url('storage/admin_photo/'. $edit_id -> photo) }}" alt="">
                        <label for="new-photo">
                           <img style="width:50%; height:50%;" src="{{ url('admin/assets/img/slide1.png') }}" alt="">
                        </label>
                    </div>
                    <div class="form-group btn-slide-option">
                        <hr>


                        @foreach (json_decode($edit_id -> button) as $edit_btn)
                        <div class="btn-slider-area">
                            <span>Button#<span>
                            <span style="margin-left:390px;cursor:pointer;" class="badge badge-danger button-romove">Remove</span>
                            <input name="btn_title[]" class="form-control" type="text" id="" value="{{ $edit_btn -> btn_title }}" placeholder="Button Title">
                            <input name="btn_link[]" class="form-control" type="text" id="" value="{{ $edit_btn -> btn_link }}" placeholder="Button link">
                            <label>
                                <select class="form-control select" name="btn_type[]">
                                    <option @if ($edit_btn -> btn_type == 'btn btn-color') selected @endif value="btn btn-color">Default</option>
                                    <option @if ($edit_btn -> btn_type == 'btn btn-light-out') selected @endif value="btn btn-light-out">Red</option>
                                </select>
                            </label>
                            </div>

                        <a id="add-slide-preview-option" class="btn btn-sm btn-info" href="#">Add New Button</a>
                        @endforeach


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