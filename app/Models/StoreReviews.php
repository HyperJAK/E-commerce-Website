<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreReviews extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_review_id';

    protected $fillable = ['content','rating', 'user_id', 'store_id'];

    //changed to hasOne for less complications that way we know that this product belongs to only this store
    public function user(){
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function store(){
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }
}
