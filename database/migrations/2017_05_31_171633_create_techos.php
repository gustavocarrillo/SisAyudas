<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('techos', function (Blueprint $table) {

            $table->increments('id');

            $table->enum('tipo',['ZINC','PLACA','ASBESTO','OTRO'])->default('ZINC');

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
        Schema::drop('techos');
    }
}
