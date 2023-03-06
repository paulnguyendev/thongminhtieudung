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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('code')->nullable();
            $table->integer('point')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_sale')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('is_best_seller')->nullable();
            $table->string('is_certificate')->nullable();
            $table->string('video_intro')->nullable();
            $table->integer('time')->nullable();
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
        Schema::dropIfExists('course');
    }
};
