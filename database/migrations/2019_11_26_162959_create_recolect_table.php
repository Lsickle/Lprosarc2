<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecolectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recolect', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('FK_ColectSgen');
            $table->unsignedInteger('FK_ColectProg');
            $table->foreign('FK_ColectSgen')->references('ID_GSede')->on('ID_GSede');
            $table->foreign('FK_ColectProg')->references('ID_ProgVeh')->on('progvehiculos');
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
        Schema::dropIfExists('recolect');
    }
}
