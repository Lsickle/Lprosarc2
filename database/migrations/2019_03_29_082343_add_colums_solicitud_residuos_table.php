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
            $table->unsignedInteger('FK_SolResTratamiento')->nullable();
            $table->unsignedInteger('FK_SolResReque')->nullable();
            $table->unsignedInteger('FK_SolResRg')->nullable();
            $table->foreign('FK_SolResTratamiento')->references('ID_Trat')->on('tratamientos')->onDelete('set null');
            $table->foreign('FK_SolResReque')->references('ID_Req')->on('requerimientos')->onDelete('set null');
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
            $table->dropColumn('FK_SolResReque');
            $table->dropColumn('FK_SolResRg');
            $table->dropForeign(['FK_SolResTratamiento']);
            $table->dropForeign(['FK_SolResReque']);
            $table->dropForeign(['FK_SolResRg']);
        });
    }
}
