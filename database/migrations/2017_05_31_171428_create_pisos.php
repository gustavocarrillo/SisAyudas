<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pisos', function (Blueprint $table) {

            $table->increments('id');

            $table->enum('tipo',['CEMENTO','CERAMICA','TIERRA','OTRO'])->default('CEMENTO');

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
        Schema::drop('pisos');
    }
}
