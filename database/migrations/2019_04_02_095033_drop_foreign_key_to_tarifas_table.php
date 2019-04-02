<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignKeyToTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tarifas', function (Blueprint $table) {
            $table->dropForeign('tarifas_FK_TarifaTrat_foreign');
            $table->dropColumn('FK_TarifaTrat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarifas', function (Blueprint $table) {
            $table->unsignedInteger('FK_TarifaTrat')->nullable();
            $table->foreign('FK_TarifaTrat')->references('ID_Trat')->on('tratamientos');
        });
    }
}
