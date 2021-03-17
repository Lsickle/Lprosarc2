<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoordinatesColumnToSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sedes', function (Blueprint $table) {
            $table->string('SedeMapAddressSearch')->default('No Definida');
            $table->string('SedeMapLocalidad', 64)->default('No Definida');
            $table->string('SedeMapAddressResult')->default('No Definida');
            $table->decimal('SedeMapLat', 10, 8)->default('4.6875167');
            $table->decimal('SedeMapLong', 11, 8)->default('-74.0739892');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sedes', function (Blueprint $table) {
            $table->dropColumn('SedeMapAddressSearch');
            $table->dropColumn('SedeMapLocalidad');
            $table->dropColumn('SedeMapAddressResult');
            $table->dropColumn('SedeMapLat');
            $table->dropColumn('SedeMapLong');
        });
    }
}
