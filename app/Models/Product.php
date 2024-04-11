<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id'; //no need to rename it

    protected $fillable = ['name','description','price','category','quantity','path1','path2','path3','path4', 'store_id'];

    //changed to hasOne for less complications that way we know that this product belongs to only this store
    public function getStores(){
     return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }
    public function getCategories(){
     return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
