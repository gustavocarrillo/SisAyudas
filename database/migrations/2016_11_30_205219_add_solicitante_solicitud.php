<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSolicitanteSolicitud extends Migration
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
            $table->integer('solicitante_id')->unsigned();
            $table->integer('solicitud_id')->unsigned()->nullable();
            $table->text('detalle');
            $table->string('estatus');
            $table->string('fecha');

            $table->foreign('solicitante_id')->references('id')->on('solicitantes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('solicitud_id')->references('id')->on('solicitudes')->onDelete('set null')->onUpdate('cascade');
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
        Schema::drop('solicitante_solicitud');
    }
}
