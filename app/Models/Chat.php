<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id', 
    ];

   
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }
}