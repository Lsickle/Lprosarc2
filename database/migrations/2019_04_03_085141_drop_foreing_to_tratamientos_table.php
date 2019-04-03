<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeingToTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->dropForeign('tratamientos_fk_tratrespel_foreign');
            $table->dropColumn('FK_TratRespel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->dropForeign('tratamientos_fk_tratrespel_foreign');
            $table->dropColumn('FK_TratRespel');            
        });
    }
}
