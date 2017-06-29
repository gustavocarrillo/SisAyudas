<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupofamiliarProfesion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupofamiliar_profesion', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_grupofamiliar')->unsigned()->unique();

            $table->integer('id_profesion')->unsigned();

            $table->foreign('id_grupofamiliar')
                ->references('id')
                ->on('grupos_familiares')
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
        Schema::drop('grupofamiliar_profesion',function ($table){
            $table->dropForeign(['id_grupofamiliar','id_profesion']);
        });
    }
}
