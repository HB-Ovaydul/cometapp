<section>
    <div class="container">
      <div class="row">

        @php
            $counter = App\Models\Contact::latest()->where('trash', false)->where('status', true)->take(4)->get();
        @endphp
        @foreach ($counter as $count)
        <div class="col-md-3 col-sm-6">
            <div class="counter">
              <div class="counter-icon"><i class="{{ $count -> icon }}"></i>
              </div>
              <div class="counter-content">
                <h5><span data-count="{{ $count -> count }}" class="number-count">{{ $count -> count }}</span><span class="red-dot"></span></h5><span>{{ $count -> title }}</span>
              </div>
            </div>
            <!-- end of counter              -->
          </div>
        @endforeach

        {{-- <div class="col-md-3 col-sm-6">
          <div class="counter">
            <div class="counter-icon"><i class="icon-beaker"></i>
            </div>
            <div class="counter-content">
              <h5> <span data-count="9060" class="number-count">9060</span><span class="red-dot"></span></h5><span>Lines of Code</span>
            </div>
          </div>
          <!-- end of counter              -->
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <div class="counter-icon"><i class="icon-hourglass"></i>
            </div>
            <div class="counter-content">
              <h5><span data-count="75" class="number-count">75</span><span class="red-dot"></span></h5><span>Clients</span>
            </div>
          </div>
          <!-- end of counter              -->
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <div class="counter-icon"><i class="icon-chat"></i>
            </div>
            <div class="counter-content">
              <h5><span data-count="872" class="number-count">872</span><span class="red-dot"></span></h5><span>Tweets</span>
            </div>
          </div>
          <!-- end of counter              -->
        </div> --}}
      </div>
    </div>
  </section> 