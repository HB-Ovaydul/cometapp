@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Portfolio Category Trash</h4>
                <a class="float-right text-danger" href="{{ route('product-category.index') }}">Back To Home<i class="fa fa-arrow-right"></i></a>
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
                           @forelse ($product_trash as $trash)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $trash -> name }}</td>
                                    <td>{{ $trash -> slug }}</td>
                                    <td>{{ $trash -> created_at -> diffForHumans()}}</td>
                                    <td>
                                    @if ($trash -> trash)
                                        <a class="" href="{{ route('product.trash.update',$trash -> id,) }}"><span class="badge badge-info">Restore User</span></a>
                                    @endif
                                </td>
                                <td>
                                    <form  class="d-inline" action="{{ route('categorypost.destroy',$trash -> id ) }}" method="post">
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