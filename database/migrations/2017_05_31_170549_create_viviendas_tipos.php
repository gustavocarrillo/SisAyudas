<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViviendasTipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viviendas_tipos', function (Blueprint $table) {

            $table->increments('id');

            $table->enum('tipo',['CASA O QUINTA','APARTAMENTO','RANCHO','OTRO'])->default('CASA O QUINTA');

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
        Schema::drop('viviendas_tipos');
    }
}
