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
        Schema::table('users', function (Blueprint $table) {
            /*            $table->foreign('store_id')->references('store_id')->on('stores');*/
            /*$table->foreign('cart_id')->references('cart_id')->on('carts');*/
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('cascade');
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('buyer_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('buyer_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('seller_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('cart_id')->references('cart_id')->on('carts')->onDelete('cascade');
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->foreign('user_initiator_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('user_target_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        Schema::table('chat_messages', function (Blueprint $table) {
            $table->foreign('chat_id')->references('chat_id')->on('chats')->onDelete('cascade');
            $table->foreign('sender_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        Schema::table('stores', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('payment_method_id')->references('payment_method_id')->on('payment_methods')->onDelete('cascade');
            $table->foreign('payment_status_id')->references('payment_status_id')->on('payment_statuses')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('Orders')->onDelete('cascade');
        });

        Schema::table('reviews', function (Blueprint $table) {
            //here we are using this syntax because we won't always need to fill both these foreign keys so this way they can be null
            $table->foreignId('product_id')->nullable()->constrained('products', 'product_id')->onDelete('cascade');
            $table->foreignId('store_id')->nullable()->constrained('stores', 'store_id')->onDelete('cascade');
            $table->foreign('reviewer_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('participant_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('cart_id')->references('cart_id')->on('carts')->onDelete('cascade');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('order_status_id')->references('order_status_id')->on('order_statuses')->onDelete('cascade');
        });

        Schema::table('wishlists', function (Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('store_id')->references('store_id')->on('stores')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*Schema::table('tables2', function (Blueprint $table) {
            //
        });*/
    }
};
