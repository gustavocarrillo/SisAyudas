<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitanteProfesion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitante_profesion', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_solicitante')->unsigned()->unique();

            $table->integer('id_profesion')->unsigned();

            $table->foreign('id_solicitante')
                ->references('id')
                ->on('solicitantes')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_profesion')
                ->references('id')
                ->on('profesiones')
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
        Schema::drop('solicitante_profesion',function ($table){
            $table->dropForeign(['id_solicitante','id_profesion']);
        });
    }
}
