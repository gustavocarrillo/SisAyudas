<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViviendaServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vivienda_servicio', function (Blueprint $table) {

            $table->integer('id_vivienda')->unsigned();

            $table->integer('id_servicio')->unsigned();

            $table->primary(['id_vivienda','id_servicio']);

            $table->foreign('id_vivienda')
                ->references('id')
                ->on('solicitante_vivienda')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_servicio')
                ->references('id')
                ->on('servicios')
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
        Schema::drop('vivienda_servicio',function ($table){
            $table->dropForeign(['id_vivienda','id_servicio']);
        });
    }
}
