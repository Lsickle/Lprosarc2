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
            $table->dropColumn('FK_SolSerPersona');
            $table->dropColumn('FK_SolSerCliente');
            $table->dropForeign(['FK_SolSerPersona']);
            $table->dropForeign(['FK_SolSerCliente']);
        });
    }
}
