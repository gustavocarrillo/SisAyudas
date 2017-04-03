<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSolicitantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitantes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo_reg',['v','e','j','c']);
            $table->string('cedula')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono')->nullable();
            $table->integer('id_municipio')->unsigned()->nullable();
            $table->integer('id_parroquia')->unsigned()->nullable();
            $table->integer('id_centro')->unsigned()->nullable();

            $table->foreign('id_municipio')->references('id')->on('municipios')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_parroquia')->references('id')->on('parroquias')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('id_centro')->references('id')->on('centros')->onDelete('set null')->onUpdate('cascade');
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
        Schema::drop('solicitantes');
    }
}
