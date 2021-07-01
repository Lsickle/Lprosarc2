<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTarifadesdeToRangosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rangos', function (Blueprint $table) {
            $table->unsignedDecimal('TarifaPrecio', 8, 2)->default(0)->charset(null)->change();
            $table->unsignedDecimal('TarifaDesde', 8, 2)->default(0)->charset(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rangos', function (Blueprint $table) {
            $table->string('TarifaPrecio')->change();
            $table->string('TarifaDesde')->change();
        });
    }
}
