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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('name');
            $table->longtext('description');
            $table->double('price');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('store_id');
            $table->foreign('category_id')->references('category_id')->on('categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->integer('quantity');
            $table->string('path1'); //path of images will be stored in a public folder maybe, non nullable because each product need to have 4 pics
            $table->string('path2');
            $table->string('path3');
            $table->string('path4');
            
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
