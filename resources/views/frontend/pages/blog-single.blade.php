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

  {{-- @php
    if(isset($_GET['search'])){
        $key = $_GET['search'];
        $post_page = App\Models\Post::where('title','LIKE','%'.$key.'%')-> orwhere('content', 'LIKE','%'.$key.'%')->get();
    }
  @endphp --}}

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
            <article class="post-single">
                @php
                $fearturs = json_decode($post_page -> feature_image);
                @endphp
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
                <p>{!! htmlspecialchars_decode($post_page -> content) !!}</p>
              </div>
            </article>

          <!-- end of article-->
          <div id="comments">
            <h5 class="upper">3 Comments</h5>
            <ul class="comments-list">
              <li>
                <div class="comment">
                  <div class="comment-pic">
                    <img src="images/team/1.jpg" alt="" class="img-circle">
                  </div>
                  <div class="comment-text">
                    <h5 class="upper">Jesse Pinkman</h5><span class="comment-date">Posted on 29 September at 10:41</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime distinctio et quam possimus velit dolor sunt nisi neque, harum, dolores rem incidunt, esse ipsa nam facilis eum doloremque numquam veniam.</p><a href="#" class="comment-reply">Reply</a>
                  </div>
                </div>
                <ul class="children">
                  <li>
                    <div class="comment">
                      <div class="comment-pic">
                        <img src="images/team/2.jpg" alt="" class="img-circle">
                      </div>
                      <div class="comment-text">
                        <h5 class="upper">Arya Stark</h5><span class="comment-date">Posted on 29 September at 10:41</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque porro quae harum dolorem exercitationem voluptas illum ipsa sed hic, cum corporis autem molestias suscipit, illo laborum, vitae, dicta ullam minus.</p><a href="#"
                        class="comment-reply">Reply</a>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
              <li>
                <div class="comment">
                  <div class="comment-pic">
                    <img src="images/team/3.jpg" alt="" class="img-circle">
                  </div>
                  <div class="comment-text">
                    <h5 class="upper">Rust Cohle</h5><span class="comment-date">Posted on 29 September at 10:41</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deleniti sit beatae natus! Beatae velit labore, numquam excepturi, molestias reiciendis, ipsam quas iure distinctio quia, voluptate expedita autem explicabo illo.</p>
                    <a
                    href="#" class="comment-reply">Reply</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <!-- end of comments-->
          <div id="respond">
            <h5 class="upper">Leave a comment</h5>
            <div class="comment-respond">
              <form action="{{ route('user.comment') }}" method="POST" class="comment-form">
                @csrf
                <div class="form-double">
                  <div class="form-group">
                    <input name="author" type="text" placeholder="Name" class="form-control">
                  </div>
                  <div class="form-group last">
                    <input name="email" type="text" placeholder="Email" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <textarea name="comment" placeholder="Comment" class="form-control"></textarea>
                </div>
                <div class="form-submit text-right">
                  <button type="submit" class="btn btn-color-out">Post Comment</button>
                </div>
              </form>
            </div>
          </div>
          <div class="fb-comments" data-href="http://localhost:8000/{{ $post_page -> id }}" data-width="" data-numposts="10"></div>
        </div>
            <!-- end of comment form-->
            <!--Sidebar-->
            <div class="col-md-3 col-md-offset-1">
            @include('frontend.layouts.post-sidbar')
            </div>
            <!--Sidebar-->
      </div>
    </div>
  </section>

@endsection