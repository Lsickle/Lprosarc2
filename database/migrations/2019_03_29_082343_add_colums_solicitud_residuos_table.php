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
            $table->string('SolResTypeUnidad')->nullable();
            $table->bigInteger('SolResCantiUnidad')->nullable();
            $table->string('SolResEmbalaje')->nullable();
            $table->bigInteger('SolResAlto')->nullable();
            $table->bigInteger('SolResAncho')->nullable();
            $table->bigInteger('SolResProfundo')->nullable();
            $table->boolean('SolResFotoDescargue_Pesaje')->nullable();
            $table->boolean('SolResFotoTratamiento')->nullable();
            $table->boolean('SolResVideoDescargue_Pesaje')->nullable();
            $table->boolean('SolResVideoTratamiento')->nullable();
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
            $table->dropColumn('SolResFotoDescargue_Pesaje');
            $table->dropColumn('SolResFotoTratamiento');
            $table->dropColumn('SolResVideoDescargue_Pesaje');
            $table->dropColumn('SolResVideoTratamiento');
            $table->dropColumn('SolResTypeUnidad');
            $table->dropColumn('SolResCantiUnidad');
            $table->dropColumn('SolResEmbalaje');
            $table->dropColumn('SolResAlto');
            $table->dropColumn('SolResAncho');
            $table->dropColumn('SolResProfundo');
            $table->dropForeign('solicitud_residuos_fk_solrestratamiento_foreign');
            $table->dropForeign('solicitud_residuos_fk_solressolser_foreign');
        });
    }
}
