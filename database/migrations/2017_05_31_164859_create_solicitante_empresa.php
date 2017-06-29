<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitanteEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitante_empresa', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_solicitante')->unsigned()->unique();

            $table->integer('id_empresa')->unsigned();

            $table->enum('condicion',['FIJO','CONTRATADO','JUBILADO'])->default('CONTRATADO');

            $table->foreign('id_solicitante')
                ->references('id')
                ->on('solicitantes')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_empresa')
                ->references('id')
                ->on('empresas')
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
        Schema::drop('solicitante_empresa',function ($table){
            $table->dropForeign(['id_solicitante','id_empresa']);
        });
    }
}
