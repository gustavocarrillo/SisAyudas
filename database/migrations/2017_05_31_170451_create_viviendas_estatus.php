<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViviendasEstatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('viviendas_estatus', function (Blueprint $table) {

            $table->increments('id');

            $table->enum('estatus',['PROPIA','ALQUILADA','INVADIDA','ALOJADA','OTRO'])->default('PROPIA');

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
        Schema::drop('viviendas_estatus');
    }
}
