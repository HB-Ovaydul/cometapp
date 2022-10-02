@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">Portfolio Work Together</h4>
                <a class="float-right text-danger" href="{{ route('work.trash.page') }}">Trash <i class="fa fa-arrow-right"></i></a>
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
                            @foreach ($port_work as $work)
                                <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                <td>{{ $work -> title }}</td>
                                <td><img class="img-height-width" src="{{ url('storage/port_work/'.$work -> photo) }}" alt=""></td>
                                <td>{{ $work -> created_at -> diffForHumans() }}</td>
                                <td>
                                    @if ($work -> status)
                                        <span class="badge badge-success">Active</span>
                                        <a class="text-danger" href="{{ route('work.status.update',$work -> id,) }}"><i class="fa fa-times"></i></a>
                                    @else
                                        <span class="badge badge-danger">Blocked</span>
                                        <a class="text-success" href="{{ route('work.status.update',$work -> id) }}"><i class="fa fa-check"></i></a>
                                    @endif
                                </td>
                                <td>  
                                    <a class="btn btn-sm btn-warning" href="{{ route('portfolio-work.edit',$work -> id) }}"><i class="fa fa-edit"></i></a>

                                 <a class="btn btn-sm btn-danger" href="{{ route('work.trash.update', $work -> id ) }}"><i class="fa fa-trash"></i></a>
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
                <h4 class="card-title">Add Work Together</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('portfolio-work.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label>Apply Button</label>
                        <input name="btn" type="link" placeholder="Optional" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="mb-1">Photo</label>
                        <input style="display:none;" name="photo" type="file" class="form-control" id="slider-photo">
                        <br>
                        <img style="max-width:100%; max-height:100%;" id="slide-photo-preview" src="" alt="">
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

    @if ($form_type == 'edit')
    <div class="col-xl-3 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4 class="card-title">Edit Work Together</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('portfolio-work.update', $edit -> id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" value="{{ $edit -> title }}" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input name="sub" type="text" value="{{ $edit -> subtitle }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Apply Button</label>
                        <input name="btn" type="link" placeholder="Optional" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="mb-1">Photo</label>
                        <input style="display:none;"  name="new_photo" type="file" class="form-control" id="slider-photo">
                        <input style="display:none;" name="old_photo" type="hidden" class="form-control" id="slider-photo">
                        <br>
                        <img style="max-width:100%; max-height:100%;" id="slide-photo-preview" src="{{ url('storage/port_work/'.$edit -> photo) }}" alt="">
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
