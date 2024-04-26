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
            $table->unsignedBigInteger('user_initiator_id');
            $table->unsignedBigInteger('user_target_id');

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
