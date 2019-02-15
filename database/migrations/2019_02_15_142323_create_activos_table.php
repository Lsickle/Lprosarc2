<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activos', function (Blueprint $table) {
            $table->increments('ID_Act');
            $table->timestamps();
            $table->string('ActName',200); /*nombre de la Subcategoria*/
            $table->string('ActUnid',200);
            $table->string('ActCant',200); /*Cantidad inicial*/
            $table->string('ActSerialProsarc',200);
            $table->string('ActSerialProveed',200);
            $table->string('ActTalla',200);
            $table->string('ActObserv',200);
            $table->string('ActModel',200);
            $table->unsignedInteger('FK_SubCat');
            $table->foreign('FK_SubCat')->references('ID_SubCat')->on('subcategoria_activos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activos');
    }
}
