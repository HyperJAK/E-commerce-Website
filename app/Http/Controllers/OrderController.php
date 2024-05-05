<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Location;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function createOrderView(Request $request){

        //retrieving the data of all current carts of the user that were saved in CartController, getActiveCart function
        $data = Session::get('userCart');

        $totalPrice = 0;
        foreach ($data as $item){
            $totalPrice += ($item->price * $item->quantity);
        }

        if ($request->locationId) {
            $location = Location::findOrFail($request->locationId);
        } else {
            $location = null;
        }

        return view('/order/createOrder',['userCartItems'=>$data])->with('totalPrice', $totalPrice)->with('location', $location);
    }

    public function placeOrder(Request $request){

        $request->validate([
            'address' => 'required|string',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $cart = Cart::where('cart_id', $request->cart_id)->first();

        //getting total price of all items in cart
        $cartItems = $cart->getCartItems();
        $totalPrice = 0;

        foreach ($cartItems as $item){
            $totalPrice += ($item->price * $item->quantity);
        }
        $orderStatus = 1;

            Order::create([
                'order_status_id'=> $orderStatus, //by default we put 1 meaning pending in our db
                'address' => $request->address,
                'description' => $request->description,
                'location_id' => $request->location_id,
                'shipping_method' => 'by air',
                'order_placement_date' => now(),
                'total_price' => $totalPrice,
                'buyer_id' => Auth::id(),
                'cart_id' => $request->cart_id,
            ]);

        //setting cart to disabled because user bought all its items
        $cart->disableCart();


        return redirect()->route('home');


    }
}
