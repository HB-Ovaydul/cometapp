@extends('frontend.layouts.app')
@section('content')

<section id="home">
    <!-- Home Slider-->
    <div id="home-slider" class="flexslider">
      <ul class="slides">

        @php
         $all_slides = App\Models\Slide::latest()->where('status', true)->where('trash', false)->get();
        @endphp

        @foreach ($all_slides as $slides)
        <li>
          <img src="{{ url('storage/admin_photo/'. $slides -> photo) }}" alt="">
          <div class="slide-wrap">
            <div class="slide-content">
              <div class="container">
                <h1>{{ $slides -> title }}<span class="red-dot"></span></h1>
                <h6>{{ $slides -> subtitle }}</h6>
                <p>
                  @foreach (json_decode($slides -> button) as $btns)
                  <a href="{{ $btns -> btn_link }}" class="{{ $btns -> btn_type }}">{{ $btns -> btn_title }}</a>
                  @endforeach
                </p>
              </div>
            </div>
          </div>
        </li>
        @endforeach

        {{-- <li>
          <img src="images/bg/2.jpg" alt="">
          <div class="slide-wrap">
            <div class="slide-content">
              <div class="container">
                <h1>We Are Comet<span class="red-dot"></span></h1>
                <h6>Experts in web design and development.</h6>
                <p><a href="#" class="btn btn-color">Explore</a><a href="#" class="btn btn-light-out">Join us</a>
                </p>
              </div>
            </div>
          </div>
        </li> --}}
      </ul>
    </div>
    <!-- End Home Slider-->
  </section>
  <!-- End Home Section-->
  @include('frontend.sections.title')
  @include('frontend.sections.expertise')
  @include('frontend.sections.vition')
  @include('frontend.sections.portfolio')
  @include('frontend.sections.clints')
  @include('frontend.sections.testimonials')
  @include('frontend.sections.blog')

@endsection