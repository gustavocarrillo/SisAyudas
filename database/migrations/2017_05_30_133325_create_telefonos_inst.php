<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonosInst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonos_inst', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_solicitante_inst')->unsigned();

            $table->string('numero',15)->unique();

            $table->foreign('id_solicitante_inst')
                ->references('id')
                ->on('solicitantes_inst')
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
        Schema::drop('telefonos_inst', function($table){
            $table->dropForeign(['id_solicitante_inst']);
        });
    }
}
