<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReciboMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_materials', function (Blueprint $table) {
            $table->increments('ID_Rm');
            $table->string('RmStatus',64);
            $table->string('RmTipo',32);
            $table->boolean('RmAuditable');
            $table->time('RmSalida');
            $table->time('RmLlegada');
            $table->string('RmCobro',128);
            $table->unsignedInteger('FK_RmTransportador');
            $table->unsignedInteger('FK_RmContact');
            $table->unsignedInteger('FK_RmDeclar');
            $table->unsignedInteger('FK_RmConductor');
            $table->unsignedInteger('FK_RmProgVeh');
            $table->foreign('FK_RmDeclar')->references('ID_Declar')->on('declarations');
            $table->foreign('FK_RmTransportador')->references('ID_Cli')->on('clientes');
            $table->foreign('FK_RmContact')->references('ID_Pers')->on('personals');
            $table->foreign('FK_RmConductor')->references('ID_Pers')->on('personals');
            $table->foreign('FK_RmProgVeh')->references('ID_ProgVeh')->on('progvehiculos');
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
        Schema::dropIfExists('recibo_materials');
    }
}
