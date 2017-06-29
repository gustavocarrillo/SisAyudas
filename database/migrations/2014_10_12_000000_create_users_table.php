<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('cedula')->unique();
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->enum('tipo',['admin','transcriptor'])->default('transcriptor');
            $table->string('foto')->default('sin_foto_png');
            $table->enum('estatus',['activo','inactivo'])->default('inactivo');
            $table->rememberToken();
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
        Schema::drop('users', function ($table){
            $table->dropForeign(['id_municipios']);
        });
    }
}
