<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnumNacResponsablesInst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responsables_inst', function (Blueprint $table) {
            $table->enum('nacionalidad',['V','E'])->default('V')->after('id_solicintante_inst');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responsables_inst', function (Blueprint $table) {
            $table->dropColumn('nacionalidad');
        });
    }
}
