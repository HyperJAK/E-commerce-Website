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
        $todayOrders = Order::select('total_price')->whereDate('order_placement_date', $today)->get();

        //now we calculate the profit
        $totalTodayProfit = 0;
        foreach ($todayOrders as $order){

            $totalTodayProfit +=  $order->total_price;
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


    }


    public function getOrdersSortedByDay(){


    }

    public function getTodayNewCLients(){


    }

    public function getTodayClients(){
        $today = \Carbon\Carbon::now()->toDateString();
        $todayOrders = Order::select('buyer_id')->whereDate('order_placement_date', $today)->distinct()->get();

        $clients = [];

        foreach ($todayOrders as $order){
            $user = User::where('user_id', $order->buyer_id)->first();

            if ($user && !in_array($user, $clients, true)) {
                $clients[] = $user;
            }

        }

        return $clients;

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


    }

    public function getBestSellingProductsThisMonth(){


    }
}
