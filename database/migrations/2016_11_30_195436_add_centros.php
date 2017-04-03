<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCentros extends Migration
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
            $table->string('nombre')->unique();
            $table->integer('id_municipio')->unsigned()->nullable();
            $table->integer('id_parroquia')->unsigned()->nullable();

            $table->foreign('id_municipio')->references('id')->on('municipios')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_parroquia')->references('id')->on('parroquias')->onDelete('set null')->onUpdate('cascade');
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
        Schema::drop('centros');
    }
}
