<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function getOrdersSortedByMonth(){


    }


    public function getOrdersSortedByDay(){


    }

    public function getTodayNewCLients(){


    }

    public function getTodayClients(){


    }

    public function getTotalSales(){


    }

    public function getBestSellingProductsThisMonth(){


    }
}
