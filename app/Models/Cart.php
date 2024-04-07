<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $primaryKey = 'cart_id';

    protected $fillable = ['buyer_id','cartItem_id'];


    public function buyer(){
        return $this->belongsTo(User::class,'buyer_id','user_id');
    }

    public function items(){
        return $this->hasMany(CartItem::class);
    }
}
