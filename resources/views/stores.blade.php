@extends('master')
@section('title')
    <title>All Stores | Icom</title>
@endsection
@section('content')

    <!-- electronic section start -->
    <div class="fashion_section">
        @isset($categories)
            @foreach($categories as $categoryId => $category)

                <div id="storeCarousel{{$category['category']->category_id}}" style="margin: 2% auto 5%;width: 90vw;" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $index = 0;
                        @endphp
                        @foreach(collect($category['stores'])->chunk(3) as $chunk)
                            <div class="carousel-item {{$index === 0 ? 'active' : ''}}">
                                <div class="container">
                                    <h1 class="fashion_title">{{ ucfirst($category['category']->name) }}</h1>
                                    <div class="fashion_section_2">
                                        <div class="row">
                                            @foreach($chunk as $store)
                                                <div class="col-lg-4 col-sm-4">
                                                    <div class="box_main">
                                                        <h4 class="shirt_text">{{ $store['name'] }}</h4>
                                                        <p class="price_text">{{ $store['description'] }}</p>
                                                        <div class="tshirt_img"><img src="{{ asset($store->image) }}" style="border-radius: 20px" alt="T-Shirt pic"></div>
                                                        <div class="btn_main">
                                                            <div class="buy_bt"><a href="{{route('getByStore',['store_id'=>$store->store_id])}}">Visit Now</a></div>
                                                            @if(Auth::check() && !is_null(Auth::id()))
                                                                <div class="seemore_bt"><a href="{{route('chatBuyer',['sellerid'=>$store->user_id,'buyerid'=>Auth::id()])}}">Message Us</a></div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $index++;
                            @endphp
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" style="width: 35px;height: 35px;top:50%;background: var(--maincolor);opacity: 1;font-size: 20px;color: #ffffff;border-radius: 100px;" href="{{ '#' . 'storeCarousel' . $category['category']->category_id }}" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next" style="width: 35px;height: 35px;top:50%;background: var(--maincolor);opacity: 1;font-size: 20px;color: #ffffff;border-radius: 100px;" href="{{ '#' . 'storeCarousel' . $category['category']->category_id }}" role="button" data-slide="next">
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

@endsection
