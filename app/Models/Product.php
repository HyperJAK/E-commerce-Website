<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $primaryKey = 'product_id'; //no need to rename it

    use HasFactory;
    protected $fillable = ['name','description','price','category','quantity','path1','path2','path3','path4'];

//    public function stores(){
//     return $this->hasMany(Store::class);
//    }
}
