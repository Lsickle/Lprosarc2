<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermanentColumnToSolicitudResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->boolean('auto_SolResFotoDescargue_Pesaje')->default(0);
            $table->boolean('auto_SolResFotoTratamiento')->default(0);
            $table->boolean('auto_SolResVideoDescargue_Pesaje')->default(0);
            $table->boolean('auto_SolResVideoTratamiento')->default(0);
            $table->boolean('auto_SolResDevolucion')->default(0);
            $table->boolean('auto_SolResAuditoria')->default(0);
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
            $table->dropColumn('auto_SolResFotoDescargue_Pesaje');
            $table->dropColumn('auto_SolResFotoTratamiento');
            $table->dropColumn('auto_SolResVideoDescargue_Pesaje');
            $table->dropColumn('auto_SolResVideoTratamiento');
            $table->dropColumn('auto_SolResDevolucion');
            $table->dropColumn('auto_SolResAuditoria');
        });
    }
}
