<section id="portfolio" class="pb-0">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="title m-0 txt-xs-center txt-sm-center">
            <h2 class="upper">Selected Works<span class="red-dot"></span></h2>
            <hr>
          </div>
        </div>

        @php
        $portfolio = App\Models\Portfolio::latest()->where('trash', false)->where('status', true)->take(4)->get();
        $category = App\Models\Category::latest()->where('trash', false)->where('status', true)->take(4)->get();
        @endphp

        <div class="col-md-8">
          <ul id="filters" class="no-fix mt-25">
            <li data-filter="*" class="active">All</li>
            @foreach ($category as $cats)
            <li data-filter=".{{ $cats -> slug }}">{{ $cats -> name }}</li>    
            @endforeach
          </ul>
          <!-- end of portfolio filters-->
        </div>
      </div>
      <!-- end of row-->
    </div>
    <div class="section-content pb-0">
      <div id="works" class="four-col wide mt-50">
        @foreach ($portfolio as $port)
        <div class="work-item @foreach($port -> categoris as $ports) {{ $ports -> slug }} @endforeach">
          <div class="work-detail">
            <a href="{{ route('port.single.page', $port -> slug ) }}">
              <img src="{{ url('storage/port_feature/'. $port -> featured) }}" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>{{ $port -> title }}</h3>
                    <p>{{ $port -> types }}</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div> 
        @endforeach


        {{-- <div class="work-item graphic printing">
          <div class="work-detail">
            <a href="portfolio-single-1.html">
              <img src="images/portfolio/7.jpg" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>Sweet Lane</h3>
                    <p>Graphic, Printing</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="work-item printing branding">
          <div class="work-detail">
            <a href="portfolio-single-1.html">
              <img src="images/portfolio/6.jpg" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>Jeff Burger</h3>
                    <p>Printing, Branding</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="work-item video graphic">
          <div class="work-detail">
            <a href="portfolio-single-1.html">
              <img src="images/portfolio/9.jpg" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>Juice Meds</h3>
                    <p>Video, Graphic</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="work-item branding graphic">
          <div class="work-detail">
            <a href="portfolio-single-1.html">
              <img src="images/portfolio/11.jpg" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>Prisma</h3>
                    <p>Graphic, Branding</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="work-item printing graphic">
          <div class="work-detail">
            <a href="portfolio-single-1.html">
              <img src="images/portfolio/10.jpg" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>Delirio Tropical</h3>
                    <p>Printing, Graphic</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="work-item printing branding">
          <div class="work-detail">
            <a href="portfolio-single-1.html">
              <img src="images/portfolio/8.jpg" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>Amendoas</h3>
                    <p>Printing, Branding</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="work-item graphic video">
          <div class="work-detail">
            <a href="portfolio-single-1.html">
              <img src="images/portfolio/3.jpg" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>Hnina</h3>
                    <p>Graphic, Video</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div> --}}
      </div>
      <!-- end of portfolio grid-->
    </div>
  </section>