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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('code')->nullable();
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('orgin')->nullable();
            $table->integer('point')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('regular_price')->nullable();
            $table->string('in_stock')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('is_published')->nullable();
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
        Schema::dropIfExists('product');
    }
};
