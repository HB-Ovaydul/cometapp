<section class="p-0 b-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-4 img-side img-left mb-0">
          <div class="img-holder">
            @php
            $ex_photo = App\Models\Expertise::latest()->where('status', true)->where('trash', false)->take(1)->get();
          @endphp
          @foreach ($ex_photo as $ephoto)
          <img src="{{ url('storage/expertise/'. $ephoto -> ex_photo) }}" alt="" class="bg-img">     
          @endforeach
            <div class="centrize">
              <div class="v-center">
                <div class="title txt-xs-center">
                  <h4 class="upper">This is what we love to do.</h4>
                  <h3>Expertise<span class="red-dot"></span></h3>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of side background image-->
        <div class="col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-4">
          <div class="services">
            <div class="row"> 
            @php
            $expertises = App\Models\Expertise::latest()->where('status', true)->where('trash', false)->take(4)->get();
          @endphp
              @foreach ($expertises as $item)
              <div class="col-sm-6 border-bottom border-right">
                <div class="service"><i class="{{ $item -> brand_logo }}"></i><span class="back-icon"><i class="{{ $item -> brand_logo }}"></i></span>
                  <h4>{{ $item -> brand_name }}</h4>
                  <hr>
                  <p class="alt-paragraph">{{ $item -> brand_paragraph }}</p>
                </div>
                <!-- end of service-->
              </div>

              @endforeach

                {{--  <div class="col-sm-6 border-bottom border-right">
                <div class="service"><i class="icon-focus"></i><span class="back-icon"><i class="icon-focus"></i></span>
                  <h4>Branding</h4>
                  <hr>
                  <p class="alt-paragraph">Facilis doloribus illum quis, expedita mollitia voluptate non iure, perspiciatis repellat eveniet volup.</p>
                </div>
                <!-- end of service-->
              </div>
              <div class="col-sm-6 border-bottom">
                <div class="service"><i class="icon-layers"></i><span class="back-icon"><i class="icon-layers"></i></span>
                  <h4>Interactive</h4>
                  <hr>
                  <p class="alt-paragraph">Commodi totam esse quis alias, nihil voluptas repellat magni, id fuga perspiciatis, ut quia beatae, accus.</p>
                </div>
                <!-- end of service-->
              </div>
              <div class="col-sm-6 border-bottom border-right">
                <div class="service"><i class="icon-mobile"></i><span class="back-icon"><i class="icon-mobile"></i></span>
                  <h4>Production</h4>
                  <hr>
                  <p class="alt-paragraph">Doloribus qui asperiores nisi placeat volup eum, nemo est, praesentium fuga alias sit quis atque accus.</p>
                </div>
                <!-- end of service-->
              </div>
              <div class="col-sm-6 border-bottom">
                <div class="service"><i class="icon-globe"></i><span class="back-icon"><i class="icon-globe"></i></span>
                  <h4>Editing</h4>
                  <hr>
                  <p class="alt-paragraph">Aliquid repellat facilis quis. Sequi excepturi quis dolorem eligendi deleniti fuga rerum itaque.</p>
                </div>
                <!-- end of service-->
              </div> --}}

            </div>
          </div>
          <!-- end of row-->
        </div>
      </div>
      <!-- end of row -->
    </div>
  </section>