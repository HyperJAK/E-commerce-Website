@extends('master')
@section('content')

    @isset($totalPrice)
        <div class="d-flex flex-column gap-2 align-items-center">
            <h1 class="fashion_title bg-transparent text-white">Total price</h1>
            <p class="btn btn-outline-dark btn-dark text-danger">${{number_format($totalPrice)}}</p>
        </div>
    @endisset

    @isset($userCartItems)
    <div class="card-body d-flex flex-column " style="padding: 0 200px 0 200px">

        <form method='POST' action='{{ route('place-order') }}'>
            @csrf

            <input type="hidden" name="cart_id" id="cart_id" value="{{$userCartItems[0]->cart_id}}">

            <div class="row">

                <div class="mb-3 col-md-6">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control border border-2 p-2" value=''>
                    @error('address')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-3 col-md-12">
                    <label for="floatingTextarea2">Description</label>
                    <textarea class="form-control border border-2 p-2"
                              placeholder="Describe your order for no reason" id="floatingTextarea2" name="description"
                              rows="4" cols="50"></textarea>
                    @error('description')
                    <p class='text-danger inputerror'>{{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="d-flex flex-column justify-content-center" style="max-width: 30%; margin: 0 auto; gap: 5px">

                @isset($location)

                    <label class="form-label">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{$location->latitude}}" readonly>

                    <label class="form-label">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{$location->longitude}}" readonly>

                    <input type="hidden" name="location_id" id="location_id" value="{{$location->id}}">

                @endisset
                    <label for="shipping_method" class="form-label">Method of Shipping</label>
                    <select name="shipping_method" id="shipping_method" class="form-control border border-2 p-2">
                        <option value="by air">By Air</option>
                        <option value="by sea">By Sea</option>
                        <option value="local">Local</option>
                    </select>

            <a type="button" href="{{route('myMap')}}" class="btn bg-info text-white">Choose location</a>
            <button type="submit" class="btn bg-danger text-white">Submit</button>
            </div>
        </form>

    </div>
    @endisset

    <div class="fashion_section">
        @isset($userCartItems)
            <div class="container">
                <div class="d-flex flex-column gap-2 align-items-center">
                    <h1 class="fashion_title">Items That you will buy</h1>
                    <a href="{{route('products')}}" class="btn btn-outline-dark btn-dark">Buy All Cart Items</a>
                </div>

                <div class="fashion_section_2">
                    <div class="col">
                        @foreach($userCartItems as $cartItem)
                            <div class="row" style="padding: 20px; border-bottom: 1px solid #ccc;">
                                <div class="col-lg-2 col-sm-2">
                                    <div class="rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
                                        <img src="{{ asset($cartItem->product->path1) }}" alt="T-Shirt pic" style="width: 100%;">
                                    </div>
                                </div>
                                <div class="col"> <!-- Details -->
                                    <h4 class="shirt_text">{{ $cartItem->product->name }}</h4>
                                    <p class="price_text">Quantity: {{ $cartItem->product->quantity }}</p>
                                    <p class="price_text">Price: ${{ number_format($cartItem->quantity *  $cartItem->price) }}</p>
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
