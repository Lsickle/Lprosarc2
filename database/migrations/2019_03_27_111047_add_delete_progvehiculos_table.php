<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteProgvehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('progvehiculos', function (Blueprint $table) {
            $table->boolean('ProgVehDelete');
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
            $table->dropColumn('ProgVehDelete');
        });
    }
}
