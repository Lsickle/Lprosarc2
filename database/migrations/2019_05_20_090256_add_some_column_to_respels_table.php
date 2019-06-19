<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnToRespelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('respels', function (Blueprint $table) {
            $table->string('RespelFoto', 128)->nullable();
            $table->boolean('SustanciaControlada'); /*si=1 o no=0*/
            $table->boolean('SustanciaControladaTipo')->nullable(); /*sustancia controlada=1 o sustancia de uso masivo=0*/
            $table->string('SustanciaControladaNombre', 128)->nullable();
            $table->string('SustanciaControladaDocumento', 128)->nullable(); /*nombre de archivo para certificado de carencia o certificado de registro*/
            $table->boolean('RespelDeclaracion'); /*el cliente declara que la informacion del residuo es real y valida*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respels', function (Blueprint $table) {
            $table->dropColumn('RespelFoto');
            $table->dropColumn('SustanciaControlada');
            $table->dropColumn('SustanciaControladaTipo');
            $table->dropColumn('SustanciaNombre');
            $table->dropColumn('SustanciaDocumento');
            $table->dropColumn('RespelDeclaracion');
        });
    }
}
