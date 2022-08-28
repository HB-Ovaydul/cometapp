@extends('admin.layouts.app')
@section('main-content')
<div class="card-body">
    <div class="card-header">
        <h4 class="card-title d-inline justify-content-between">All Slider Trash</h4>
        <a class="float-right" href="{{ route('slide.index') }}">Back <i class="fa fa-arrow-right"></i></a>
    </div>
    @include('validate-main')
    <div class="table-responsive">
        <table class="table mb-0 data-table-ov">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @forelse ($all_trash as $trash)
                   <tr>
                        <td>{{ $loop -> index + 1 }}</td>
                        <td>{{ $trash -> title }}</td>
                        <td>{{ $trash -> subtitle }}</td>
                        <td><img style="width: 60px;height:60px;object-fit:cover;" src="{{ url('storage/admin_photo/', $trash -> photo) }}" alt=""></td>
                        <td>
                            @if ($trash -> trash)
                                <a class="" href="{{ route('slide.move.tash',$trash -> id,) }}"><span class="badge badge-info">Restore User</span></a>
                            @endif
                        </td>
                        <td>
                            <form  class="d-inline" action="{{ route('slide.destroy',$trash -> id ) }}" method="post">
                                @csrf
                                @method('DELETE')
                                   <button class="delete btn border-none p-0"><span class="badge badge-danger">Permanently Delete</span></button>
                            </form>
                        </td>
                   </tr>
               @empty
                   <tr>
                    <td colspan="5" class="text-light bg-dark text-center">Record No Found!</td>
                   </tr>
               @endforelse


            </tbody>
        </table>
    </div>
</div>

@endsection