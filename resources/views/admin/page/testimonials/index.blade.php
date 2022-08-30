@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Testimonials</h4>
                <a class="float-right text-danger" href="{{ route('test.trash') }}">Trash <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Company Name</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($testimonial as $testi)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $testi -> name }}</td>
                                    <td>{{ $testi -> company }}</td>
                                    <td>{{ $testi -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if ($testi -> status)
                                            <span class="badge badge-success">Active</span>
                                            <a class="text-danger" href="{{ route('test.status.update',$testi -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked</span>
                                            <a class="text-success" href="{{ route('test.status.update',$testi -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('testimonial.edit',$testi -> id) }}"><i class="fa fa-edit"></i></a>
    
                                        {{-- <form  class="d-inline" action="{{ route('admin-user.destroy',$admin -> id ) }}" method="post">
                                        @csrf
                                        @method('DELETE')
    
                                           <button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
                                        </form> --}}
    
                                        <a class="btn btn-sm btn-danger" href="{{ route('test.trash.update', $testi -> id ) }}"><i class="fa fa-trash"></i></a>
                                    </td>
                               </tr>
                           @empty
                               <tr>
                                <td colspan="8" class="text-light bg-dark text-center center">Record No Found!</td>
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
                <h4 class="card-title">Add Testimonial</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('testimonial.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Company</label>
                        <input name="company" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Textarea</label>
                        <div>
                            <textarea name="text" rows="5" cols="5" class="form-control" placeholder="Enter text here"></textarea>
                        </div>
                    </div>

                    {{-- <div class="form-group btn-slide-option">
                        <hr>

                        <a id="add-slide-preview-option" class="btn btn-sm btn-info" href="#">Add New Button</a>
                    </div> --}}

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
                <h4 class="card-title">Edit Testimonial</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('testimonial.update', $edit_testi -> id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input name="name" type="text" value="{{ $edit_testi -> name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Company</label>
                        <input name="company" type="text" value="{{ $edit_testi -> company }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Textarea</label>
                        <div>
                            <textarea name="text" rows="5" cols="5" class="form-control" placeholder="Enter text here">{{ $edit_testi -> details }}</textarea>
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