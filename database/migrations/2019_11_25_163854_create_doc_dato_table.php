<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocDatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_dato', function (Blueprint $table) {
            $table->bigIncrements('ID_Dato');
            $table->unsignedInteger('FK_DatoDoc')->nullable();
            $table->unsignedInteger('FK_DatoSolRes')->nullable();
            $table->foreign('FK_DatoDoc')->references('ID_Doc')->on('documentos');
            $table->foreign('FK_DatoSolRes')->references('ID_SolRes')->on('solicitud_residuos');
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
        Schema::dropIfExists('doc_dato');
    }
}
