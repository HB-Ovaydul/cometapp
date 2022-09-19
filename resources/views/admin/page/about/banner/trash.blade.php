@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All About Banner Trash Page</h4>
                <a class="float-right text-danger" href="{{ route('about-banner.index') }}">Trash <i class="fa fa-arrow-right"></i></a>
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
                                <th>Restore</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_trash as $trash)
                                <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                <td>{{ $trash -> title }}</td>
                                <td><img class="img-height-width" src="{{ url('storage/about_banner/'.$trash -> image) }}" alt=""></td>
                                <td>{{ $trash -> created_at -> diffForHumans() }}</td>
                                <td>
                                    @if ($trash -> trash)
                                        <a class="" href="{{ route('banner.trash.update',$trash -> id,) }}"><span class="badge badge-info">Restore User</span></a>
                                    @endif
                                </td>
                                <td>
                                    <form  class="d-inline" action="{{ route('about-banner.destroy',$trash -> id ) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                           <button class="delete btn border-none p-0"><span class="badge badge-danger">Permanently Delete</span></button>
                                    </form>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection