<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Display a list of all orders
    public function index()
    {
        $orders = Order::with(['buyer', 'seller', 'items'])->get();
        return view('orders.index', compact('orders'));
    }

    // Show the form for creating a new order
    public function create()
    {
        return view('orders.create');
    }

    // Store a newly created order in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required',
            'address' => 'required',
            'shipping_method' => 'required',
            'total_price' => 'required|numeric',
            'buyer_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id'
        ]);

        $order = Order::create($validated);
        return redirect()->route('orders.index');
    }

    // Display the specified order
    public function show($id)
    {
        $order = Order::with(['buyer', 'seller', 'items'])->find($id);
        return view('orders.show', compact('order'));
    }

    // Show the form for editing the specified order
    public function edit($id)
    {
        $order = Order::find($id);
        return view('orders.edit', compact('order'));
    }

    // Update the specified order in the database
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'description' => 'required',
            'address' => 'required',
            'shipping_method' => 'required',
            'total_price' => 'required|numeric',
            'buyer_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id'
        ]);

        $order = Order::find($id);
        $order->update($validated);
        return redirect()->route('orders.index');
    }

    // Remove the specified order from the database
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('orders.index');
    }

    // Additional methods to modify products within an order
    public function addProductToOrder(Request $request, $orderId)
    {
        $order = Order::find($orderId);
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $order->products()->attach($product_id, ['quantity' => $quantity]);
        return redirect()->back();
    }

    public function updateProductInOrder(Request $request, $orderId, $productId)
    {
        $order = Order::find($orderId);
        $quantity = $request->quantity;
        $order->products()->updateExistingPivot($productId, ['quantity' => $quantity]);
        return redirect()->back();
    }

    public function removeProductFromOrder($orderId, $productId)
    {
        $order = Order::find($orderId);
        $order->products()->detach($productId);
        return redirect()->back();
    }
}
