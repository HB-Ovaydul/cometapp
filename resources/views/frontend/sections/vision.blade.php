<section>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-4 img-side img-right">
          @php
          $theVisionimg = App\Models\Vision::latest()->where('trash', false)->where('status', true)->take(1)->get();
      @endphp
      @foreach ($theVisionimg as $imgs)
      <div class="img-holder">
        <img src="{{ url('storage/vision/'. $imgs -> photo) }}" alt="" class="bg-img">
      </div>
      @endforeach
        </div>
        <!-- end of side background image-->
      </div>
      <!-- end of row-->
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-sm-8">
          <div class="title">
            <h4 class="upper">Not just code.</h4>
            <h3>The Vision<span class="red-dot"></span></h3>
            <hr>
          </div>
          <div class="row">

            @php
                $theVision = App\Models\Vision::latest()->where('trash', false)->where('status', true)->take(4)->get();
            @endphp

            @foreach ($theVision as $item)    
            <div class="col-sm-6">
              <div class="text-box">
                <h4 class="upper small-heading">{{ $item -> title }}</h4>
                <p>{{ $item -> dec }}</p>
              </div>
              <!-- end of text box-->
            </div> 
            @endforeach

            
          </div>
          <!-- end of row              -->
        </div>
      </div>
      <!-- end of row-->
    </div>
    <!-- end of container-->
  </section>