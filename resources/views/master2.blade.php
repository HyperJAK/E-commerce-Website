<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <!-- <title>LEcommerce</title> -->
      @yield('title')
      <meta name="keywords" content="">
      <meta name="description" content="Laravel E-commerce made for end of semester project">
      <meta name="author" content="JJCC">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{asset('frontRessource/css/bootstrap.min.css')}}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{asset('frontRessource/css/style.css')}}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{asset('frontRessource/css/responsive.css')}}">
      <!-- fevicon -->
      <link rel="icon" href="{{asset('frontRessource/images/favicon.ico')}}" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{asset('frontRessource/css/jquery.mCustomScrollbar.min.css')}}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
      <!-- font awesome -->
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--  -->
      <!-- owl stylesheets -->
      <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('frontRessource/css/owl.carousel.min.css')}}">
      <link rel="stylesoeet" href="{{asset('frontRessource/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>
          <!-- banner bg main start -->
          <div class="banner_bg_main2">
         <!-- header top section start -->
         <div class="container">
            <div class="header_section_top">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="custom_menu">
                        <ul>
                        <li><a href="{{route('products')}}">Products</a></li>
                            <li><a href="{{route('/')}}">Stores</a></li>
                            <li><a href="#">Events</a></li>
                            <li><a href="#">Today's Deals</a></li>
                            <!-- <li><a href="#">Customer Service</a></li> -->

                            @if(Auth::check() && !is_null(Auth::id()))
                            @if(Auth::user()->is_seller==1)
                            <li><a href="{{ route('messages', ['id' => Auth::id()]) }}" style="color:#6754ab">User Messages </a></li> 
                            <li>
                         <a href="{{route('seller-dashboard')}}" class="btn btn-outline-dark btn-dark" style="margin-top:-5px">Open my Dashboard</a>
                          </li>
                            @else
                            <li><a href="{{ route('messagesBuyer', ['id' => Auth::id()]) }}" style="color:#6754ab">Message Buyers</a></li>
                            @endif
                            @endif
                            @if(Auth::check() && !is_null(Auth::id()))

                            <li>
        <form action="{{ route('logout',['user_id'=>Auth::id()]) }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </li>
       
    @endif
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header top section end -->
         <!-- logo section start -->
         <div class="logo_section">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="logo"><a href="{{route('/')}}"><img src="{{asset('frontRessource/images/logo3.svg')}}"></a></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- logo section end -->
         <!-- header section start -->
         <div class="header_section">
            <div class="container">
               <div class="containt_main">
                  <div id="mySidenav" class="sidenav">
                     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                     <a href="{{route('/')}}">Home</a>
                     <a href="{{route('/')}}">Fashion</a>
                     <a href="{{route('/')}}">Electronic</a>
                     <a href="{{route('/')}}">Jewellery</a>
                  </div>
                  <span class="toggle_icon" onclick="openNav()"><img src="{{asset('frontRessource/images/toggle-icon.png')}}"></span>

                  <div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform: capitalize">
                        @isset($title) {{ $title }} @else
                 All Categories
                  @endisset
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                     <a class="dropdown-item" href="{{route('products')}}" >All</a>
                      @isset($cats)
                       @foreach($cats as $obj)
                        <a class="dropdown-item {{ $obj->parent_id ? '' : 'text-dark font-weight-bold' }}" href="{{route('getByCat',['category_id'=>$obj->category_id])}}" style="text-transform: capitalize">{{$obj->name}}</a>
                        @endforeach
                       @endisset
                        <!-- <a class="dropdown-item" href="#">Another action</a> -->
                     </div>
</div>
                     <div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @isset($order) {{ $order }} @else
                     No order
                     @endisset
                     </button>
@php
    $route = request();
    $routeParameters = $route->query();

    $routeAsc = $routeParameters;
    $routeAsc['order'] = 'asc';
    $queryString0 = http_build_query($routeAsc);
    $fullLink1 = url()->current() . '?' . $queryString0;

    $routeOG = $routeParameters;
    $queryString1 = http_build_query($routeOG);
    $fullLink0 = url()->current().'?' . $queryString1;


    $routeDesc = $routeParameters;
    $routeDesc['order'] = 'desc';
    $queryString2 = http_build_query($routeDesc);
    $fullLink2 = url()->current() . '?' . $queryString2;
@endphp

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <!-- <a class="dropdown-item" href="{{$fullLink0}}">No Price Order</a> -->
               <a class="dropdown-item" href="{{$fullLink1}}">Low to High</a>
               <a class="dropdown-item" href="{{$fullLink2}}">High to Low</a>
               <!-- <a class="dropdown-item" href="#">Another action</a> -->
            </div>
               </div>

                  <div class="main">
                     <!-- Another variation with a button -->
                     <div class="input-group">
                     <form action="{{route('prodSearch')}}" class="form-inline" method="get">
                        <input type="text" class="form-control" placeholder="Search here" name="search">
                        <div class="input-group-append">
                           <button class="btn btn-secondary" type="submit" style="background-color: dark; ">
                           <i class="fa fa-search"></i>
                           </button>
                        </form>
                        </div>
                     </div>
                  </div>

                  <div class="header_box">
                     <div class="login_menu">
                        <ul>
                           @if(Auth::check() && !is_null(Auth::id()))
                           <li style="padding-right:1vw"><a href="{{route('getWishlist', ['user_id' => Auth::id()])}}">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <span class="padding_10">Wishlist </span></a>
                           </li>
                           @else
                           <li style="padding-right:1vw"><a href="{{route('login')}}">
                              <i class="fa fa-heart" aria-hidden="true"></i>
                              <span class="padding_10">Wishlist </span></a>
                           </li>
                           @endif
                           @if(Auth::check() && !is_null(Auth::id()))
                        <li style="padding-right:1vw"><a href="{{route('getActiveCart', ['buyer_id' => Auth::id()])}}">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                              <span class="padding_10">Cart </span></a>
                           </li>
                           <li><a href=" {{ route('myaccount') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="padding_10">Account</span></a>
                            </li>
                        @else
                        <li style="padding-right:1vw"><a href="{{route('login')}}">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                              <span class="padding_10">Cart </span></a>
                           </li>
                           <li><a href=" {{ route('login') }}">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="padding_10">Account</span></a>
                            </li>
                        @endif
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header section end -->
         @if ($errors->any())
                <div class="alert alert-danger" style="margin-top:2%;width:60%;margin-left:8%">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
   @yield('content')
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="footer_logo"><a href="{{route('/')}}"><img src="{{asset('frontRessource/images/logo4.svg')}}"></a></div>
            <form action="{{route('/')}}" class="form-inline" method="get">
            <div class="input_bt">

               <input type="text" class="mail_bt" placeholder="Your Email" name="Your Email">
               <span class="subscribe_bt" id="basic-addon2"><a href="#">Subscribe</a></span>

            </div>
         </form>
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
      <script>
var botmanWidget = {
    frameEndpoint: '/viewbot',
    introMessage: 'I am Icom Bot, wanna say hi?',
    chatServer : 'api/botman',
    userId:'{{Auth::id()?Auth::id():0}}',
    title: 'Icom Bot',
    mainColor: '#d5c9ff',
    bubbleBackground: '#ae9afa',
    aboutText: '',
    bubbleAvatarUrl: '',
    desktopHeight:500,
    desktopWidth:400,
};
</script>
<script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
   </body>
   @yield('scripts')
</html>
