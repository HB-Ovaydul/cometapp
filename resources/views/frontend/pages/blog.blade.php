@extends('frontend.layouts.app')
@section('content')
<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="frontend/images/bg/18.jpg" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">This is our blog<span class="red-dot"></span></h1>
              <h4>We have a few tips for you.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
  </section>

  @php
    if(isset($_GET['search'])){
        $key = $_GET['search'];
        $all_post_page = App\Models\Post::where('title','LIKE','%'.$key.'%')-> orwhere('content', 'LIKE','%'.$key.'%')->get();
    }
  @endphp

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="blog-posts">
            @foreach ($all_post_page as $post_page)
            @php
                $fearturs = json_decode($post_page -> feature_image);
            @endphp
            <article class="post-single">
              <div class="post-info">
                  <h2><a href="#">{{ $post_page -> title }}</a></h2>
                  <h6 class="upper"><span>By</span><a href="#"> {{ $post_page -> author -> name}}</a><span class="dot"></span><span>{{ date('F, d, Y', strtotime($post_page -> created_at)) }}</span><span class="dot"></span>
                    @foreach ( $post_page -> tag as $tag)
                         <a href="#" class="post-tag">{{ $tag -> tname }} @if(( $loop -> index + 1 ) < count($post_page -> tag)) - @endif</a>
                    @endforeach
                  </h6>
                </div>
              @if ($fearturs -> post_type == 'Gallery')
                <div class="post-media">
                  <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">
                    <ul class="slides">
                        @foreach (json_decode($fearturs->gallery) as $gall)
                        <li>
                            <img src="{{ url('storage/post_gallery/'.$gall) }}" alt="">
                          </li>
                        @endforeach
                    </ul>
                  </div>
                </div>
              @endif
            @if ($fearturs -> post_type == 'Standard')
              <div class="post-media">
                <a href="#">
                  <img src="{{ url('storage/post_feature/'.$fearturs -> standerd) }}" alt="">
                </a>
              </div>
            @endif
            @if ($fearturs -> post_type == 'Video')
                <div class="post-media">
                  <div class="media-video">
                    <iframe src="{{ $fearturs -> video }}" frameborder="0"></iframe>
                  </div>
                </div>
            @endif
            @if ($fearturs -> post_type == 'Qoute')
                <div class="post-body">
                  <blockquote class="italic">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et quam neque facilis similique laborum, nihil id ratione, error illum. Porro quas maxime accusamus numquam consequatur consequuntur eveniet quis, fuga repellendus.</p>
                  </blockquote>
                </div>
            @endif
            @if ($fearturs -> post_type == 'Audio')
                <div class="post-media">
                  <div class="media-audio">
                    <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/51057943&amp;amp;color=ff5500&amp;amp;auto_play=false&amp;amp;hide_related=false&amp;amp;show_comments=true&amp;amp;show_user=true&amp;amp;show_reposts=false"
                    frameborder="0"></iframe>
                  </div>
                </div>
            @endif
            <div class="post-body">
              <p>{!! Str::of(htmlspecialchars_decode($post_page -> content))-> words('40', '....') !!}</p>
              <p><a href="{{ route('blog.single.page',$post_page -> slug ) }}" class="btn btn-color btn-sm">Read More</a>
              </p>
            </div>
          </article>
          @endforeach
          <ul class="pagination">
            <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="ti-arrow-left"></i></span></a>
            </li>
            <li class="active"><a href="#">1</a>
            </li>
            <li><a href="#">2</a>
            </li>
            <li><a href="#">3</a>
            </li>
            <li><a href="#">4</a>
            </li>
            <li><a href="#">5</a>
            </li>
            <li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="ti-arrow-right"></i></span></a>
            </li>
          </ul>
        </div>
          <!-- end of pagination-->
      </div>
      <div class="col-md-3 col-md-offset-1">
        @include('frontend.layouts.post-sidbar')
        <!-- end of sidebar-->
      </div>
      <!-- end of row-->
    </div>
  </div>
    <!-- end of container-->
  </section>
@endsection