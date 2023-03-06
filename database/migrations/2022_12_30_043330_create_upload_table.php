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
        Schema::create('upload', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->string('url')->nullable();
            $table->string('thumb')->nullable();
            $table->string('time')->nullable();
            $table->integer('size')->nullable();
            $table->string('disk')->nullable();
            $table->string('folder_id')->nullable();
            $table->string('folder')->nullable();
            $table->dateTime('newtime')->nullable();
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
        Schema::dropIfExists('upload');
    }
};
