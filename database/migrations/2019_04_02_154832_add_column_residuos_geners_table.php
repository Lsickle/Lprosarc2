<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnResiduosGenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residuos_geners', function (Blueprint $table) {
            $table->unique(['FK_SGener','FK_Respel']);
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
            $table->dropUnique('residuos_geners_fk_sgener_fk_respel_unique');
        });
    }
}
