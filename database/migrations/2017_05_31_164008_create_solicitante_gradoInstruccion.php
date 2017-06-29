<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitanteGradoInstruccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitante_gradoinstruccion', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_solicitante')->unsigned()->unique();

            $table->integer('id_gradoinstruccion')->unsigned();

            $table->foreign('id_solicitante')
                ->references('id')
                ->on('solicitantes')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_gradoinstruccion')
                ->references('id')
                ->on('grados_instruccion')
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
        Schema::drop('solicitante_gradoinstruccion',function ($table){
            $table->dropForeign(['id_solicitante','id_gradoinstruccion']);
        });
    }
}
