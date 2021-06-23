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
            $table->unsignedInteger('FK_PreFacTratamiento')->nullable();
            $table->foreign('FK_PreFacTratamiento')->references('ID_Trat')->on('tratamientos')->onDelete('set null');
            $table->unsignedDecimal('precio_tarifa', 8, 2)->default(0);
            $table->unsignedDecimal('subtotal_respel', 8, 2)->default(0);
            $table->unsignedDecimal('cantidad_respel', 8, 2)->default(0);
            $table->string('unidad_respel');
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
