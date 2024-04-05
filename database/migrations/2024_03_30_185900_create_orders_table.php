<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *

This is Orders model example (to connect it to product and buyer also):
Image
Here we create a Cart class that represents a table that holds a specific items of an order so like headset razor, quantity 2 and other details, but it will be created in a different TASK, this is just an example to show how it will be connected to Order (don't mind that in the picture its called OrderItem)
Image

     */

    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status'); //pending, confirmed, shipped, delivered, cancelled
            $table->longtext('description');
            $table->longtext('address');
            $table->string('shipping_method'); //by air, by sea w hek 5bar
            $table->dateTime('order_placement_date');
            $table->double('total_price');
            // ma tnsa to un-comment the next 2 lines after creating
            // $table->foreign('buyer_id')->references('id')->on('user');
            // $table->foreign('seller_id')->references('id')->on('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
