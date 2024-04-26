<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $primaryKey = 'message_id';


    protected $fillable = [
        'content',
        'chat_id',
        'sender_id',
        'recipient_id',
    ];


    public function getchat()
    {
        return $this->belongsTo(Chat::class, 'chat_id', 'chat_id');
    }

    public function getSender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'user_id');
    }


    public function getRecipient()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'user_id');
    }
}
