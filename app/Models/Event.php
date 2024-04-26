<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $primaryKey = 'event_id';

    protected $fillable = ['name','description', 'start_date', 'end_date', 'calendar_link', 'participant_id', 'store_id','product_id'];

    public function getParticipants(){
        return $this->hasMany(User::class, 'user_id', 'participant_id');
    }

    public function getStore(){
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }
    public function getProduct(){
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }


}
