<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifEstatusSolicitanteinstSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitanteinst_solicitud', function (Blueprint $table) {

            $table->enum('estatus',['PENDIENTE','APROBADA','NEGADA','ENTREGADA'])
                ->default('PENDIENTE')
                ->after('detalle');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitanteinst_solicitud', function (Blueprint $table) {
            $table->dropColumn('estatus');
        });
    }
}
