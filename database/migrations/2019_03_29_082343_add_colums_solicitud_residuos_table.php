<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsSolicitudResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->boolean('SolResFotoCargue')->nullable();
            $table->boolean('SolResFotoDescargue')->nullable();
            $table->boolean('SolResFotoPesaje')->nullable();
            $table->boolean('SolResFotoReempacado')->nullable();
            $table->boolean('SolResFotoMezclado')->nullable();
            $table->boolean('SolResFotoDestruccion')->nullable();
            $table->boolean('SolResVideoCargue')->nullable();
            $table->boolean('SolResVideoDescargue')->nullable();
            $table->boolean('SolResVideoPesaje')->nullable();
            $table->boolean('SolResVideoReempacado')->nullable();
            $table->boolean('SolResVideoMezclado')->nullable();
            $table->boolean('SolResVideoDestruccion')->nullable();
            $table->boolean('SolResAuditoria')->nullable();
            $table->string('SolResAuditoriaTipo', 16)->nullable();
            $table->boolean('SolResDevolucion')->nullable();
            $table->string('SolResDevolucionTipo', 128)->nullable();
            $table->boolean('SolResDatosPersonal')->nullable();
            $table->boolean('SolResPlanillas')->nullable();
            $table->boolean('SolResAlistamiento')->nullable();
            $table->boolean('SolResCapacitacion')->nullable();
            $table->boolean('SolResBascula')->nullable();
            $table->boolean('SolResMasPerson')->nullable();
            $table->boolean('SolResPlatform')->nullable();
            $table->boolean('SolResCertiEspecial')->nullable();
            $table->string('SolResTipoCate');
            $table->unsignedInteger('FK_SolResTratamiento')->nullable();
            $table->unsignedInteger('FK_SolResRg')->nullable();
            $table->foreign('FK_SolResTratamiento')->references('ID_Trat')->on('tratamientos')->onDelete('set null');
            $table->foreign('FK_SolResRg')->references('ID_SGenerRes')->on('residuos_geners')->onDelete('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
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
            $table->dropColumn('FK_SolResTratamiento');
            $table->dropColumn('FK_SolResRg');
            $table->dropColumn('SolResFotoCargue');
            $table->dropColumn('SolResFotoDescargue');
            $table->dropColumn('SolResFotoPesaje');
            $table->dropColumn('SolResFotoReempacado');
            $table->dropColumn('SolResFotoMezclado');
            $table->dropColumn('SolResFotoDestruccion');
            $table->dropColumn('SolResVideoCargue');
            $table->dropColumn('SolResVideoDescargue');
            $table->dropColumn('SolResVideoPesaje');
            $table->dropColumn('SolResVideoReempacado');
            $table->dropColumn('SolResVideoMezclado');
            $table->dropColumn('SolResVideoDestruccion');
            $table->dropColumn('SolResAuditoria');
            $table->dropColumn('SolResAuditoriaTipo');
            $table->dropColumn('SolResDevolucion');
            $table->dropColumn('SolResDevolucionTipo');
            $table->dropColumn('SolResDatosPersonal');
            $table->dropColumn('SolResPlanillas');
            $table->dropColumn('SolResAlistamiento');
            $table->dropColumn('SolResCapacitacion');
            $table->dropColumn('SolResBascula');
            $table->dropColumn('SolResMasPerson');
            $table->dropColumn('SolResPlatform');
            $table->dropColumn('SolResCertiEspecial');
            $table->dropColumn('SolResTipoCate');
            $table->dropForeign('solicitud_residuos_fk_solrestratamiento_foreign');
            $table->dropForeign('solicitud_residuos_fk_solressolser_foreign');
        });
    }
}
