<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignRecsolToRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recursos', function (Blueprint $table) {
            $table->unsignedInteger('FK_RecSol');
            $table->foreign('FK_RecSol')->references('ID_SolSer')->on('solicitud_servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recursos', function (Blueprint $table) {
            $table->dropForeign('recursos_FK_RecSol_foreign');
            $table->dropColumn('FK_RecSol');
        });
    }
}
