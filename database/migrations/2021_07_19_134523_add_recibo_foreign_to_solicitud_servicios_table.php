<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReciboForeignToSolicitudServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_servicios', function (Blueprint $table) {
            $table->unsignedBigInteger('FK_ReciboSolserv')->nullable();
            $table->foreign('FK_ReciboSolserv')->references('ID_Recibo')->on('recibo_de_pagos')->onDelete('set null');
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
            $table->dropForeign('solicitud_servicios_fk_recibosolserv_foreign');
            $table->dropColumn('FK_ReciboSolserv');
        });
    }
}
