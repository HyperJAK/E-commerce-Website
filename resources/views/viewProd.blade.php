@extends('master2')
@section('title')
<title>Product | Icom</title>
@endsection
@section('content')

@isset($obj)
<div class="container" id="productDiv">
    <div class="row">
        <div class="col-md-6">
            <div id="productCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">

                        <img src="{{ asset($obj->path1) }}" style="border-radius: 20px; max-width: 400px" class="d-block" alt="Product Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset($obj->path2) }}" style="border-radius: 20px; max-width: 400px" class="d-block" alt="Product Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset($obj->path3) }}" style="border-radius: 20px; max-width: 400px" class="d-block" alt="Product Image 3">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset($obj->path4) }}" style="border-radius: 20px; max-width: 400px" class="d-block" alt="Product Image 4">

                    </div>
                </div>
                <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $obj->name }}</h1>
                    <h3>Category: {{ $obj->category_id[0] }}</h3>
                    <h4>⁕Store Name: <a href="{{route('getByStore',['store_id'=>$obj->store_id])}}">{{ $obj->store_name[0] }}</a></h4>
                    <p>Description:<br/>{{ $obj->description }}</p>
                    <h4>Price: {{$obj->cur}} {{ $obj->price }}</h4>
                    <p>Available Quantity: {{ $obj->quantity }}</p>
                    <p>Desired Quantity:
                    <input type="number" form="wlist" name="quantity" min="1" max="{{ $obj->quantity }}" value='1'/>
                </p>
                     <p>{{$obj->wish}}</p>
                <div class="col-md-9" id="ProdBtns">
                    @isset($wished)
                    @if($wished==false && Auth::check() && !is_null(Auth::id()))
                <form  action="{{ route('AddWishlist', ['store_id' => $obj->store_id,'product_id'=>$obj->product_id,'user_id'=>Auth::id()]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark">Add to Wishlist ❤</button>
                    </form>
                    @elseif($wished==true)
                    <form action="{{ route('DeleteWishlist', ['store_id' => $obj->store_id,'product_id'=>$obj->product_id,'user_id'=>Auth::id()]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Remove from Wishlist ❤</button>
                    </form>
                    @elseif(!Auth::check() || is_null(Auth::id()))
                        <a href="{{ route('login') }}" class="btn btn-outline-danger">Login or Register</a>
                    @endif
                    @endisset
                    @isset($quantity)
                            @if($quantity <=0 && Auth::check() && !is_null(Auth::id()))
                    <form action="{{ route('AddCartItem', ['product_id' => $obj->product_id,'buyer_id'=>Auth::id()]) }}" id="wlist" method="POST">
                        @csrf
                        <button type="submit" class="btn purple" >Add to Cart</button>
                    </form>
                    @endif
                        @endisset
                    <br/>
                    <br/>
                        @isset($quantity)

                            @if($quantity > 0)
                                @if($cartItem_id)
                                <form action="{{ route('DeleteCartItem', ['cartItem_id' => $cartItem_id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger">Remove from cart</button>
                                </form>
                                <br/>
                                @endif

                        @endif
                        @endisset

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" id="revDiv">
    <div class="row">
        <div class="col-md-12">
            @if(isset($reviews)&& count($reviews)>0)
            <h2>Product Reviews:</h2>
    <ul class="Revgrid">
        @foreach ($reviews as $review)
            <li class="rev2">
                <strong>User Name:</strong> {{ucwords($review->user_name)}}<br>
                <strong>Rating:</strong> <strong style="font-size:1.2rem;color:#ffb703">{{ $review->rating }} ★</strong><br>
                <strong>Review:</strong> {{ $review->content }}<br>
                <strong>Date:</strong> 
                @php
    $formattedDate = \Carbon\Carbon::parse($review->created_at)->format('F j, Y \a\t g:i A');
@endphp
{{$formattedDate}}<br>
            </li>
        @endforeach
    </ul>
            @else
             <p>No reviews yet, Be the first to add one,<strong> Add Yours now!</strong></p>
            @endif
</div>   
</div>   
</div>   
@else
<div class="container" id="productDiv">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <h1>Not Found</h1>
                    <h3>Category: No data found</h3>
                    <p>Description:<br/>The product you're requesting may have been deleted or the store deactivated</p>


                </div>
            </div>
        </div>
    </div>
</div>
@endisset

@endsection
