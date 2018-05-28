<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStanKarakter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('stan_karakter', function (Blueprint $table) {
            $table->integer('stan_id');
            $table->foreign('stan_id')->references('id')->on('stans');
            $table->integer('karakter_id');
            $table->foreign('karakter_id')->references('id')->on('karakters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('stan_karakter');
    }

}
