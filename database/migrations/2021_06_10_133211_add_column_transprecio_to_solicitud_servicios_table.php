<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTransprecioToSolicitudServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitud_servicios', function (Blueprint $table) {
            $table->unsignedDecimal('SolSerTranspPrecio', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitud_servicios', function (Blueprint $table) {
            $table->dropColumn('SolSerTranspPrecio');
        });
    }
}
