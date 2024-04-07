<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $primaryKey = 'chat_id';

    protected $fillable = [
        'user_initiator_id',
        'user_target_id'
    ];


    public function getMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function getTarget()
    {
        return $this->belongsTo(User::class, 'user_target_id', 'user_id');
    }


    public function getInitiator()
    {
        return $this->belongsTo(User::class, 'user_initiator_id', 'user_id');
    }
}
