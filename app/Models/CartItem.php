<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $primaryKey = 'cartItem_id';

    protected $fillable = ['price', 'quantity', 'product_id','cart_id', 'seller_id', 'store_id'];


    public function getSeller(){
        return $this->hasOne(User::class, 'user_id', 'seller_id');
    }
    public function getCart(){
        return $this->belongsTo(Cart::class,'cart_id','cart_id');
    }

    public function getStore(){
        return $this->belongsTo(Store::class,'store_id','store_id');
    }
    public function getCartItems(){
        return $this->getCart()->pluck('product_id');
    }
}
