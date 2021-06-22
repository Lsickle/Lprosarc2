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
            $table->bigIncrements('id_prefactura');
            $table->unsignedInteger('fk_comercial')->nullable();
            $table->unsignedInteger('fk_cliente')->nullable();
            $table->unsignedInteger('fk_servicio')->nullable();
            $table->unsignedDecimal('costo_transporte', 8, 2)->default(0);
            $table->unsignedDecimal('subtotal_procesos', 8, 2)->default(0);
            $table->unsignedDecimal('Total_prefactura', 8, 2)->default(0);
            $table->string('status_prefactura');
            $table->string('orden_compra');
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
