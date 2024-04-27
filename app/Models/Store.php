<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    use HasFactory;

    protected $primaryKey = 'store_id';
    protected $fillable = ['name','description','status', 'user_id', 'image'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id', 'user_id');//changed this to user_id, because both buyers and
        //seller are users however the seller has the is_seller == true value
    }
    public function getCategories(){
        return $this->hasMany(Category::class, 'category_id', 'category_id');
    }

    protected function casts(): array
    {
        return [
            'status' => 'boolean'
        ];
    }

}
