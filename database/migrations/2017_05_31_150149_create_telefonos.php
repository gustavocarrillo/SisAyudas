<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonos', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('solicitante_id')->unsigned();

            $table->string('numero',15);

            $table->string('comentario');

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
        Schema::drop('telefonos', function ($table){
            $table->dropForeign(['id_solicitante']);
        });
    }
}
