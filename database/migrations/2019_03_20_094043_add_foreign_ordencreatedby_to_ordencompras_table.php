<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignOrdencreatedbyToOrdencomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordencompras', function (Blueprint $table) {
            $table->unsignedInteger('FK_OrdenCreateBy')->nullable();
            $table->foreign('FK_OrdenCreateBy')->references('id')->on('Users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordencompras', function (Blueprint $table) {
            $table->dropForeign('ordencompras_fk_ordencreateby_foreign');
            $table->dropColumn('FK_OrdenCreateBy');
        });
    }
}
