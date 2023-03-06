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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('code')->nullable();
            $table->string('token')->nullable();
            $table->string('secret')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('role')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('created_at',0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
