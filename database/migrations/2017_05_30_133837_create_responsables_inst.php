<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsablesInst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsables_inst', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('id_solicintante_inst')->unsigned();

            $table->string('nacionalidad');

            $table->string('cedula')->unique();

            $table->string('nombre_apellidos');

            $table->string('telefono')->unique();

            $table->foreign('id_solicintante_inst')
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
        Schema::drop('responsables_inst', function ($table){
            $table->dropForeign(['id_solicintante_inst']);
        });
    }
}
