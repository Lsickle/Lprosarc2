<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requerimientos', function (Blueprint $table) {
            $table->unsignedInteger('FK_ReqTarifa')->nullable();
            $table->foreign('FK_ReqTarifa')->references('ID_Tarifa')->on('tarifas');
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
            $table->dropForeign('tarifas_FK_ReqTarifa_foreign');
            $table->dropColumn('FK_ReqTarifa');
        });
    }
}
