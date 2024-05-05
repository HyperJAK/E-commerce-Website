<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $primaryKey = 'cart_id';

    protected $fillable = ['buyer_id','status'];

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => 'boolean'
        ];
    }

    public function getCartItems(){
        $cartItems = CartItem::where('cart_id', $this->cart_id)->get();
        return $cartItems;
    }

    public function disableCart(){
        $this->status = 1;
        $this->save();
    }


    public function getBuyer(){
        return $this->belongsTo(User::class,'buyer_id','user_id');
    }
}
