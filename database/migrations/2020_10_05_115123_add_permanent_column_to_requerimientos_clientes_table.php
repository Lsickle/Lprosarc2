<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermanentColumnToRequerimientosClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requerimientos_clientes', function (Blueprint $table) {
            $table->boolean('auto_RequeCliBascula')->default(0);
            $table->boolean('auto_RequeCliCapacitacion')->default(0);
            $table->boolean('auto_RequeCliMasPerson')->default(0);
            $table->boolean('auto_RequeCliVehicExclusive')->default(0);
            $table->boolean('auto_RequeCliPlatform')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requerimientos_clientes', function (Blueprint $table) {
            $table->dropColumn('auto_RequeCliBascula');
            $table->dropColumn('auto_RequeCliCapacitacion');
            $table->dropColumn('auto_RequeCliMasPerson');
            $table->dropColumn('auto_RequeCliVehicExclusive');
            $table->dropColumn('auto_RequeCliPlatform');
        });
    }
}
