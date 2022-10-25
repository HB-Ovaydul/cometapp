<header id="topnav">
    <div class="container">
      <!-- Logo container-->
      <div class="logo">
        <a href="{{ route('home.page') }}">
          <img src="frontend/images/logo_light.png" alt="" class="logo-light">
          <img src="frontend/images/logo_dark.png" alt="" class="logo-dark">
        </a>
      </div>
      <!-- End Logo container-->
      <div class="menu-extras">
        <div class="menu-item">
          <!-- Search Form-->
          <div class="search">
            <a href="#">
              <i class="ti-search"></i>
            </a>
            <div class="search-form">
              <form action="#" class="inline-form">
                <div class="input-group">
                  <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn"><button type="button" class="btn btn-color"><span><i class="ti-search"></i></span>
                  </button>
                  </span>
                </div>
              </form>
            </div>
          </div>
          <!-- End search form-->
        </div>
        <div class="menu-item">
          <!-- Mobile menu toggle-->
          <a class="navbar-toggle">
            <div class="lines">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </a>
          <!-- End mobile menu toggle-->
        </div>
      </div>
      <div id="navigation">
        <!-- Navigation Menu-->
        <ul class="navigation-menu">
          <li class="menu-hover">
            <a href="{{ route('home.page') }}">Home</a>
            {{-- <ul class="submenu megamenu">
              <li>
                <ul>
                  <li>
                    <span>Multi Page</span>
                  </li>
                  <li>
                    <a href="index-2.html">Home Classic</a>
                  </li>
                  <li>
                    <a href="index-01.html">Video Background</a>
                  </li>
                  <li>
                    <a href="index-02.html">HTML5 Video BG</a>
                  </li>
                  <li>
                    <a href="index-03.html">Animated Zoom Slider</a>
                  </li>
                  <li>
                    <a href="index-04.html">Text Rotator</a>
                  </li>
                </ul>
              </li>
              <li>
                <ul>
                  <li>
                    <span>One Page</span>
                  </li>
                  <li>
                    <a href="index-op.html">One Page Classic</a>
                  </li>
                  <li>
                    <a href="index-op-01.html">Video Background</a>
                  </li>
                  <li>
                    <a href="index-op-02.html">HTML5 Video BG</a>
                  </li>
                  <li>
                    <a href="index-op-03.html">Animated Zoom Slider</a>
                  </li>
                  <li>
                    <a href="index-op-04.html">Text Rotator</a>
                  </li>
                </ul>
              </li>
              <li>
                <ul>
                  <li>
                    <span>Home Layouts</span>
                  </li>
                  <li>
                    <a href="home-restaurant.html">Restaurant</a>
                  </li>
                  <li>
                    <a href="home-architecture.html">Architecture</a>
                  </li>
                  <li>
                    <a href="home-photography.html">Photography</a>
                  </li>
                  <li>
                    <a href="home-landing.html">Landing Page</a>
                  </li>
                  <li>
                    <a href="home-resume.html">Resume</a>
                  </li>
                  <li>
                    <a href="home-models.html">Model Agency<span class="label">New</span></a>
                  </li>
                  <li>
                    <a href="home-fitness.html">Fitness<span class="label">New</span></a>
                  </li>
                </ul>
              </li>
            </ul> --}}
          </li>
          <li>
            <a href="{{ route('about.page') }}">About Us</a>
          </li>

          <li>
            <a href="page-services.html">Services</a>
          </li>

          <li>
            <a href="{{ route('port.page') }}">Portfolio</a>
          </li>

          <li>
            <a href="{{ route('contact.page') }}">Contact</a>
          </li>

          <li>
            <a href="{{ route('blog.page') }}">Blog</a>
          </li>
          <li>
            <a href="{{ route('product.page') }}">Shop</a>
          </li>

          <li>
            <a href="page-login.html">Login / Register</a>
          </li>
        </ul>
        <!-- End navigation menu        -->
      </div>
    </div>
  </header>