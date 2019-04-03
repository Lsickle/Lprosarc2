<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignPersonalToProgvehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progvehiculos', function (Blueprint $table) {
            $table->unsignedInteger('FK_ProgConductor')->nullable();
            $table->unsignedInteger('FK_ProgAyudante')->nullable();
            $table->foreign('FK_ProgConductor')->references('ID_Pers')->on('personals')->onDelete('set null');
            $table->foreign('FK_ProgAyudante')->references('ID_Pers')->on('personals')->onDelete('set null');
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
            $table->dropForeign('progvehiculos_FK_ProgConductor_foreign');
            $table->dropForeign('progvehiculos_FK_ProgAyudante_foreign');
            $table->dropColumn('FK_ProgConductor');
            $table->dropColumn('FK_ProgAyudante');
        });
    }
}
