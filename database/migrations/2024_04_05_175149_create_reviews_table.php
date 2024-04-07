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
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('review_id');
            $table->string('content');
            $table->integer('rating');
            $table->unsignedBigInteger('reviewer_id');
            /*$table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();*/
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
