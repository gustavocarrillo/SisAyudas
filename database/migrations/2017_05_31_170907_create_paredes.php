<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParedes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paredes', function (Blueprint $table) {

            $table->increments('id');

            $table->enum('tipo',['BLOQUE','ZINC','BAHAREQUE','OTRO'])->default('BLOQUE');

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
        Schema::drop('paredes');
    }
}
