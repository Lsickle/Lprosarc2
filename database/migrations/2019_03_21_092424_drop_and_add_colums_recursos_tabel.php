<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAndAddColumsRecursosTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recursos', function (Blueprint $table) {
        $table->dropForeign('recursos_fk_recsol_foreign');
        $table->dropColumn('FK_RecSol');
        $table->string('RecRmSrc',128);
        $table->string('SlugRec')->unique();
        $table->unsignedInteger('FK_ResGer')->nullable();
        $table->foreign('FK_ResGer')->references('ID_SGenerRes')->on('residuos_geners');
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
            $table->dropForeign('recursos_fk_recsol_foreign');
            $table->dropColumn('FK_RecSol');
            $table->string('RecRmSrc',128);
            $table->string('SlugRec')->unique();
            $table->unsignedInteger('FK_ResGer');
            $table->foreign('FK_ResGer')->references('ID_SGenerRes')->on('residuos_geners');
            });
    }
}
