@extends('master')
@section('content')

    <div class="fashion_section">
        @isset($userCartItems)
            <div class="container">
                <h1 class="fashion_title">Your Cart</h1>
                <div class="fashion_section_2">
                    <div class="col"> <!-- Top div is a column -->
                        @foreach($userCartItems as $cartItem)
                            <div class="row" style="padding: 20px; border-bottom: 1px solid #ccc;"> <!-- Rows with padding and border -->
                                <div class="col-lg-2 col-sm-2"> <!-- Small and rounded picture -->
                                    <div class="rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
                                        <img src="{{ asset('frontRessource/images/tshirt-img.png') }}" alt="T-Shirt pic" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="col"> <!-- Details -->
                                    <h4 class="shirt_text">{{ $cartItem->product_id }}</h4> <!-- Adjusting to access product details -->
                                    <p class="price_text">{{ $cartItem->cart_id }}</p> <!-- Adjusting to access cart details -->
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
        @endisset
        <div class="loader_main">
            <div class="loader"></div>
        </div>
    </div>


@endsection
