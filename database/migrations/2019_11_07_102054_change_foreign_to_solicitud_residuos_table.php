<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeignToSolicitudResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->dropForeign('solicitud_residuos_fk_solrestratamiento_foreign');
            $table->dropColumn('FK_SolResTratamiento');
            $table->unsignedInteger('FK_SolResRequerimiento')->nullable();
            $table->foreign('FK_SolResRequerimiento')->references('ID_Req')->on('requerimientos')->onDelete('set null');
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
            $table->unsignedInteger('FK_SolResTratamiento')->nullable();
            $table->foreign('FK_SolResTratamiento')->references('ID_Trat')->on('tratamientos')->onDelete('set null');
            $table->dropForeign('solicitud_residuos_fk_solresrequerimiento_foreign');
            $table->dropColumn('FK_SolResRequerimiento');

        });
    }
}
