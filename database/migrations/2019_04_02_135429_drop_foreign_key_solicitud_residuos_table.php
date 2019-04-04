<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignKeySolicitudResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->dropForeign('solicitud_residuos_FK_SolResRespel_foreign');
            $table->dropColumn('FK_SolResRespel');
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
            $table->unsignedInteger('FK_SolResRespel');
            $table->foreign('FK_SolResRespel')->references('ID_Respel')->on('respels');
        });
    }
}
