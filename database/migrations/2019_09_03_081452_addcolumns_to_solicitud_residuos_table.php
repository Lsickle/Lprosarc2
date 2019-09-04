<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddcolumnsToSolicitudResiduosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->boolean('SolResDevolucion')->nullable();
            $table->string('SolResDevolCantidad', 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_residuos', function (Blueprint $table) {
            $table->dropColumn('SolResDevolucion')->nullable();
            $table->dropColumn('SolResDevolCantidad')->nullable();
        });
    }
}
