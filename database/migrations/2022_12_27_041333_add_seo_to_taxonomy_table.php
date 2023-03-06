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
        Schema::table('taxonomy', function (Blueprint $table) {
            //
            $table->string('meta_keyword')->nullable();
            $table->string('h1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taxonomy', function (Blueprint $table) {
            //
            $table->dropColumn('meta_keyword');
            $table->dropColumn('h1');
        });
    }
};
