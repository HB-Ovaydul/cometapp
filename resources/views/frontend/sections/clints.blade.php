<section>
    <div class="container">
      <div class="title center">
        <h4 class="upper">Some of the best.</h4>
        <h3>Our Clients<span class="red-dot"></span></h3>
        <hr>
      </div>
      <div class="section-content">
        <div class="boxes clients">
          <div class="row">

            @php
              $client_data = App\Models\Client::latest()->where('status', true)->where('trash', false)->take(6)->get();
              $i = 1;  
            @endphp
            @foreach ($client_data as $item)

            @php
            if($i == 1 ){
               $className = 'border-right border-bottom';
               $dataDelay = 0;
            }else if($i == 2) {
               $className = 'border-right border-bottom';
               $dataDelay = 500;
            }else if($i == 3){
                $className = 'border-bottom';
               $dataDelay = 1000;
            }else if($i == 4){
                $className = 'border-right';
               $dataDelay = 0;
            }else if($i == 5){
                $className = 'border-right';
               $dataDelay = 500;
            }else if($i == 6){
                $className = '';
               $dataDelay = 1000;
            }

         @endphp

              <div class="col-sm-4 col-xs-6 {{ $className }}">
                <img style="width: 100px;height:100px;object-cover;" src="{{ url('storage/clients/', $item -> photo) }}" alt="" data-animated="true" data-delay="{{ $dataDelay }}" class="client-image" >
              </div> 
              @php $i++; @endphp
        @endforeach


            {{-- <div class="row">
              <div class="col-sm-4 col-xs-6 ">
                <img src="images/clients/1.png" alt="" data-animated="true" class="client-image">
              </div>

              <div class="col-sm-4 col-xs-6 border-right border-bottom">
                <img src="images/clients/2.png" alt="" data-animated="true" data-delay="500" class="client-image fade-in-top">
              </div>

              <div class="col-sm-4 col-xs-6 border-bottom">
                <img src="images/clients/3.png" alt="" data-animated="true" data-delay="1000" class="client-image fade-in-top">
              </div>

              <div class="col-sm-4 col-xs-6 border-right">
                <img src="images/clients/4.png" alt="" data-animated="true" class="client-image fade-in-top">
              </div>

              <div class="col-sm-4 col-xs-6 border-right">
                <img src="images/clients/5.png" alt="" data-animated="true" data-delay="500" class="client-image fade-in-top">
              </div>

              <div class="col-sm-4 col-xs-6">
                <img src="images/clients/6.png" alt="" data-animated="true" data-delay="1000" class="client-image fade-in-top">
              </div>
            </div> --}}

          </div>
          <!-- end of row-->
        </div>
      </div>
      <!-- end of section content-->
    </div>
  </section>