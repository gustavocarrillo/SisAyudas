<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitanteVivienda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitante_vivienda', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_solicitante')->unsigned()->unique();

            $table->integer('id_viviendatipo')->unsigned();

            $table->integer('id_terrenoestatus')->unsigned();

            $table->integer('id_viviendaestatus')->unsigned();

            $table->integer('id_pared')->unsigned();

            $table->integer('id_piso')->unsigned();

            $table->integer('id_techo')->unsigned();

            $table->enum('tiempo_sector',['DIAS-MESES','1-3 AÑOS','6-10 AÑOS','11 O MAS']);

            $table->foreign('id_solicitante')
                ->references('id')
                ->on('solicitantes')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_viviendatipo')
                ->references('id')
                ->on('viviendas_tipos')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_terrenoestatus')
                ->references('id')
                ->on('terrenos_estatus')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_viviendaestatus')
                ->references('id')
                ->on('viviendas_estatus')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_pared')
                ->references('id')
                ->on('paredes')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_piso')
                ->references('id')
                ->on('pisos')
                ->onUpdate('restrict')
                ->onDelete('restrict');

            $table->foreign('id_techo')
                ->references('id')
                ->on('techos')
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
        Schema::drop('solicitante_vivienda',function ($table){
            $table->dropForeign(
                ['id_solicitante',
                    'id_viviendatipo',
                    'id_terrenoestatus',
                    'id_viviendaestatus',
                    'id_pared',
                    'id_piso',
                    'id_techo'
                ]);
        });
    }
}
