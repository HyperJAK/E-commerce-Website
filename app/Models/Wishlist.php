<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $primaryKey = 'wishlist_id';
    protected $fillable = [
        'user_id',
        'product_id',
        'store_id',
    ];
    public function getProd(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
       }
       public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
       }
    public function getUserStatus($user_id){
        return $this->getProd()->where('user_id',$user_id);
       }
    public function getProdName(){
        return $this->getProd()->pluck('name');
       }
       public function getProdPic(){
        return $this->getProd()->pluck('path1');
       }
}
