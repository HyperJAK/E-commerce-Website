<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'review_id';

    protected $fillable = ['content','rating', 'buyer_id', 'product_id', 'store_id'];

    //changed to hasOne for less complications that way we know that this product belongs to only this store
    public function getReviewer(){
        return $this->belongsTo(User::class, 'buyer_id', 'user_id');
    }

    public function getReviewedProduct(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function getReviewedStore(){
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }

}
