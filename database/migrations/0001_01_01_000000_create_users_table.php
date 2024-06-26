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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('username');
            $table->string('email')->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('address')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('phone')->nullable();
            $table->string('about')->nullable();
            $table->boolean('is_seller')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->string('preferred_currency')->default('USD')->nullable();
            $table->string('currency_symbol')->default('$')->nullable();
            /*$table->unsignedBigInteger('store_id');*/
/*            $table->unsignedBigInteger('cart_id');*/

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        //For now, its not needed
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        /*Schema::create('cache', function ($table) {
            $table->string('key')->unique();
            $table->text('value');
            $table->integer('expiration');
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
     Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
