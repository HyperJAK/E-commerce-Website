<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id'; 
    protected $fillable = ['name','description','parent_id','store_id'];
    public function stores()
    {
        return $this->belongsTo(Store::class,'store_id','store_id');
    }
}
