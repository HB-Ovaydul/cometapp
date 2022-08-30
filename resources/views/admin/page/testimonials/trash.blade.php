@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Testimonial Trash</h4>
                <a class="float-right text-danger" href="{{ route('testimonial.index') }}">Trash <i class="fa fa-arrow-right"></i></a>
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
                                <th>Restore</th>
                                <th>Delete</th>
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
                                    @if ($testi -> trash)
                                        <a class="" href="{{ route('test.trash.update',$testi -> id,) }}"><span class="badge badge-info">Restore User</span></a>
                                    @endif
                                </td>
                                <td>
                                    <form  class="d-inline" action="{{ route('testimonial.destroy',$testi -> id ) }}" method="post">
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