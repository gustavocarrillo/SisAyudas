<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ElimIdcentroSolicitanteinst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitantes_inst', function (Blueprint $table) {
            $table->dropForeign(['id_centro']);
            $table->dropColumn('id_centro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitantes_inst', function (Blueprint $table) {
            //
        });
    }
}
