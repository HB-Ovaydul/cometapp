@extends('frontend.layouts.app')
@section('content')

<section id="home">
    <!-- Home Slider-->
    <div id="home-slider" class="flexslider">
      <ul class="slides">
        <li>
          <img src="images/bg/1.jpg" alt="">
          <div class="slide-wrap">
            <div class="slide-content">
              <div class="container">
                <h1>Digital Power<span class="red-dot"></span></h1>
                <h6>We are a small design studio from San Francisco.</h6>
                <p><a href="#" class="btn btn-light-out">Read More</a><a href="#" class="btn btn-color btn-full">Services</a>
                </p>
              </div>
            </div>
          </div>
        </li>
        <li>
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
        </li>
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