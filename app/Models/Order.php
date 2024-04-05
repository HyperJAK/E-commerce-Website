<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'seller_id'
    ];


    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','user_id');
    }
    public function seller(){
        return $this->belongsTo(User::class,'seller_id','user_id');
    }
    public function items(){
        return $this->hasMany(Cart::class);
    }

    public function getOrderDate(){
        return Carbon::parse($this->order_placement_date);
}
}
