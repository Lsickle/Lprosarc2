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
                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('OrdenCompras');
    }
}
