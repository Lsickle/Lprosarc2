<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoNullableTypeRecolectToProgVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progvehiculos', function (Blueprint $table) {
            $table->boolean('ProgVehExclusive')->default(0)->nullable()->change();
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
            $table->boolean('ProgVehExclusive')->default(0)->change();
        });
    }
}
