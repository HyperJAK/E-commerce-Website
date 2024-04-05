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
            $table->foreign('reviewer_id')->references('user_id')->on('user');
            //here we are using this syntax because we won't always need to fill both these foreign keys so this way they can be null
            $table->foreignId('product_id')->nullable()->constrained('product', 'product_id');
            $table->foreignId('store_id')->nullable()->constrained('store', 'store_id');
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
