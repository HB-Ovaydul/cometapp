@extends('frontend.layouts.app')
@section('content')
<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="frontend/images/bg/12.jpg" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">Single Item<span class="red-dot"></span></h1>
              <h4>Our best work.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
  </section>
  <section class="b-0">
    <div class="container">
      <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true, &quot;directionNav&quot;: true}" class="flexslider nav-inside">
        <ul class="slides">

          {{-- @foreach (json_decode($portfolios -> gallery) as $gall)
          <li>
            <img src="{{ url('storage/port_gallery'.$gall -> gallery ) }}" alt="">
          </li>    
          @endforeach --}}
          {{-- <li>
            <img src="frontend/images/portfolio/single-2.jpg" alt="">
          </li>
          <li>
            <img src="frontend/images/portfolio/single-3.jpg" alt="">
          </li> --}}
        </ul>
      </div>
    </div>
  </section>
  <section class="p-0 b-0">
    <div class="boxes">
      <div class="container-fluid">
        <div class="row">
          @php
        //  $ports_staps = App\Models\Portfolio::latest()->where('trash', false)->where('status', true)->take(3)->get();
              $stap_non = 1;
          @endphp
          @foreach (json_decode($portfolios -> staps) as $staps)
          <div data-bg-color="#eaeaea" class="col-md-4">
            <div class="number-box"><span>Step No.</span>
              <h2>0{{ $stap_non }}<span class="red-dot"></span></h2>
              <h4>{{ $staps -> title }}</h4>
              <p>{{ $staps -> dec }}</p>
            </div>
          </div>
          @php $stap_non++; @endphp    
          @endforeach

        </div>
        <!-- end of row-->
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="project-detail">
            <p><strong>Client:</strong>{{ $portfolios -> client }}</p>
            <p><strong>Date:</strong>{{ date('F d, Y', strtotime($portfolios -> date)) }}</p>
            <p><strong>Link:</strong><a href="{{ $portfolios -> link }}">{{ $portfolios -> link }}</a>
            </p>
            <p><strong>Type:</strong>{{ $portfolios -> type }}</p>
          </div>
        </div>
        <div class="col-sm-6">
          {!! htmlspecialchars_decode($portfolios -> dec) !!}
        </div>
        {{-- <div class="col-sm-4">
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis eum eveniet, facere libero ipsa fugiat nihil sit fuga odio, distinctio quasi veniam adipisci! Molestiae aperiam labore, neque assumenda error natus!</p>
        </div> --}}
      </div>
    </div>
  </section>
  <section class="controllers p-0">
    <div class="container">
      <div class="projects-controller"><a href="#" class="prev"><span><i class="ti-arrow-left"></i>Previous</span></a><a href="#" class="all"><span><i class="ti-layout-grid2"></i></span></a><a href="#" class="next"><span>Next<i class="ti-arrow-right"></i></span></a>
      </div>
    </div>
  </section
@endsection