@extends('frontend.layouts.app')
@section('content')
<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="images/bg/19.jpg" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">Shop</h1>
              <h4>Free Delivery Worldwide.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
  </section>
  @php
    if(isset($_GET['search'])){
        $key = $_GET['search'];
        $all_product = App\Models\Product::where('title', 'LIKE','%'.$key.'%')->get();
    }
  @endphp
  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-3 hidden-sm hidden-xs">
          <div class="sidebar">
            <div class="widget">
              <h6 class="upper">Categories</h6>
              <ul class="nav">
                @php
                   $cat_pro = App\Models\Categoryproduct::all();
                @endphp
              @foreach ($cat_pro as $category)
                <li><a href="{{ route('product.search.cate', $category -> slug ) }}">{{ $category -> cname }}</a>
                </li>
            @endforeach
            </ul>                 
            </div>
            <!-- end of widget        -->
            <div class="widget">
              <h6 class="upper">Trending Products</h6>
              <ul class="nav product-list">
                @php
                   $trand_pro = App\Models\Product::latest()->where('trash', false) ->take(3)-> get();
                @endphp
                @foreach ($trand_pro as $trand)
                <li>
                  <div class="product-thumbnail">
                    <img src="{{ url('storage/product_single/'.$trand -> photo) }}" alt="">
                  </div>
                  <div class="product-summary"><a href="#">{{ $trand -> title }}</a><span>{{ $trand -> regular_price }}</span>
                  </div>
                </li>   
                @endforeach
              </ul>
            </div>
            <!-- end of widget          -->
            <div class="widget">
              <h6 class="upper">Search Shop</h6>
              <form>
                <input type="text" name="search" placeholder="Search.." class="form-control">
              </form>
            </div>
            <!-- end of widget -->
            <div class="widget">
                @php
                   $tag_pro = App\Models\Tagproduct::all();
                @endphp
              <h6 class="upper">Popular Tags</h6>
              <div class="tags clearfix">
                @foreach ($tag_pro as $pro_tag)
                <a href="{{ route('product.search.tag',$pro_tag -> slug  ) }}">{{ $pro_tag -> tname }}</a>
                @endforeach
              </div>
            </div>
            <!--end of widget-->

            <div class="widget">
              @php
                 $brand_pro = App\Models\Brand::all();
              @endphp
            <h6 class="upper">Popular Brand</h6>
            <div class="tags clearfix">
              @foreach ($brand_pro as $pro_brand)
              <a href="{{ route('product.search.brand',$pro_brand -> slug  ) }}">{{ $pro_brand -> bname }}</a>
              @endforeach
            </div>
          </div>
          </div>
          <!--end of sidebar-->
        </div>
        <div class="col-md-9">
          <div class="shop-menu">
            <div class="row">
              <div class="col-sm-8">
                <h6 class="upper">Displaying 6 of 18 results</h6>
              </div>
              <div class="col-sm-4">
                <div class="form-select">
                  <select name="type" class="form-control">
                    <option selected="selected" value="">Sort By</option>
                    <option value="">What's new</option>
                    <option value="">Price high to low</option>
                    <option value="">Price low to high</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- end of row-->
          </div>

          <div class="container-fluid">
            <div class="row">
                @foreach ($all_product as $item)
                <div class="col-md-4 col-sm-6">
                  <div class="shop-product">
                    <div class="product-thumb">
                      <a href="{{ route('single.product', $item -> slug) }}">
                        <img src="{{ url('storage/product_single/'. $item -> photo) }}" alt="">
                      </a>
                      <div class="product-overlay"><a href="#" class="btn btn-color-out btn-sm">Add To Cart<i class="ti-bag"></i></a>
                      </div>
                    </div>
                    <div class="product-info">
                      <h4 class="upper"><a href="">{{ $item -> title }}</a></h4><span>{{ $item -> regular_price }}</span>
                      <div class="save-product"><a href="#"><i class="icon-heart"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
            <!-- end of row-->
            <ul class="pagination">
              <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="ti-arrow-left"></i></span></a>
              </li>
              <li class="active"><a href="#">1</a>
              </li>
              <li><a href="#">2</a>
              </li>
              <li><a href="#">3</a>
              </li>
              <li><a href="#">4</a>
              </li>
              <li><a href="#">5</a>
              </li>
              <li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="ti-arrow-right"></i></span></a>
              </li>
            </ul>
            <!-- end of pagination-->
          </div>
        </div>
      </div>
    </div>
    <!-- end of container-->
  </section>
@endsection