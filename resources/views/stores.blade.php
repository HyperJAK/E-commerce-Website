@extends('master')
@section('content')

      <!-- electronic section start -->
      <div class="fashion_section">
          @isset($categories)
          @foreach($categories as $categoryId => $category)

                  <div id="{{ 'carousel-slide_' . $category['category']->category_id }}" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                          @php $index = 0; @endphp
                          @foreach(collect($category['stores'])->chunk(3) as $chunk)
                              <div class="carousel-item {{$index === 0 ? 'active' : ''}}">
                                  <div class="container">
                                      <h1 class="fashion_taital">{{ ucfirst($category['category']->name) }}</h1>
                                      <div class="fashion_section_2">
                                          <div class="row">
                                              @foreach($chunk as $store)
                                                  <div class="col-lg-4 col-sm-4">
                                                      <div class="box_main">
                                                          <h4 class="shirt_text">{{ $store['name'] }}</h4>
                                                          <p class="price_text">{{ $store['description'] }}</p>
                                                          <div class="tshirt_img"><img src="{{ asset('frontRessource/images/tshirt-img.png') }}" alt="T-Shirt pic"></div>
                                                          <div class="btn_main">
                                                              <div class="buy_bt"><a href="#">Visit Now</a></div>
                                                              <div class="seemore_bt"><a href="#">Message Us</a></div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              @endforeach
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              @php $index++; @endphp
                          @endforeach
                      </div>
                      <a class="carousel-control-prev" href="{{ '#' . 'carousel-slide_' . $category['category']->category_id }}" role="button" data-slide="prev">
                          <i class="fa fa-angle-left"></i>
                      </a>
                      <a class="carousel-control-next" href="{{ '#' . 'carousel-slide_' . $category['category']->category_id }}" role="button" data-slide="next">
                          <i class="fa fa-angle-right"></i>
                      </a>
                  </div>


          @endforeach
          @endisset
              <div class="loader_main">
                  <div class="loader"></div>
              </div>
      </div>



      <!-- jewellery  section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="footer_logo"><a href="{{route('home')}}"><img src="{{asset('frontRessource/images/footer-logo.png')}}"></a></div>
            <div class="input_bt">
               <input type="text" class="mail_bt" placeholder="Your Email" name="Your Email">
               <span class="subscribe_bt" id="basic-addon2"><a href="#">Subscribe</a></span>
            </div>
            <div class="footer_menu">
               <ul>
                  <li><a href="#">Best Sellers</a></li>
                  <li><a href="#">Gift Ideas</a></li>
                  <li><a href="#">New Releases</a></li>
                  <li><a href="#">Today's Deals</a></li>
                  <li><a href="#">Customer Service</a></li>
               </ul>
            </div>
            <div class="location_main">Help Line  Number : <a href="#">+961 01 123 456</a></div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">© 2024 All Rights Reserved. Design by <a href="">Our Group</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="{{asset('frontRessource/js/jquery.min.js')}}"></script>
      <script src="{{asset('frontRessource/js/popper.min.js')}}"></script>
      <script src="{{asset('frontRessource/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('frontRessource/js/jquery-3.0.0.min.js')}}"></script>
      <script src="{{asset('frontRessource/js/plugin.js')}}"></script>
      <!-- sidebar -->
      <script src="{{asset('frontRessource/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
      <script src="{{asset('frontRessource/js/custom.js')}}"></script>
      <script>
         function openNav() {
           document.getElementById("mySidenav").style.width = "250px";
         }

         function closeNav() {
           document.getElementById("mySidenav").style.width = "0";
         }
      </script>
@endsection
