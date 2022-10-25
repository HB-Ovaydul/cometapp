<div class="sidebar hidden-sm hidden-xs">
    <div class="widget">
      <h6 class="upper">Search blog</h6>
      <form>
        <input name="search" type="text" placeholder="Search.." class="form-control">
      </form>
    </div>
    <!-- end of widget        -->
    @php
        $category = App\Models\Categorypost::all();
    @endphp
    <div class="widget">
      <h6 class="upper">Categories</h6>
      <ul class="nav">
        @foreach ($category as $cat)
        <li><a href="{{ route('search.category.post', $cat -> slug) }}">{{ $cat -> cname }}</a>
        </li> 
        @endforeach
      </ul>
    </div>
    <!-- end of widget        -->
    @php
    $all_tag = App\Models\Tag::all();
    @endphp
    <div class="widget">
      <h6 class="upper">Popular Tags</h6>
      <div class="tags clearfix">
        @foreach ($all_tag as $tag)
        <a href="{{ route('search.tag.post', $tag -> slug ) }}">{{ $tag -> tname }}</a>
        @endforeach
      </div>
    </div>
    <!-- end of widget      -->
    @php
    $all_post = App\Models\Post::latest()->take(5)->get();
    @endphp
    <div class="widget">
      <h6 class="upper">Latest Posts</h6>
      <ul class="nav">
        @foreach ($all_post as $post)
        <li><a href="{{ $post -> slug }}">{{ $post -> title }}<i class="ti-arrow-right"></i><span>{{ date('F, d, Y', strtotime($post -> created_at)) }}</span></a>
        </li>
        @endforeach
      </ul>
    </div>
    <!-- end of widget -->
  </div>