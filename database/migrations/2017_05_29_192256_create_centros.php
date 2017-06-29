<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('id_parroquia')->unsigned();
            $table->integer('id_municipio')->unsigned();

            $table->foreign('id_parroquia')->references('id')->on('parroquias')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('id_municipio')->references('id')->on('municipios')->onUpdate('restrict')->onDelete('restrict');
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
        Schema::drop('centros', function ($table){
            $table->dropForeign(['id_parroquia','id_municipio']);
        });
    }
}
