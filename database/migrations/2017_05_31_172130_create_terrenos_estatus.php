<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTerrenosEstatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terrenos_estatus', function (Blueprint $table) {

            $table->increments('id');

            $table->enum('estatus',['PROPIO','ALQUILADO','INVADIDO','MUNICIPAL'])->default('PROPIO');

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
        Schema::drop('terrenos_estatus');
    }
}
