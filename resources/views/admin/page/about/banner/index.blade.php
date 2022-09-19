@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All About Banner</h4>
                <a class="float-right text-danger" href="{{ route('banner.trash') }}">Trash <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Banner Image</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_banner as $banner)
                                <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                <td>{{ $banner -> title }}</td>
                                <td><img class="img-height-width" src="{{ url('storage/about_banner/'.$banner -> image) }}" alt=""></td>
                                <td>{{ $banner -> created_at -> diffForHumans() }}</td>
                                <td>
                                    @if ($banner -> status)
                                        <span class="badge badge-success">Active</span>
                                        <a class="text-danger" href="{{ route('banner.status.update',$banner -> id,) }}"><i class="fa fa-times"></i></a>
                                    @else
                                        <span class="badge badge-danger">Blocked</span>
                                        <a class="text-success" href="{{ route('banner.status.update',$banner -> id) }}"><i class="fa fa-check"></i></a>
                                    @endif
                                </td>
                                <td>  
                                    <a class="btn btn-sm btn-warning" href="{{ route('about-banner.edit',$banner -> id) }}"><i class="fa fa-edit"></i></a>

                                 <a class="btn btn-sm btn-danger" href="{{ route('banner.trash.update', $banner -> id ) }}"><i class="fa fa-trash"></i></a>
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
                <h4 class="card-title">Add About Banner</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('about-banner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input name="sub" type="text" class="form-control">
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
                <h4 class="card-title">Edit About Banner</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('about-banner.update', $edit_banner -> id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ $edit_banner -> title }}"  class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input name="sub" type="text" value="{{ $edit_banner -> subtitle }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="mb-1">Photo</label>
                        <input style="display:none;" name="new_photo" type="file" class="form-control" id="slider-photo">
                        <input style="display:none;" name="old_photo" type="file" class="form-control" id="slider-photo">
                        <br>
                        <img style="max-width:100%; max-height:100%;" id="slide-photo-preview" src="{{ url('storage/about_banner/'. $edit_banner -> image) }}" alt="">
                        <label for="slider-photo">
                           <img style="width:90px; height:90px;" src="{{ asset('admin/assets/img/slide1.png') }}" alt="">
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