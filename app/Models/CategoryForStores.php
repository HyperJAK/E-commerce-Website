<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryForStores extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'store_id'];
}
