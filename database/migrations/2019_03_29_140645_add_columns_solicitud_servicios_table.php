<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSolicitudServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_servicios', function (Blueprint $table) {
            $table->string('SolSerNameTrans')->nullable();
            $table->string('SolSerNitTrans')->nullable();
            $table->string('SolSerAdressTrans')->nullable();
            $table->string('SolSerCityTrans')->nullable();
            $table->string('SolResAuditoriaTipo', 16)->nullable();
            $table->boolean('SolSerBascula')->nullable();
            $table->boolean('SolSerCapacitacion')->nullable();
            $table->boolean('SolSerMasPerson')->nullable();
            $table->boolean('SolSerPlatform')->nullable();
            $table->boolean('SolSerDevolucion')->nullable();
            $table->string('SolSerDevolucionTipo', 128)->nullable();
            $table->unsignedInteger('FK_SolSerPersona');
            $table->unsignedInteger('FK_SolSerCliente');
            $table->foreign('FK_SolSerPersona')->references('ID_Pers')->on('personals');
            $table->foreign('FK_SolSerCliente')->references('ID_Cli')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_servicios', function (Blueprint $table) {
            $table->dropColumn('SolSerNameTrans');
            $table->dropColumn('SolSerNitTrans');
            $table->dropColumn('SolSerAdressTrans');
            $table->dropColumn('SolSerCityTrans');
            $table->dropColumn('SolResAuditoriaTipo');
            $table->dropColumn('SolSerBascula');
            $table->dropColumn('SolSerCapacitacion');
            $table->dropColumn('SolSerMasPerson');
            $table->dropColumn('SolSerPlatform');
            $table->dropColumn('SolSerDevolucion');
            $table->dropColumn('SolSerDevolucionTipo');
            $table->dropColumn('FK_SolSerPersona');
            $table->dropColumn('FK_SolSerCliente');
            $table->dropForeign(['FK_SolSerPersona']);
            $table->dropForeign(['FK_SolSerCliente']);
        });
    }
}
