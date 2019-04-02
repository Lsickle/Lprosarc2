<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignSolresrespelToSolicituResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->unsignedInteger('FK_SolResRespel')->nullable();
            $table->foreign('FK_SolResRespel')->references('ID_Respel')->on('respels');
            $table->unsignedInteger('FK_SolResSolSer')->nullable();
            $table->foreign('FK_SolResSolSer')->references('ID_SolSer')->on('solicitud_servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->dropForeign('solicitud_residuos_FK_SolResRespel_foreign');
            $table->dropColumn('FK_SolResRespel');
            $table->dropForeign('solicitud_residuos_FK_SolResSolSer_foreign');
            $table->dropColumn('FK_SolResSolSer');
        });
    }
}
