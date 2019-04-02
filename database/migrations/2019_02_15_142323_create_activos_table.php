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
            $table->string('ActName',200); /*nombre de la Subcategoria*/
            $table->string('ActUnid',128);
            $table->string('ActCant',200); /*Cantidad inicial*/
            $table->string('ActSerialProsarc',200);
            $table->string('ActSerialProveed',200);
            $table->string('ActTalla',200);
            $table->string('ActObserv',512);
            $table->string('ActModel',200);
            $table->timestamps();
            $table->unsignedInteger('FK_ActSub')->nullable();
            $table->unsignedInteger('FK_ActSede')->nullable();
            $table->foreign('FK_ActSub')->references('ID_SubCat')->on('subcategoria_activos')->onDelete('set null');
            $table->foreign('FK_ActSede')->references('ID_Sede')->on('Sedes')->onDelete('cascade');
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
        Schema::dropIfExists('activos');
    }
}