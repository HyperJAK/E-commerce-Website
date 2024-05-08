<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'status',
        'description',
        'address',
        'shipping_method',
        'order_placement_date',
        'total_price',
        'buyer_id',
        'cart_id',
        'location_id'
    ];


    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','user_id');
    }

    //Make sure to add the correct primary and foreign keys (as reference):
    //hasMany and hasOne first id is the one in the table that we are referencing and second one is what its called in this table
    //BelongsTo is the opposite, first id is the current table foreign id name and second is the other table
    public function items(){
        return $this->hasOne(Cart::class, 'cart_id', 'cart_id');
    }

    public function getOrderDate(){
        return Carbon::parse($this->order_placement_date);
}


    public function getTodayIncome(){

        $today = \Carbon\Carbon::now()->toDateString();

        $todayOrders = Order::select('total_price', 'cart_id')->whereDate('order_placement_date', $today)->get();

        //now we calculate the profit
        $totalTodayProfit = 0;

        foreach ($todayOrders as $order){
            //getting the cartId
            $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

            if($cartInfo){
                $cart = new Cart();
                $cart->cart_id = $cartInfo->cart_id;

                //getting the products
                $cartItems = $cart->getSpecificSellerCartItems(Auth::id());

                foreach ($cartItems as $item){
                    if ($item->seller_id == Auth::id()) {
                        $totalTodayProfit +=  $order->total_price;
                        break;
                    }
                }
            }


        }

        return $totalTodayProfit;

    }

    public function getTodayIncomeSpecificStore($storeId){

        //first of all we need to check if this store belongs truly to the signed in user
        $storeInfo = Store::select('user_id')->where('store_id', $storeId)->first();

        if($storeInfo->user_id == Auth::id()){
            $today = \Carbon\Carbon::now()->toDateString();

            $todayOrders = Order::whereDate('order_placement_date', $today)->get();

            $totalTodayProfit = 0;

            foreach ($todayOrders as $order){
                //getting the cartId
                $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

                $cart = new Cart();
                $cart->cart_id = $cartInfo->cart_id;

                //getting the products
                $cartItems = $cart->getCartItems();

                foreach ($cartItems as $item){
                    //next we calculate price only where storeId is equal to cartItem storeid
                    if($item->store_id == $storeId){
                        $totalTodayProfit += ($item->price * $item->quantity);
                    }
                }
            }

            return $totalTodayProfit;
        }
        else{
            return null;
        }



    }

    public function getOrdersSortedByMonth(){
        $currentYear = \Carbon\Carbon::now()->year;
        $yearlyOrders = Order::select('total_price', 'cart_id', 'order_placement_date')->whereYear('order_placement_date', $currentYear)->get();

        //this represents array of arrays where first layer has months and each month has orders
        $ordersByMonth = [];

        foreach ($yearlyOrders as $order) {

            //the cart things are done to check if this order belongs to this seller's store
            $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

            if($cartInfo){
                $cart = new Cart();
                $cart->cart_id = $cartInfo->cart_id;

                $cartItems = $cart->getSpecificSellerCartItems(Auth::id());

                foreach ($cartItems as $item){
                    if ($item->seller_id == Auth::id()) {
                        $orderMonth = Carbon::parse($order->order_placement_date)->month;

                        //here we are initialising the array if its not already done
                        if (!isset($ordersByMonth[$orderMonth])) {
                            $ordersByMonth[$orderMonth] = [];
                        }

                        //and then we put the order in the array of arrays
                        $ordersByMonth[$orderMonth][] = $order;

                        break;
                    }
                }
            }
        }
        return $ordersByMonth;
    }

    public function getOrdersSpecificStoreSortedByMonth($storeId){

        //first of all we need to check if this store belongs truly to the signed in user
        $storeInfo = Store::select('user_id')->where('store_id', $storeId)->first();

        if($storeInfo->user_id == Auth::id()) {

            $currentYear = \Carbon\Carbon::now()->year;
            $yearlyOrders = Order::select('total_price', 'cart_id', 'order_placement_date')->whereYear('order_placement_date', $currentYear)->get();

            //this represents array of arrays where first layer has dayas and each day has orders
            $ordersByMonth = [];

            foreach ($yearlyOrders as $order) {
                //the cart things are done to check if this order belongs to this seller's store
                $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

                if ($cartInfo) {
                    $cart = new Cart();
                    $cart->cart_id = $cartInfo->cart_id;

                    $cartItems = $cart->getSpecificSellerCartItems(Auth::id());

                    foreach ($cartItems as $item) {
                        if ($item->seller_id == Auth::id() && $item->store_id == $storeId) {
                            $orderMonth = Carbon::parse($order->order_placement_date)->month;

                            //here we are initialising the array if its not already done
                            if (!isset($ordersByMonth[$orderMonth])) {
                                $ordersByMonth[$orderMonth] = [];
                            }

                            //and then we put the order in the array of arrays
                            $ordersByMonth[$orderMonth][] = $order;

                            break;
                        }
                    }
                }
            }
            return $ordersByMonth;
        }
        else{
            return null;
        }
    }



    public function getOrdersSortedByDay(){
            $startDate = \Carbon\Carbon::now()->startOfWeek();
            $endDate = \Carbon\Carbon::now()->endOfWeek();


            $weeklyOrders = Order::select('total_price', 'cart_id', 'order_placement_date')->whereBetween('order_placement_date', [$startDate, $endDate])->get();

        //this represents array of arrays where first layer has dayas and each day has orders
            $ordersByDay = [];

            foreach ($weeklyOrders as $order) {
                //the cart things are done to check if this order belongs to this seller's store
                $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

                if($cartInfo){
                    $cart = new Cart();
                    $cart->cart_id = $cartInfo->cart_id;

                    $cartItems = $cart->getSpecificSellerCartItems(Auth::id());

                    foreach ($cartItems as $item){
                        if ($item->seller_id == Auth::id()) {
                            $orderDay = Carbon::parse($order->order_placement_date)->day;

                            //here we are initialising the array if its not already done
                            if (!isset($ordersByDay[$orderDay])) {
                                $ordersByDay[$orderDay] = [];
                            }
                            //and then we put the order in the array of arrays
                            $ordersByDay[$orderDay][] = $order;

                            break;
                        }
                    }
                }
            }
            return $ordersByDay;
    }

    public function getOrdersSpecificStoreSortedByDay($storeId){

        //first of all we need to check if this store belongs truly to the signed in user
        $storeInfo = Store::select('user_id')->where('store_id', $storeId)->first();

        if($storeInfo->user_id == Auth::id()) {
            $startDate = \Carbon\Carbon::now()->startOfWeek();
            $endDate = \Carbon\Carbon::now()->endOfWeek();


            $weeklyOrders = Order::select('total_price', 'cart_id', 'order_placement_date')->whereBetween('order_placement_date', [$startDate, $endDate])->get();

            //this represents array of arrays where first layer has dayas and each day has orders
            $ordersByDay = [];

            foreach ($weeklyOrders as $order) {
                //the cart things are done to check if this order belongs to this seller's store
                $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

                if ($cartInfo) {
                    $cart = new Cart();
                    $cart->cart_id = $cartInfo->cart_id;

                    $cartItems = $cart->getSpecificSellerCartItems(Auth::id());

                    foreach ($cartItems as $item) {
                        if ($item->seller_id == Auth::id() && $item->store_id == $storeId) {
                            $orderDay = Carbon::parse($order->order_placement_date)->day;

                            //here we are initialising the array if its not already done
                            if (!isset($ordersByDay[$orderDay])) {
                                $ordersByDay[$orderDay] = [];
                            }
                            //and then we put the order in the array of arrays
                            $ordersByDay[$orderDay][] = $order;

                            break;
                        }
                    }
                }
            }
            return $ordersByDay;
        }
        else{
            return null;
        }
    }

    public function getTodayNewClients(){
        $today = \Carbon\Carbon::now()->toDateString();

        $todayOrders = Order::select('cart_id')->whereDate('order_placement_date', $today)->distinct()->get();

        $clients = new Collection();

        foreach ($todayOrders as $order){
            //getting the cartId
            $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

            if($cartInfo){
                $cart = new Cart();
                $cart->cart_id = $cartInfo->cart_id;

                //getting the products
                $cartItems = $cart->getSpecificSellerCartItems(Auth::id());

                foreach ($cartItems as $item){

                    $user = User::where('user_id', $cartInfo->buyer_id)->first();

                    if ($user && $item->seller_id == Auth::id()) {
                        //here we are checking to see if this user has already bought somnething from us before meaning he is kinda new
                        //then we check to see if the item he bought was today

                        if (!$clients->contains('user_id', $user->user_id)) {
                                $clients[] = $user;
                                break;

                        }
                        else {
                            //method to iterate over all clients and remove the one we want
                            $clients = $clients->reject(function ($client) use ($user) {
                                return $client->user_id === $user->user_id;
                            });
                            break;
                        }
                    }
                }
            }


        }

        return $clients->toArray();

    }

    public function getTodaySpecificStoreNewClients($storeId){
        //first of all we need to check if this store belongs truly to the signed in user
        $storeInfo = Store::select('user_id')->where('store_id', $storeId)->first();

        if($storeInfo->user_id == Auth::id()) {
            $today = \Carbon\Carbon::now()->toDateString();

            $todayOrders = Order::select('cart_id')->whereDate('order_placement_date', $today)->distinct()->get();

            $clients = new Collection();

            foreach ($todayOrders as $order){
                //getting the cartId
                $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

                if($cartInfo){
                    $cart = new Cart();
                    $cart->cart_id = $cartInfo->cart_id;

                    //getting the products
                    $cartItems = $cart->getSpecificSellerCartItems(Auth::id());

                    foreach ($cartItems as $item){

                        $user = User::where('user_id', $cartInfo->buyer_id)->first();

                        if ($user && $item->seller_id == Auth::id() && $item->store_id == $storeId) {
                            //here we are checking to see if this user has already bought somnething from us before meaning he is kinda new
                            //then we check to see if the item he bought was today

                            if (!$clients->contains('user_id', $user->user_id)) {
                                $clients[] = $user;
                                break;

                            }
                            else {
                                //method to iterate over all clients and remove the one we want
                                $clients = $clients->reject(function ($client) use ($user) {
                                    return $client->user_id === $user->user_id;
                                });
                                break;
                            }
                        }
                    }
                }


            }

            return $clients->toArray();
        }
        else{
            return null;
        }


    }

    public function getTodayClients(){

        $today = \Carbon\Carbon::now()->toDateString();

        $todayOrders = Order::select('cart_id')->whereDate('order_placement_date', $today)->distinct()->get();

        $clients = new Collection();


        foreach ($todayOrders as $order){
            //getting the cartId
            $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

            if($cartInfo){
                $cart = new Cart();
                $cart->cart_id = $cartInfo->cart_id;

                //getting the products
                $cartItems = $cart->getSpecificSellerCartItems(Auth::id());

                foreach ($cartItems as $item){

                    $user = User::where('user_id', $cartInfo->buyer_id)->first();

                    if ($user && !$clients->contains('user_id', $user->user_id) && $item->seller_id == Auth::id()) {
                        $clients[] = $user;
                    }
                }
            }


        }

        return $clients->toArray();

    }


    public function getTodaySpecificStoreClients($storeId){
        //first of all we need to check if this store belongs truly to the signed in user
        $storeInfo = Store::select('user_id')->where('store_id', $storeId)->first();

        if($storeInfo->user_id == Auth::id()){
            $today = \Carbon\Carbon::now()->toDateString();

            $todayOrders = Order::whereDate('order_placement_date', $today)->get();

            $clients = new Collection();

            foreach ($todayOrders as $order){
                //getting the cartId
                $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

                $cart = new Cart();
                $cart->cart_id = $cartInfo->cart_id;

                //getting the products
                $cartItems = $cart->getCartItems();

                foreach ($cartItems as $item){
                    //here when we fill the user we can break since all of these items would belong to the same user
                    //but we needed to check for the store_id which is why we entered this foreach
                    if($item->store_id == $storeId){

                        $user = User::where('user_id', $order->buyer_id)->first();

                        if ($user && !$clients->contains('user_id', $user->user_id)) {
                            $clients[] = $user;
                            break;
                        }

                    }
                }
            }

            return $clients->toArray();
        }
        else{
            return null;
        }

    }

    public function getTotalSales(){
            $orders = Order::select('cart_id')->distinct()->get();

            $totalProfit = 0;

            foreach ($orders as $order){
                //getting the cartId
                $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

                $cart = new Cart();
                $cart->cart_id = $cartInfo->cart_id;

                //getting the products
                $cartItems = $cart->getSpecificSellerCartItems(Auth::id());

                foreach ($cartItems as $item){
                    //next we calculate price only where storeId is equal to cartItem storeid
                    $totalProfit += $item->price;
                }
            }

            return $totalProfit;


    }

    public function getTotalSalesSpecificStore($storeId){
        //first of all we need to check if this store belongs truly to the signed in user
        $storeInfo = Store::select('user_id')->where('store_id', $storeId)->first();

        if($storeInfo->user_id == Auth::id()){
            $orders = Order::get();

            $totalProfit = 0;

            foreach ($orders as $order){
                //getting the cartId
                $cartInfo = Cart::where('cart_id', $order->cart_id)->first();

                $cart = new Cart();
                $cart->cart_id = $cartInfo->cart_id;

                //getting the products
                $cartItems = $cart->getCartItems();

                foreach ($cartItems as $item){
                    //next we calculate price only where storeId is equal to cartItem storeid
                    if($item->store_id == $storeId){
                        $totalProfit += $item->price;
                    }
                }
            }

            return $totalProfit;
        }
        else{
            return null;
        }

    }

    public function getBestSellingProductsThisMonth(){


    }
}
