<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSolicitantesNoCne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitantes_no_cne', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('nacionaliddad',['v','e'])->default('v');
            $table->string('cedula',8)->unique();
            $table->string('nombres',150);
            $table->string('apellidos',150);
            $table->string('telefonos',50)->nullable();
            $table->string('direccion');
            $table->integer('id_municipio')->unsigned()->nullable();
            $table->integer('id_parroquia')->unsigned()->nullable();

            $table->foreign('id_municipio')->references('id')->on('municipios')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('id_parroquia')->references('id')->on('parroquias')->onUpdate('cascade')->onDelete('set null');
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
        Schema::drop('solicitantes_no_cne');
    }
}
