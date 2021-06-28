<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefacturaResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefactura_residuos', function (Blueprint $table) {
            $table->bigIncrements('ID_PrefactRespel');
            $table->unsignedBigInteger('FK_Prefactura')->nullable();
            $table->foreign('FK_Prefactura')->references('ID_Prefactura')->on('prefacturas')->onDelete('set null');
            $table->unsignedBigInteger('FK_PreFacTratamiento')->nullable();
            $table->foreign('FK_PreFacTratamiento')->references('ID_PrefacTratamiento')->on('prefactura_tratamientos')->onDelete('set null');
            $table->unsignedInteger('FK_SolRespel')->nullable();
            $table->foreign('FK_SolRespel')->references('ID_SolRes')->on('solicitud_residuos')->onDelete('set null');
            $table->string('unidad_respel')->default('Kg');
            $table->unsignedDecimal('precio_tarifa', 8, 2)->default(0); //max 999999,99
            $table->unsignedDecimal('cantidad_respel', 8, 2)->default(0); //max 999999,99
            $table->unsignedDecimal('subtotal_respel', 14, 2)->default(0); //max 999999999999,99
            $table->json('RMs');
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
        Schema::dropIfExists('prefactura_residuos');
    }
}
