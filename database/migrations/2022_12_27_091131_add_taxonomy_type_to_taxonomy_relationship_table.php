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
        Schema::table('taxonomy_relationship', function (Blueprint $table) {
            //
            $table->string('taxonomy_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('taxonomy_relationship', function (Blueprint $table) {
            //
            $table->dropColumn('taxonomy_type');
        });
    }
};
