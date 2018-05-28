<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLatLngToStans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stans', function (Blueprint $table) {
            //
            $table->float('lat',10,6)->nullable();
            $table->float('lng',10,6)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stans', function (Blueprint $table) {
            //
            $table->dropColumn('lat');
            $table->dropColumn('lng');
        });
    }
}
