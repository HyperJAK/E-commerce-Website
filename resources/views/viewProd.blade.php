@extends('master2')
@section('title')
<title>Products</title>
@endsection
@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset($obj->path1) }}" class="img-fluid" alt="Product Image">
        </div>
        <div class="col-md-6">
            <h1>{{ $obj->name }}</h1>
            <p>{{ $obj->description }}</p>
            <p>Price: ${{ $obj->price }}</p>
            <p>Available Quantity: {{ $obj->quantity }}</p>
            <p>Category: {{ $obj->category_id[0] }}</p>
            <form action="{{ route('/') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
    </div>
</div> -->

<div class="container" id="productDiv">
    <div class="row">
        <div class="col-md-6">
            <div id="productCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset($obj->path1) }}" class="d-block" alt="Product Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset($obj->path2) }}" class="d-block" alt="Product Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset($obj->path3) }}" class="d-block" alt="Product Image 3">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset($obj->path4) }}" class="d-block" alt="Product Image 4">
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
                    <h4>⁕Store Name: {{ $obj->store_name[0] }}</h4>
                    <p>Description:<br/>{{ $obj->description }}</p>
                    <h4>Price: ${{ $obj->price }}</h4>
                    <p>Available Quantity: {{ $obj->quantity }}</p>
                    
                <div class="col-md-8" id="ProdBtns">
                    <form action="{{ route('/') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark">Add to Wishlist ❤</button>
                    </form>
                    <form action="{{ route('/') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Add to Cart</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
