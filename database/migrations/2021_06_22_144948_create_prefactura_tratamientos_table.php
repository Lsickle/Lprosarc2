<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefacturaTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefactura_tratamientos', function (Blueprint $table) {
            $table->bigIncrements('id_PreFacTratamiento');
            $table->unsignedInteger('fk_prefactura')->nullable();
            $table->unsignedInteger('fk_tratamiento')->nullable();
            $table->unsignedDecimal('Subtotal_tratamiento', 8, 2)->default(0);
            $table->unsignedDecimal('cantidad_tratamiento', 8, 2)->default(0);
            $table->unsignedDecimal('unidad_tratamiento', 8, 2)->default(0);
            $table->unsignedDecimal('total_prefactratamiento', 8, 2)->default(0);
            $table->json('RMs');
            $table->date('Fecha Recepcion');
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
        Schema::dropIfExists('prefactura_tratamientos');
    }
}
