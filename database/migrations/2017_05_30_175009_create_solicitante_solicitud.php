<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitanteSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitante_solicitud', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_solicitante')->unsigned();

            $table->integer('id_solicitud')->unsigned();

            $table->integer('id_evento')->unsigned();

            $table->string('fecha');

            $table->text('detalle');

            $table->enum('estatus',['APROBADA','NEGADA','PENDIENTE','ENTREGADA'])->default('PENDIENTE');

            $table->string('fecha_pro');

            $table->integer('id_usuario')->unsigned();

            $table->foreign('id_solicitante')
                ->references('id')
                ->on('solicitantes')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_solicitud')
                ->references('id')
                ->on('solicitudes')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_evento')
                ->references('id')
                ->on('eventos')
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
        Schema::drop('solicitante_solicitud', function ($table){
            $table->dropForeign(['id_solicitante','id_solicitud','id_evento','id_usuario']);
        });
    }
}
