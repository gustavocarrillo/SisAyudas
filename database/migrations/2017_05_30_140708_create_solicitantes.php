<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitantes extends Migration
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

            $table->enum('nacionalidad',['V','E'])->default('V');

            $table->string('cedula')->unique();

            $table->string('nombres');

            $table->string('apellidos');

            $table->string('fecha_nac');

            $table->enum('genero',['M','F']);

            $table->string('direccion');

            $table->enum('edo_civil',['CASAD@','SOLTER@','VIUD@']);

            $table->integer('id_municipio')->unsigned();

            $table->integer('id_parroquia')->unsigned();

            $table->integer('id_centro')->unsigned();

            $table->integer('id_usuario')->unsigned();

            $table->foreign('id_municipio')
                ->references('id')
                ->on('municipios')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_parroquia')
                ->references('id')
                ->on('parroquias')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_centro')
                ->references('id')
                ->on('centros')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_usuario')
                ->references('id')
                ->on('users')
                ->onUpdate('restrict')
                ->onDelete('restrict');

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
        Schema::drop('solicitantes', function ($table){
            $table->dropForeign(['id_municipio','id_parroquia','id_centro','id_usuario']);
        });
    }
}
