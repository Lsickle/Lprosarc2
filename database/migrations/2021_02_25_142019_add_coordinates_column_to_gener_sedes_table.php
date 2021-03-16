<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoordinatesColumnToGenerSedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gener_sedes', function (Blueprint $table) {
            $table->string('GSedeMapAddressSearch')->default('No Definida');
            $table->string('GSedeMapLocalidad', 64)->default('No Definida');
            $table->string('GSedeMapAddressResult')->default('No Definida');
            $table->decimal('GSedeMapLat', 10, 8)->default('4.6875167');
            $table->decimal('GSedeMapLong', 11, 8)->default('-74.0739892');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gener_sedes', function (Blueprint $table) {
            $table->dropColumn('GSedeMapAddressSearch');
            $table->dropColumn('GSedeMapLocalidad');
            $table->dropColumn('GSedeMapAddressResult');
            $table->dropColumn('GSedeMapLat');
            $table->dropColumn('GSedeMapLong');
        });
    }
}
