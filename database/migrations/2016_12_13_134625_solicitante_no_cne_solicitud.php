<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SolicitanteNoCneSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitantenocne_solicitud', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_solicitante')->unsigned()->nullable();
            $table->integer('id_solicitud')->unsigned()->nullable();
            $table->string('detalle');
            $table->string('fecha');
            $table->enum('estatus',['PROCESADA','PENDIENTE'])->default('PENDIENTE');
            $table->string('fecha_pro');

            $table->foreign('id_solicitante')->references('id')->on('solicitantes_no_cne')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('id_solicitud')->references('id')->on('solicitudes')->onUpdate('cascade')->onDelete('set null');
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
        Schema::drop('solicitantenocne_solicitud');
    }
}
