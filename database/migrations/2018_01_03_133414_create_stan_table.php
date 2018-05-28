<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stans', function (Blueprint $table) {
            $table->increments('id');                    
            $table->string('grad');           
            $table->string('ulica');
            $table->integer('broj');
            $table->integer('km');
            $table->integer('cena');
            $table->text('opis');
            $table->string('cover_image');
            $table->integer('user_id');           
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
        Schema::dropIfExists('stans');
    }
}
