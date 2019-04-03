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
            $table->integer('OrdenNum');
            $table->string('OrdenStatus',64);
            $table->string('OrdenInvoice',32);
            $table->boolean('OrdenRecibida');
            $table->boolean('OrdenPagada');
            $table->integer('OrdenTotal');
            $table->boolean('OrdenAutor');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
                        
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
