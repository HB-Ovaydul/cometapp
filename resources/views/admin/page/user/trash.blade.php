@extends('admin.layouts.app')
@section('main-content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">Recycle Bin</h4>
                <a class="float-right" href="{{ route('admin-user.index') }}">Back <i class="fa fa-arrow-right"></i></a>
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
                                <th>Restore</th>
                                <th>Delete</th>
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
                                    @if ($admin -> trash)
                                        <a class="" href="{{ route('admin.trash.update',$admin -> id,) }}"><span class="badge badge-info">Restore User</span></a>
                                    @endif
                                </td>
                                <td>
                                    <form  class="d-inline" action="{{ route('admin-user.destroy',$admin -> id ) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                           <button class="delete btn border-none p-0"><span class="badge badge-danger">Permanently Delete</span></button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @empty
                                <tr>
                                    <td colspan="7" class="bg-dark text-center text-light">Data Not Found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection