<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDeleteToResiduosGenersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('residuos_geners', function (Blueprint $table) {
            $table->boolean('DeleteSGenerRes');

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
            $table->dropColumn('DeleteSGenerRes');
        });
    }
}
