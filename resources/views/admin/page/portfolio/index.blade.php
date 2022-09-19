@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Portfolio</h4>
                <a class="float-right text-danger" href="{{ route('Port.trash.page') }}">Trash <i class="fa fa-arrow-right"></i></a>
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
                                <th>Date</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($all_protfolio as $portfolio)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>{{ $portfolio -> title }}</td>
                                    <td>{{ $portfolio -> slug }}</td>
                                    <td>
                                      <ul class="ul-back-end">
                                        
                                        @forelse (json_decode($portfolio -> categoris) as $pcat)    
                                        <li><i style="margin-right:3px" class="fa fa-angle-right"></i>{{ $pcat -> name }}</li>
                                        @empty
                                            No Categoris
                                        @endforelse
                                        
                                      </ul>
                                    </td>
                                    <td>{{ date('F d, Y', strtotime($portfolio -> date)) }}</td>
                                    <td>{{ $portfolio -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if ($portfolio -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('Port.status.update',$portfolio -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('Port.status.update',$portfolio -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('portfolio.edit',$portfolio -> id) }}"><i class="fa fa-edit"></i></a>
    
                                     <a class="btn btn-sm btn-danger" href="{{ route('Port.trash.update', $portfolio -> id ) }}"><i class="fa fa-trash"></i></a>
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
                <h4 class="card-title">Add Portfolio</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="tname" type="text" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Featured Image</label>
                        <br>
                        <input style="display: none;" id="photo-id" name="featured" type="file" class="form-control">
                        <img style="max-width:100%; max-height:100%;" id="photo-preview" src="" alt="">
                        <label for="photo-id">
                          <img style="width:90px; height:90px;" src="admin/assets/img/slide1.png" alt="">
                        </label>  
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Gallery</label><br>
                       <div class="preview-gallery">
                        
                       </div>
                        <br>
                       <input style="display: none;" id="gallery" multiple name="gallery[]" type="file" class="form-control">
                       <label for="gallery"><img style="width:90px; height:90px;" src="admin/assets/img/gallery.png" alt=""></label>
                    </div>  
                    <div class="form-group">
                        <div id="accordion">
                            <div class="card shadow-sm">
                              <div class="card-header" id="headingOne">
                                <h5 style="cursor: pointer;" class="mb-0" data-toggle="collapse" data-target="#collapseOne">
                                   Stap-01
                                </h5>
                              </div>
                          
                              <div id="collapseOne" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  <div class="form-group my-3">
                                    <label>Title</label>
                                    <input name="title[]" type="text" class="form-control">
                                  </div>
                                  <div class="form-group my-3">
                                    <label>Description</label>
                                    <textarea name="decp[]" class="form-control"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card shadow-sm">
                              <div class="card-header" id="headingOne">
                                <h5 style="cursor: pointer;" class="mb-0" data-toggle="collapse" data-target="#collapseTow">
                                   Stap-02
                                </h5>
                              </div>
                          
                              <div id="collapseTow" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  <div class="form-group my-3">
                                    <label>Title</label>
                                    <input name="title[]" type="text" class="form-control">
                                  </div>
                                  <div class="form-group my-3">
                                    <label>Description</label>
                                    <textarea name="decp[]" class="form-control"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card shadow-sm">
                              <div class="card-header" id="headingOne">
                                <h5 style="cursor: pointer;" class="mb-0" data-toggle="collapse" data-target="#collapseTree">
                                   Stap-03
                                </h5>
                              </div>
                          
                              <div id="collapseTree" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  <div class="form-group my-3">
                                    <label>Title</label>
                                    <input name="title[]" type="text" class="form-control">
                                  </div>
                                  <div class="form-group my-3">
                                    <label>Description</label>
                                    <textarea name="decp[]" class="form-control"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                    </div>

                    <div class="form-group">
                        <label>Project Categoris</label>
                        <ul class="cats-ul-devs">
                          @foreach (json_decode($category) as $cates)
                          <li>
                            <input name="type[]" type="checkbox" value="{{ $cates -> id }}">
                            {{ $cates -> name}}
                          </li>
                          @endforeach
                        </ul>
                        
                    </div>
                    <div class="form-group">
                      <label>Client</label>
                      <input name="client" type="text" class="form-control">
                  </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input name="link" type="link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Project Type</label>
                        <input name="types" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input name="date" type="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label><br>
                          <textarea name="port_dec" id="portfolio_desc"></textarea>
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
                <h4 class="card-title">Edit Portfolio</h4>
            </div>

            @include('validate')
            <div class="card-body">
              <form action="{{ route('portfolio.update', $edit -> id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Title</label>
                    <input name="tname" type="text" value="{{ $edit -> title }}" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <label>Featured Image</label>
                    <br>
                    <input style="display: none;" id="photo-id" name="featured" type="file" class="form-control">
                    <img style="max-width:100%; max-height:100%;" id="photo-preview" src="{{ url('storage/port_feature/'. $edit -> featured) }}" alt="">
                    <label for="photo-id">
                      <img style="width:90px; height:90px;" src="{{ asset('admin/assets/img/slide1.png') }}" alt="">
                    </label>  
                </div>
                <hr>
                <div class="form-group">
                    <label>Gallery</label><br>
                   <div class="preview-gallery">
                    
                   </div>
                    <br>
                   <input style="display: none;" id="gallery" multiple name="gallery[]" type="file" class="form-control">
                    @foreach (json_decode($edit -> gallery) as $gall)
                    <img src="{{ url('storage/port_gallery/'.$gall -> gallery) }}" alt="">
                    @endforeach
                   <label for="gallery"><img style="width:90px; height:90px;" src="{{ asset('admin/assets/img/gallery.png') }}" alt=""></label>
                </div>  
                <div class="form-group">
                    <div id="accordion">
                        <div class="card shadow-sm">
                          <div class="card-header" id="headingOne">
                            <h5 style="cursor: pointer;" class="mb-0" data-toggle="collapse" data-target="#collapseOne">
                               Stap-01
                            </h5>
                          </div>
                      
                          <div id="collapseOne" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                              <div class="form-group my-3">
                                <label>Title</label>
                                <input name="title[]" value="{{ $edit -> title }}" type="text" class="form-control">
                              </div>
                              <div class="form-group my-3">
                                <label>Description</label>
                                <textarea name="decp[]" class="form-control">{!! htmlspecialchars_decode($edit -> dec) !!}</textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card shadow-sm">
                          <div class="card-header" id="headingOne">
                            <h5 style="cursor: pointer;" class="mb-0" data-toggle="collapse" data-target="#collapseTow">
                               Stap-02
                            </h5>
                          </div>
                      
                          <div id="collapseTow" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                              <div class="form-group my-3">
                                <label>Title</label>
                                <input name="title[]" value="{{ $edit -> title }}" type="text" class="form-control">
                              </div>
                              <div class="form-group my-3">
                                <label>Description</label>
                                <textarea name="decp[]" class="form-control">{!! htmlspecialchars_decode($edit -> dec) !!}</textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card shadow-sm">
                          <div class="card-header" id="headingOne">
                            <h5 style="cursor: pointer;" class="mb-0" data-toggle="collapse" data-target="#collapseTree">
                               Stap-03
                            </h5>
                          </div>
                      
                          <div id="collapseTree" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                              <div class="form-group my-3">
                                <label>Title</label>
                                <input name="title[]"  value="{{ $edit -> title }}" type="text" class="form-control">
                              </div>
                              <div class="form-group my-3">
                                <label>Description</label>
                                <textarea name="decp[]" class="form-control">{!! htmlspecialchars_decode($edit -> dec) !!}</textarea>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                </div>

                <div class="form-group">
                    <label>Project Categoris</label>
                    <ul class="cats-ul-devs">
                      @foreach (json_decode($category) as $cates)
                      <li>
                        <input name="type[]" type="checkbox" value="{{ $edit -> name }}" value="{{ $cates -> id }}">
                        {{ $cates -> name}}
                      </li>
                      @endforeach
                    </ul>
                    
                </div>
                <div class="form-group">
                  <label>Client</label>
                  <input name="client" type="text" value="{{ $edit -> client }}" class="form-control">
              </div>
                <div class="form-group">
                    <label>Link</label>
                    <input name="link" type="link" value="{{ $edit -> link }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Project Type</label>
                    <input name="types" value="{{ $edit -> type }}" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input name="date" type="date" value="{{ $edit -> date }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label><br>
                      <textarea name="port_dec" id="portfolio_desc">{{ $edit -> dec }}</textarea>
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