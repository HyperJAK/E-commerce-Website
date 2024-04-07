<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $primaryKey = 'cart_id';

    protected $fillable = ['buyer_id'];


    public function getBuyer(){
        return $this->belongsTo(User::class,'buyer_id','user_id');
    }
}
