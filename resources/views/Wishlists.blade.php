@extends('master2')
@section('title')
<title>My Wishlist | Icom</title>
@endsection
@section('content')

    <div class="fashion_section">
        @isset($objs)
            <div class="container">
                <h1 class="fashion_title">My wishlist items</h1>
                <div class="fashion_section_2">
                    <div class="col"> <!-- Top div is a column -->
                        @foreach($objs as $obj)
                            <div class="row" style="padding: 10px; border-bottom: 2px solid #ccc;margin:auto;justify-content:center"> <!-- Rows with padding and border -->
                                <div class="col-lg-2 col-sm-2"> <!-- Small and rounded picture -->
                                    <div class="rounded-circle" style="width: 80px; height: 80px; overflow: hidden;">
                                        <img src="{{asset($obj->path1)}}" alt="product picture" style="width: 100%; border-radius: 20px">
                                    </div>
                                </div>
                                <div class="col" style="text-align:center;">
                                    <h4 class="shirt_text"><a href="{{route('getProd',['id'=>$obj->product_id])}}">{{ $obj->product_name }}</a></h4>
                                    <h4>Wished on: {{$obj->created_at}}</h4>
                                </div>
                                <div class="col-lg-2 col-sm-2">
                                    <form action="{{ route('DeleteWishlist', ['store_id' => $obj->store_id,'product_id'=>$obj->product_id,'user_id'=>Auth::id()]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Remove from Wishlist ❤</button>
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
                    <h3>Oh dear it looks like your wishlist is empty</h3>
                    <h1><a href="{{route('products')}}">Start your shopping now!</a></h1>
                </div>
            </div>
        </div>
    </div>
        @endisset
    </div>


@endsection
