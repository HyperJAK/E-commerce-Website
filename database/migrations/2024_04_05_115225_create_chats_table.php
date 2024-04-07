<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('chat_id');
            $table->unsignedBigInteger('initiator_id');
            $table->unsignedBigInteger('target_id');
            $table->foreignId('initiator_id')->constrained('users');
            $table->foreignId('target_id')->constrained('users');
            $table->timestamps();
        });

        /* commented for testing
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->foreignId('chat_id')->constrained();
        });*/
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
