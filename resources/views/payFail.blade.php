@extends('master2')
@section('title')
<title>Payment Fail | Icom</title>
@endsection
@section('content')
<h1 class="fashion_title">Payment Error!</h1>
    <div class="container" style="margin-top:2%;margin-bottom:5%;width:100%;">
        <div class="row justify-content-center">
        
            <div class="col-md-10">
                <div class="card" style="box-shadow: 0 0 2rem .2rem red;">

                    <div class="card-body fw-bolder">
                        <h1 class="fw-bold">Your Payment hasn't been processed!<h1>
                        <h2><a href="{{route('products')}}">Continue Shopping?</a></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection