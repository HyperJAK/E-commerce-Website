<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $primaryKey = 'chat_id';

    protected $fillable = [
        'initiator_id',
        'target_id'
    ];


    public function getMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function getTarget()
    {
        return $this->belongsTo(User::class, 'target_id', 'user_id');
    }


    public function getInitiator()
    {
        return $this->belongsTo(User::class, 'initiator_id', 'user_id');
    }
}
