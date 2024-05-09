@extends('master2')
@section('title')
<title>Place Order | Icom</title>
@endsection
@section('content')
    <div class="container">
        <h1>Orders</h1>
        <ul class="list-group">
            @foreach ($orders as $order)
                <li class="list-group-item">
                    <strong>Order #{{ $order->order_id }}</strong> - Total Price: ${{ $order->total_price }}
                    <br>Status: {{ $order->status }} - Order Date: {{ $order->getOrderDateAttribute() }}
                    <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-primary float-right">View Details</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
