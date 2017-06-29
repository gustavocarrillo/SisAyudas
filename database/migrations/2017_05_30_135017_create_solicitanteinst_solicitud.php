<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitanteinstSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitanteinst_solicitud', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_evento')->unsigned();

            $table->integer('id_solicitanteinst')->unsigned();

            $table->integer('id_solicitud')->unsigned();

            $table->string('fecha');

            $table->text('detalle');

            $table->string('fecha_pro');

            $table->integer('id_usuario')->unsigned();

            $table->foreign('id_evento')
                ->references('id')
                ->on('eventos')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_solicitanteinst')
                ->references('id')
                ->on('solicitantes_inst')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_solicitud')
                ->references('id')
                ->on('solicitudes')
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
        Schema::drop('solicitanteinst_solicitud', function ($table){
            $table->dropForeign(['id_evento','id_solicitanteinst','id_solicitud','id_usuario']);
        });
    }
}
