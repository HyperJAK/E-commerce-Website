<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'content', 
        'timestamp', 
        'chat_id', 
        'sender_id',
        'recipient_id', 
    ];

    
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
