<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitanteDiscapacidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitante_discapacidad', function (Blueprint $table) {

            $table->integer('id_solicitante')->unsigned();

            $table->integer('id_discapacidad')->unsigned();

            $table->text('detalle');

            $table->primary(['id_solicitante','id_discapacidad']);

            $table->foreign('id_solicitante')
                ->references('id')
                ->on('solicitantes')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_discapacidad')
                ->references('id')
                ->on('discapacidades')
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
        Schema::drop('solicitante_discapacidad',function ($table){
            $table->dropForeign(['id_solicitante','id_discapacidad']);
        });
    }
}
