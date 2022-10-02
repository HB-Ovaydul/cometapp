@extends('frontend.layouts.app')
@section('content')
<section class="page-title parallax">
    @foreach ($banner as $portBan)
    <div data-parallax="scroll" data-image-src="{{ url('storage/port_banner/'.$portBan -> photo) }}" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">{{ $portBan -> title }}<span class="red-dot"></span></h1>
              <h4>{{ $portBan -> subtitle }}</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
    @endforeach
  </section>
  <section>

    @php
       $cate = App\Models\Category::latest()->where('trash', false)->where('status', true)->take(6)->get()
    @endphp
    <div class="container">
      <ul id="filters">
        <li data-filter="*" class="active">All</li>
        @foreach($cate as $item)
        <li data-filter=".{{ $item -> slug }}">{{ $item -> name }}</li>
        @endforeach
      </ul>
      <!-- end of portfolio filters-->
      <div id="works" class="three-col">
        @foreach($port_page as $port)
        <div class="work-item @foreach($port -> categoris as $por) {{ $por -> slug }} @endforeach">
          <div class="work-detail">
            <a href="{{ route('port.single.page', $port -> slug) }}">
              <img src="{{ url('storage/port_feature/'.$port -> featured) }}" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>{{ $port -> title }}</h3>
                    <p>Branding, {{ $port -> type }}</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      
      </div>
      <!-- end of portfolio grid-->
    </div>
  </section>
  <section>
    <div class="container">
      @php
        $works = App\Models\PortfolioWorkTogether::latest()->where('trash', false)->where('status',true)->take(1)->get();
      @endphp
      <div class="row">
          @foreach ($works as $work)
          <div class="col-md-6">
            <img src="{{ url('storage/port_work/'.$work -> photo) }}" alt="" class="mt-50">
          </div>
          <div class="col-md-5 col-md-offset-1">
            <div class="title txt-xs-center txt-sm-center">
              <h3>{{ $work -> title }}<span class="red-dot"></span></h3>
              <p>{{ $work -> subtitle }}</p><a href="#" class="btn btn-dark-out">Apply Now</a>
            </div>
          </div>
          @endforeach
      </div>
      <!-- end of row-->
    </div>
  </section>
@endsection