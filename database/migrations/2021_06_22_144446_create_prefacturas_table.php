<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefacturas', function (Blueprint $table) {
            $table->bigIncrements('ID_Prefactura');
            $table->unsignedInteger('FK_Comercial')->nullable();
            $table->foreign('FK_Comercial')->references('ID_Pers')->on('personals')->onDelete('set null');
            $table->unsignedInteger('FK_Cliente')->nullable();
            $table->foreign('FK_Cliente')->references('ID_Cli')->on('clientes')->onDelete('set null');
            $table->unsignedInteger('FK_Servicio')->nullable();
            $table->foreign('FK_Servicio')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('set null');
            $table->unsignedDecimal('Costo_transporte', 8, 2)->default(0); //max 999999,99
            $table->unsignedDecimal('Subtotal_procesos', 14, 2)->default(0); //max 99999999,99
            $table->unsignedDecimal('Total_prefactura', 14, 2)->default(0); //max 99999999,99
            $table->string('status_prefactura');
            $table->string('orden_compra');
            $table->date('Fecha_Servicio');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prefacturas');
    }
}
