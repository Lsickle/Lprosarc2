<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAndAddColumnsRecursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recursos', function (Blueprint $table) {
            $table->string('RecDelete');
            $table->dropForeign('recursos_fk_resger_foreign');
            $table->dropColumn('FK_ResGer');
            $table->unsignedInteger('FK_RecSolRes')->nullable();
            $table->foreign('FK_RecSolRes')->references('ID_SolRes')->on('solicitud_residuos');
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
            $table->string('RecDelete');
            $table->dropForeign('recursos_fk_resger_foreign');
            $table->dropColumn('FK_ResGer');
            $table->unsignedInteger('FK_RecSolRes');
            $table->foreign('FK_RecSolRes')->references('ID_SolRes')->on('solicitud_residuos');
            });
    }
}
