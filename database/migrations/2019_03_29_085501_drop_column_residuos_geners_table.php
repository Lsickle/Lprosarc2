<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnResiduosGenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residuos_geners', function (Blueprint $table) {
            $table->dropForeign('residuos_geners_fk_solser_foreign');
            $table->dropColumn('FK_SolSer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('residuos_geners', function (Blueprint $table) {
            $table->dropForeign('residuos_geners_fk_solser_foreign');
            $table->dropColumn('FK_SolSer');
        });
    }
}
