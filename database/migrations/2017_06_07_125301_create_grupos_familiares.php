<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposFamiliares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos_familiares', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_solicitante')->unsigned();

            $table->string('cedula')->unique();

            $table->enum('nacionalidad',['V','E'])->default('V');

            $table->string('fecha_nac');

            $table->enum('genero',['F','M']);

            $table->enum('parentesco',['PADRE','MADRE','HIJO','HIJA','OTRO']);

            $table->enum('discapacitado',['SI','NO'])->default('NO');

            $table->foreign('id_solicitante')
                ->references('id')
                ->on('solicitantes')
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
        Schema::drop('grupos_familiares', function ($table){
            $table->dropForeign(['id_solicitante']);
        });
    }
}
