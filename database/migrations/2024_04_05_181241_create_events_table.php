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
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('event_id');
            $table->string('name');
            $table->string('description');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->float('starting_price');
            $table->float('current_price');
            $table->string('calendar_link')->nullable();
            $table->unsignedBigInteger('participant_id')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('product_id');

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
