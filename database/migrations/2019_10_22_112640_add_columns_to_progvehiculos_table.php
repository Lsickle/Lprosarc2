<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToProgvehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progvehiculos', function (Blueprint $table) {
            $table->string('ProgVehDocConductorEXT', 16)->nullable();
            $table->string('ProgVehNameConductorEXT', 32)->nullable();
            $table->string('ProgVehDocAuxiliarEXT', 16)->nullable();
            $table->string('ProgVehNameAuxiliarEXT', 32)->nullable();
            $table->string('ProgVehPlacaEXT', 16)->nullable();
            $table->string('ProgVehTipoEXT', 32)->nullable();

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('progvehiculos', function (Blueprint $table) {
            $table->dropColumn('ProgVehDocConductorEXT');
            $table->dropColumn('ProgVehNameConductorEXT');
            $table->dropColumn('ProgVehDocAuxiliarEXT');
            $table->dropColumn('ProgVehNameAuxiliarEXT');
            $table->dropColumn('ProgVehPlacaEXT');
            $table->dropColumn('ProgVehTipoEXT');
        });
    }
}
