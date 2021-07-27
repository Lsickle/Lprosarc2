<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangostarifa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rangostarifa', function (Blueprint $table) {
            $table->bigIncrements('ID_CRango');
            $table->unsignedDecimal('CTarifaPrecio', 8, 2)->default(0);
            $table->unsignedDecimal('CTarifaDesde', 8, 2)->default(0);
            $table->unsignedBigInteger('FK_RangoCTarifa');
            $table->foreign('FK_RangoCTarifa')->references('ID_CTarifa')->on('clientetarifa')->onDelete('cascade');
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
        Schema::dropIfExists('rangostarifa');
    }
}
