@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Expertise Trash</h4>
                <a class="float-right text-danger" href="{{ route('expertise.index') }}">Trash <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Create_at</th>
                                <th>Restore</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($trash_exper as $etrash)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $etrash -> name }}</td>
                                    <td>
                                        @if (isset($etrash -> ex_photo))
                                        <img style="width: 60px;height:60px;object-fit:cover;" src="{{ url('storage/expertise/', $etrash -> ex_photo) }}" alt="">
                                        @else
                                            No Photo!
                                        @endif
                                    </td>
                                    <td>{{ $etrash -> created_at -> diffForHumans() }}</td>
                                    <td>
                                    @if ($etrash -> trash)
                                        <a class="" href="{{ route('ex.Update.trash',$etrash -> id,) }}"><span class="badge badge-info">Restore User</span></a>
                                    @endif
                                </td>
                                <td>
                                    <form  class="d-inline" action="{{ route('expertise.destroy',$etrash -> id ) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                           <button class="delete btn border-none p-0"><span class="badge badge-danger">Permanently Delete</span></button>
                                    </form>
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
</div>
@endsection