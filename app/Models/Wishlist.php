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
}
