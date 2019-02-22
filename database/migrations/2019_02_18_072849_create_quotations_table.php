<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Quotations', function (Blueprint $table) {
            $table->increments('ID_Cotiz');
            $table->timestamps();
            $table->integer('CotizNum');
            $table->string('CotizStatus', 32);
            $table->integer('CotizSubTotal');
            $table->unsignedInteger('FK_CotizOrden');
            $table->unsignedInteger('FK_CotizSede');
           
            $table->foreign('FK_CotizOrden')->references('ID_Sede')->on('Sedes');
            $table->foreign('FK_CotizSede')->references('ID_Orden')->on('OrdenCompras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Quotations');
    }
}
