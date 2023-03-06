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
        Schema::create('affilate_setting', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('commission')->nullable();
            $table->string('commission_type')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->string('level_group')->nullable();
            $table->integer('number_direct')->nullable();
            $table->integer('personal_balance')->nullable();
            $table->integer('group_balance')->nullable();
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
        Schema::dropIfExists('affilate_setting');
    }
};
