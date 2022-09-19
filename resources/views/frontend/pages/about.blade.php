@extends('frontend.layouts.app')
@section('content')
<section class="page-title parallax">

    @php
    $banners = App\Models\Aboutbanner::latest()->where('status', true)->where('trash', false)->take(1)->get();
    @endphp
    @foreach ($banners as $item) 
    <div data-parallax="scroll" data-image-src="{{ url('storage/about_banner/'. $item -> image) }}" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">{{ $item -> title }}<span class="red-dot"></span></h1>
              <h4>{{ $item -> subtitle }}</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
    @endforeach
  </section>
@endsection