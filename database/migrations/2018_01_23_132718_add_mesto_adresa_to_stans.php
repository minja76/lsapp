<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMestoAdresaToStans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stans', function ($table) {
            $table->integer('sifra_mesto');
            $table->foreign('sifra_mesto')->references('sifra')->on('mesto');
            $table->integer('sifra_adresa');
            $table->foreign('sifra_adresa')->references('id')->on('adresa');
          

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stans', function ($table) {
            $table->dropColumn('sifra_mesto');
            $table->dropColumn('sifra_adresa');
        });
    }
}
