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
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('payment_id');
            $table->double('amount_paid');
            $table->dateTime('date');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('payment_status_id');
            $table->unsignedBigInteger('order_id');


        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
