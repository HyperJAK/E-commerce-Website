<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */


// Not part of fillable but needs to be included:
// a way to tell that the product has many images
// foreign key referencing the Store class

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('product_id');
            $table->string('name');
            $table->longtext('description');
            $table->integer('price');
            $table->string('category');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
