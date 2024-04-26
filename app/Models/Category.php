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
    public function getChildrens()
    {
        return $this->belongsTo(Category::class,'category_id','parent_id');
    }
    public function getChildrensId()
    {
        return $this->getChildrens()->pluck('category_id');
    }
    public function getParent()
    {
        return $this->belongsTo(Category::class,'parent_id','category_id');
    }
    public function getParentId()
    {
        return $this->getParent()->pluck('category_id');
    }
   
}
