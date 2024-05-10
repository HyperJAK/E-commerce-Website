@extends('master')
@section('title')
<title>My Cart | Icom</title>
@endsection
@section('content')

    <div class="fashion_section">
        @isset($userCartItems)
            <div class="container">
                <div class="d-flex flex-column gap-2 align-items-center">
                    <h1 class="fashion_title">Your Cart</h1>
                    <a href="{{route('createOrderView')}}" class="btn btn-outline-dark btn-dark">Buy All Cart Items</a>
                </div>

                <div class="fashion_section_2">
                    <div class="col"> <!-- Top div is a column -->
                        @foreach($userCartItems as $cartItem)
                            <div class="row" style="padding: 20px; border-bottom: 1px solid #ccc;"> <!-- Rows with padding and border -->
                                <div class="col-lg-2 col-sm-2"> <!-- Small and rounded picture -->
                                    <div class="rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
                                        <img src="{{ asset($cartItem->product->path1) }}" alt="T-Shirt pic" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="col"> <!-- Details -->
                                    <h4 class="shirt_text">{{ $cartItem->product->name }}</h4> <!-- Adjusting to access product details -->
                                    <p class="price_text">Quantity: {{ $cartItem->quantity }}</p> <!-- Adjusting to access cart details -->
                                    <p class="price_text">Price: {{Auth::user()->currency_symbol}}{{ number_format($cartItem->quantity *  $cartItem->price)}}</p> <!-- Adjusting to access cart details -->
                                </div>
                                <div class="col-lg-2 col-sm-2"> <!-- Button -->
                                    <form action="{{ route('DeleteCartItem', ['cartItem_id' => $cartItem->cartItem_id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger">Remove from cart</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
<div class="container" id="productDiv" >
        <div class="col-md-6" style="margin:auto;margin-top:10%;">
            <div class="row" >
                <div class="col-md-12" style="text-align:center;">
                    <h1>Not Found</h1>
                    <h3>Oh dear it looks like your cart is empty</h3>
                    <h1><a href="{{route('products')}}">Start your shopping now!</a></h1>
                </div>
            </div>
        </div>
    </div>
        @endisset
        <div class="loader_main">
            <div class="loader"></div>
        </div>
    </div>


@endsection
