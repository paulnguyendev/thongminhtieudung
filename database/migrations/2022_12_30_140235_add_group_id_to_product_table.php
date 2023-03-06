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
        Schema::table('product', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('product_group_id')->nullable();
            $table->foreign('product_group_id')->references('id')->on('product_group')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            //
            $table->dropForeign('product_group_id_foreign');
            $table->dropColumn('product_group_id');
        });
    }
};
