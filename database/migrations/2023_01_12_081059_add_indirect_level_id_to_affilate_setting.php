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
        Schema::table('affilate_setting', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('indirect_level_id')->nullable();
            $table->foreign('indirect_level_id')->references('id')->on('affilate_level')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('affilate_setting', function (Blueprint $table) {
            //
            $table->dropForeign('indirect_level_id_foreign');
            $table->dropColumn('indirect_level_id');
            
        });
    }
};
