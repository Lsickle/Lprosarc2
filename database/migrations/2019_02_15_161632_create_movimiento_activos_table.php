<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_activos', function (Blueprint $table) {
            $table->increments('ID_MovAct');
            $table->string('MovTipo',32); /*tipo de movimiento Entrada, asignacion, Salida*/
            $table->unsignedInteger('FK_ActPerson');
            $table->unsignedInteger('FK_MovInv');
            $table->foreign('FK_ActPerson')->references('ID_Pers')->on('Personals');
            $table->foreign('FK_MovInv')->references('ID_Act')->on('Activos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimiento_activos');
    }
}
