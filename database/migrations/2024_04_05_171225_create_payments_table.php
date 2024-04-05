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
            $table->foreign('payment_method_id')->references('payment_method_id')->on('PaymentMethod');
            $table->foreign('payment_status_id')->references('payment_status_id')->on('PaymentStatus');
            $table->foreign('order_id')->references('order_id')->on('Order');

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
