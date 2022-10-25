@extends('admin.layouts.app')

@section('main-content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline justify-content-between">All Post</h4>
                <a class="float-right text-danger" href="{{ route('post.trash.page') }}">Trash <i class="fa fa-arrow-right"></i></a>
            </div>
            <div class="card-body">
                @include('validate-main')
                <div class="table-responsive">
                    <table class="table mb-0 data-table-ov">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tag</th>
                                <th>Categoris</th>
                                <th>Featured</th>
                                <th>Date</th>
                                <th>Create_at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($all_post as $post)
                               <tr>
                                    <td>{{ $loop -> index + 1 }}</td>
                                    <td>
                                        <ul class="ul-back-end">
                                                @forelse ($post -> tag as $tags)
                                                <li>
                                                    <i style="margin-right:3px" class="fa fa-angle-right"></i>
                                                    {{ $tags -> tname }} 
                                                </li> 
                                                @empty
                                                No Categoris
                                                @endforelse
                                        </ul>
                                    </td>
                                    <td>
                                      <ul class="ul-back-end">
                                        
                                        @forelse ($post -> postcat as $pcat)    
                                        <li><i style="margin-right:3px" class="fa fa-angle-right"></i>{{ $pcat -> cname }}</li>
                                        @empty
                                            No Categoris
                                        @endforelse
                                        
                                      </ul>
                                    </td>
                                    <td>
                                        @php
                                            $feature = json_decode($post -> feature_image);
                                            echo $feature -> post_type;
                                        @endphp
                                    </td>
                                    <td>{{ date('F d, Y', strtotime($post -> date)) }}</td>
                                    <td>{{ $post -> created_at -> diffForHumans() }}</td>
                                    <td>
                                        @if ($post -> status)
                                            <span class="badge badge-success">Active User</span>
                                            <a class="text-danger" href="{{ route('post.status.update',$post -> id,) }}"><i class="fa fa-times"></i></a>
                                        @else
                                            <span class="badge badge-danger">Blocked User</span>
                                            <a class="text-success" href="{{ route('post.status.update',$post -> id) }}"><i class="fa fa-check"></i></a>
                                        @endif
                                    </td>
                                    <td>  
                                        <a class="btn btn-sm btn-warning" href="{{ route('post-admin.edit',$post -> id) }}"><i class="fa fa-edit"></i></a>
    
                                     <a class="btn btn-sm btn-danger" href="{{ route('post.trash.update', $post -> id ) }}"><i class="fa fa-trash"></i></a>
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
                <h4 class="card-title">Add Post</h4>
            </div>

            @include('validate')
            <div class="card-body">
                <form action="{{ route('post-admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Post Type</label>
                        <select name="type" id="comet-blog" class="form-control">
                            <option value="Standard">Standard</option>
                            <option value="Gallery">Gallery</option>
                            <option value="Video">Video</option>
                            <option value="Audio">Audio</option>
                            <option value="Qoute">Qoute</option>
                        </select>
                    </div>
                    
                    <div class="form-group post-standard">
                        <label>Featured Image</label>
                        <br>
                        <input style="display: none;" id="photo-id" name="featured" type="file" class="form-control">
                        <img style="max-width:100%; max-height:100%;" id="photo-preview" src="" alt="">
                        <label for="photo-id">
                          <img style="width:90px; height:90px;" src="admin/assets/img/slide1.png" alt="">
                        </label>  
                    </div>
                    <div class="form-group post-gallery">
                        <label>Gallery</label><br>
                       <div class="preview-gallery">
                        
                       </div>
                        <br>
                       <input style="display: none;" id="gallery" multiple name="gallery[]" type="file" class="form-control">
                       <label for="gallery"><img style="width:90px; height:90px;" src="admin/assets/img/gallery.png" alt=""></label>
                    </div>
                    <div class="form-group post-video">
                        <label>Video</label>
                        <input name="video" type="text" class="form-control">
                    </div>
                    <div class="form-group post-audio">
                        <label>Audio</label>
                        <input name="audio" type="text" class="form-control">
                    </div>
                    <div class="form-group post-qoute">
                        <label>Qoute</label>
                        <textarea name="qoute" id="" cols="3" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Post Description</label>
                        <textarea name="content" id="portfolio_desc" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Post Category</label>
                        <ul class="cats-ul-devs">
                            @foreach ($post_category as $post_cat)
                                <li><input name="category[]" value="{{ $post_cat -> id }}" type="checkbox">{{ $post_cat -> cname }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Post Tag</label>
                        <select class="form-control comet-select" multiple name="tag[]" id="">
                             @foreach ($post_tag as $tag)
                             <option value="{{ $tag -> id }}">{{ $tag -> tname }}</option>
                             @endforeach
                        </select>
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
                <h4 class="card-title">Edit Post</h4>
            </div>
            @include('validate')
            <div class="card-body">
             <form action="{{ route('post-admin.update', $edit -> id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ $edit -> title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        @php
                            $featur = json_decode($edit -> feature_image);
                            
                        @endphp
                        <label>Post Type</label>
                        <select name="type" id="comet-blog" class="form-control">
                            <option value="Standard" @if($featur -> post_type == 'Standard') selected @endif>Standerd</option> 
                            <option value="Gallery" @if($featur -> post_type == 'Gallery') selected @endif>Gallery</option>
                            <option value="Video" @if($featur -> post_type == 'Video') selected @endif>Video</option>
                            <option value="Audio" @if($featur -> post_type == 'Audio') selected @endif>Audio</option>
                            <option value="Qoute" @if($featur -> post_type == 'Qoute') selected @endif>Qoute</option>
                        </select>
                    </div>
                    
                    <div class="form-group post-standard">
                        <label>Featured Image</label>
                        <br>
                        @php
                            $featured = json_decode($edit -> feature_image);
                            echo $featured -> post_type;
                        @endphp
                        <input style="display: none;" id="photo-id" name="old_featured" type="file" class="form-control">
                        <input style="display: none;" id="photo-id" name="new_featured" type="file" class="form-control">
                        <img style="max-width:100%; max-height:100%;" id="photo-preview" src="{{ url('storage/post_feature/'. $featured -> standerd) }}" alt="">
                        <label for="photo-id">
                          <img style="width:90px; height:90px;" src="{{ asset('admin/assets/img/slide1.png') }}" alt="">
                        </label>  
                    </div>
                    <div class="form-group post-gallery">
                        <label>Gallery</label><br>
                        <br>
                       <input style="display: none;" id="gallery" multiple name="gallery[]" type="file" class="form-control">
                       <div class="preview-gallery">
                        @foreach (json_decode($featured -> gallery) as $gall)
                            <img src="{{ url('storage/post_gallery/'.$gall) }}" alt="">
                        @endforeach
                        </div>
                       <label for="gallery"><img style="width:90px; height:90px;" src="{{ asset('admin/assets/img/gallery.png') }}" alt=""></label>
                    </div>
                    <div class="form-group post-video">
                        <label>Video</label>
                        <input name="video" type="text" value="{{ $edit -> video }}" class="form-control">
                    </div>
                    <div class="form-group post-audio">
                        <label>Audio</label>
                        <input name="audio" type="text" value="{{ $edit -> audio }}" class="form-control">
                    </div>
                    <div class="form-group post-qoute">
                        <label>Qoute</label>
                        <textarea name="qoute" id="" cols="3" rows="3" class="form-control">{!! htmlspecialchars_decode($edit -> qoute) !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Post Description</label>
                        <textarea name="content" id="portfolio_desc" cols="30" rows="10">{!! htmlspecialchars_decode($edit -> content) !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Post Category</label>
                        <ul class="cats-ul-devs">
                            @foreach (json_decode($edit -> postcat) as $postc)
                                @php
                                    $postdata[] = $postc -> id;
                                @endphp
                            @endforeach
                            @foreach ($post_category as $post_cat)
                                <li><label><input name="category[]" value="{{ $post_cat -> id }}" @if( in_array($post_cat -> id , $postdata)) checked @endif() type="checkbox">{{ $post_cat -> cname }}</label></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Post Tag</label>
                        <select class="form-control comet-select" multiple name="tag[]" id="tags">
                            @foreach (json_decode($edit -> tag) as $tagitem)
                                @php
                                 $datas[] = $tagitem -> id;
                                 $datas;
                                @endphp
                            @endforeach
                             @foreach ($post_tag as $tag)
                             <option value="{{ $tag -> id }}" {{ in_array($tag -> id, $datas) ? 'selected' : '' }} >{{ $tag -> tname }}</option>
                             @endforeach
                        </select>
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