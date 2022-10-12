<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('products_id')->nullable();
            $table->unsignedInteger('quantity');
            $table->string('shipping_details', 255);
            $table->string('payment_details', 255)->nullable();
            $table->string('phone')->nullable();
            $table->string('cardNo')->nullable();
            $table->string('name',50)->nullable(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
