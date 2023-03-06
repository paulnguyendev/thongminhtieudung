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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('discount')->nullable();
            $table->json('info_order')->nullable();
            $table->json('info_shipping')->nullable();
            $table->text('note')->nullable();
            $table->json('payment')->nullable();
            $table->json('products')->nullable();
            $table->json('shipping')->nullable();
            $table->integer('subtotal')->nullable();
            $table->integer('total')->nullable();
            $table->integer('total_weight')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};
