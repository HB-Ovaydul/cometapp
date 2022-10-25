@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Post Trash Page</h4>
                <a class="float-right text-danger" href="{{ route('post-admin.index') }}">Back To Home<i class="fa fa-arrow-right"></i></a>
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
                           @forelse ($post_trash as $trash)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>
                                        <ul class="ul-back-end">
                                            @forelse ($trash -> tag as $tags)
                                            <li>
                                                <i style="margin-right:3px" class="fa fa-angle-right"></i>
                                                {{ $tags -> tname }} 
                                            </li> 
                                            @empty
                                            No Categoris
                                            @endforelse
                                    </ul>
                                    </td>
                                    <td><ul class="ul-back-end">
                                        
                                        @forelse ($trash -> postcat as $pcat)    
                                        <li><i style="margin-right:3px" class="fa fa-angle-right"></i>{{ $pcat -> cname }}</li>
                                        @empty
                                            No Categoris
                                        @endforelse
                                        
                                      </ul>
                                    </td>
                                    <td>{{ $trash -> created_at -> diffForHumans()}}</td>
                                    <td>
                                    @if ($trash -> trash)
                                        <a class="" href="{{ route('post.trash.update',$trash -> id,) }}"><span class="badge badge-info">Restore User</span></a>
                                    @endif
                                </td>
                                <td>
                                    <form  class="d-inline" action="{{ route('tag.destroy',$trash -> id ) }}" method="post">
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