@extends('master2')

@section('content')
    <div class="container">
        <h1>Order Details</h1>
        <div class="card">
            <div class="card-header">
                Order #{{ $order->order_id }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Total Price: ${{ $order->total_price }}</h5>
                <p class="card-text">
                    <strong>Status:</strong> {{ $order->status }}




                    <br><strong>Description:</strong> {{ $order->description }}
<br><strong>Shipping Method:</strong> {{ $order->shipping_method }}
<br><strong>Address:</strong> {{ $order->address }}
<br><strong>Order Date:</strong> {{ $order->getOrderDateAttribute() }}
</p>
@if ($order->cart)
    <hr>
    <h5>Items in Order:</h5>
    <ul>
        @foreach ($order->cart->products as $product)
            <li>{{ $product->name }} - Quantity: {{ $product->pivot->quantity }} - ${{ $product->pivot->price }}</li>
        @endforeach
    </ul>
@else
    <p>No items found in this order.</p>
    @endif
    </div>
    </div>
    </div>
    @endsection
