<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeingTratamientosToRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requerimientos', function (Blueprint $table) {
            $table->boolean('ofertado')->nullable();
            $table->unsignedInteger('FK_ReqTrata')->nullable();
            $table->foreign('FK_ReqTrata')->references('ID_Trat')->on('tratamientos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requerimientos', function (Blueprint $table) {
            $table->dropColumn('ofertado');
            $table->unsignedInteger('FK_ReqTrata')->nullable();
            $table->foreign('FK_ReqTrata')->references('ID_Trat')->on('tratamientos');
        });
    }
}
