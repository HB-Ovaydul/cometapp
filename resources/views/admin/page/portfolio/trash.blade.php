@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Portfolio Category Trash</h4>
                <a class="float-right text-danger" href="{{ route('portfolio.index') }}">Back To Home<i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Categoris</th>
                                <th>Featuerd</th>
                                <th>Create_at</th>
                                <th>Restore</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($all_protfolio as $trash)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $trash -> title }}</td>
                                    <td>{{ $trash -> slug }}</td>
                                    <td>
                                        <ul class="ul-back-end">
                                          
                                          @forelse (json_decode($trash -> categoris) as $pcat)    
                                          <li><i style="margin-right:3px" class="fa fa-angle-right"></i>{{ $pcat -> name }}</li>
                                          @empty
                                              No Categoris
                                          @endforelse
                                          
                                        </ul>
                                      </td>
                                      <td><img style="max-width: 25px; height:25px;object-fit:cover;" src="{{ url('storage/port_feature/'. $trash -> featured) }}" alt=""></td>
                                    <td>{{ $trash -> created_at -> diffForHumans() }}</td>
                                    <td>
                                    @if ($trash -> trash)
                                        <a class="" href="{{ route('Port.trash.update',$trash -> id,) }}"><span class="badge badge-info">Restore User</span></a>
                                    @endif
                                </td>
                                <td>
                                    <form  class="d-inline" action="{{ route('portfolio.destroy',$trash -> id ) }}" method="post">
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