<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Location;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
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

        //here we are getting and converting the total price using the currency change
        $cur = new CurrencyConverterController();
        $userPreferedCurrency = User::select('preferred_currency')->where('user_id', Auth::id())->first();
        $totalPrice = $totalPrice * $cur->getCurrencyRate($userPreferedCurrency->preferred_currency);

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
            'shipping_method' => 'required|string'
        ]);

        $cart = Cart::where('cart_id', $request->cart_id)->first();

        //getting total price of all items in cart
        $cartItems = $cart->getCartItems();
        $totalPrice = 0;

        foreach ($cartItems as $item){
            $totalPrice += ($item->price * $item->quantity);

            //then we remove the bought product amount of each
            $product = Product::where('product_id', $item->product_id)->first();
            $product->subtractQuantity($item->quantity);
        }
        $orderStatus = 1;

            Order::create([
                'order_status_id'=> $orderStatus, //by default we put 1 meaning pending in our db
                'address' => $request->address,
                'description' => $request->description,
                'location_id' => $request->location_id,
                'shipping_method' => $request->shipping_method,
                'order_placement_date' => now(),
                'total_price' => $totalPrice,
                'buyer_id' => Auth::id(),
                'cart_id' => $request->cart_id,
            ]);

        //setting cart to disabled because user bought all its items
        $cart->disableCart();


        return redirect()->route('home');


    }


    public function getOrdersSortedByMonth(){

        $profit = new Order();

        return $profit->getOrdersSortedByMonth();
    }

    public function getOrdersSpecificStoreSortedByMonth(Request $request){
        $profit = new Order();

        return $profit->getOrdersSpecificStoreSortedByMonth($request->store_id);

    }


    public function getOrdersSortedByDay(){
        $profit = new Order();

        return $profit->getOrdersSortedByDay();

    }

    public function getOrdersSpecificStoreSortedByDay(Request $request){
        $profit = new Order();

        return $profit->getOrdersSpecificStoreSortedByDay($request->store_id);

    }

    public function getTodayIncome(){
        $profit = new Order();

        return $profit->getTodayIncome();

    }


    public function getTodayIncomeSpecificStore(Request $request){
        $profit = new Order();

        return $profit->getTodayIncomeSpecificStore($request->store_id);

    }

    public function getTodayNewCLients(){


    }

    public function getTodayClients(){
        $clients = new Order();

        return $clients->getTodayClients();

    }

    public function getTodaySpecificStoreClients(Request $request){
        $clients = new Order();

        return $clients->getTodaySpecificStoreClients($request->store_id);

    }

    public function getTotalSales(){
        $sales = new Order();

        return $sales->getTotalSales();

    }

    public function getTotalSalesSpecificStore(Request $request){
        $sales = new Order();

        return $sales->getTotalSalesSpecificStore($request->store_id);
    }

    public function getBestSellingProductsThisMonth(){


    }
}
