<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OrdenCompras', function (Blueprint $table) {

            $table->increments('ID_Orden');
            $table->timestamps();
            $table->integer('OrdenNum');
            $table->string('OrdenStatus',64);
            $table->string('OrdenInvoice',32);
            $table->boolean('OrdenRecibida');
            $table->boolean('OrdenPagada');
            $table->integer('OrdenTotal');
            $table->boolean('OrdenAutor');
            $table->unsignedInteger('FK_OrdenCreateBy');
            $table->unsignedInteger('FK_OrdenProg');
            
            $table->foreign('FK_OrdenProg')->references('ID_ProgVeh')->on('ProgVehiculos');
            $table->foreign('FK_OrdenCreateBy')->references('id')->on('Users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_compras');
    }
}
