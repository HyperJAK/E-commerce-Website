<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->text('content'); 
            $table->timestamp('timestamp')->nullable();
            $table->foreignId('chat_id')->constrained('chats'); 
            $table->foreignId('sender_id')->constrained('users');
            $table->foreignId('recipient_id')->constrained('users');
            $table->foreignId('store_id')->constrained('store'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
