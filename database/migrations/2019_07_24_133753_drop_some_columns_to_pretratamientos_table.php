<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSomeColumnsToPretratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pretratamientos', function (Blueprint $table) {
            $table->dropForeign('pretratamientos_fk_pre_trat_foreign');
            $table->dropColumn('FK_Pre_Trat');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pretratamientos', function (Blueprint $table) {
            $table->unsignedInteger('FK_Pre_Trat');
            $table->foreign('FK_Pre_Trat')->references('ID_Trat')->on('tratamientos');
        });
    }
}
