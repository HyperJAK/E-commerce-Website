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
        Schema::create('store_reviews', function (Blueprint $table) {
            $table->bigIncrements('product_review_id');
            $table->string('content');
            $table->integer('rating');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('store_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('store_id')->references('store_id')->on('stores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_reviews');
    }
};
