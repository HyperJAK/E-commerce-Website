<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryForStores extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'store_id'];
    public function CatStr()
    {
        return $this->belongsTo(Store::class,'store_id','store_id');;
    } 
    public function getCatNameStore()
    {
        return $this->belongsTo(Category::class,'category_id','category_id')->pluck('name');
    }
}
