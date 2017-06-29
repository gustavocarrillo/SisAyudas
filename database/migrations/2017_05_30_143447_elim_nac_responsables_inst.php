<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ElimNacResponsablesInst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responsables_inst', function (Blueprint $table) {

            if( Schema::hasColumn('responsables_inst','nacionalidad') ) {
                $table->dropColumn('nacionalidad');
            }

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
            $table->string('nacionalidad');
        });
    }
}
