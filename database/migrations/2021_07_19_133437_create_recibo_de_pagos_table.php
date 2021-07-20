<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReciboDePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_de_pagos', function (Blueprint $table) {
            $table->bigIncrements('ID_Recibo');
            $table->date('fecha_de_pago')->nullable();
            $table->unsignedDecimal('monto', 8, 2)->default(0); //max 999999,99
            $table->string('referencia')->nullable(); //numero de referencia de la transaccion a validar
            $table->string('medio_de_pago')->default('nequi');
            $table->string('url_comprobante')->nullable();
            $table->string('url_recibo')->nullable();
            $table->string('ReciboSlug')->unique();
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
        Schema::dropIfExists('recibo_de_pagos');
    }
}
