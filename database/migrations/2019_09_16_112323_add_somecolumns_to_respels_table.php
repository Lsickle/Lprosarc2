<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomecolumnsToRespelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('respels', function (Blueprint $table) {
            $table->boolean('RespelPublic')->default(0);
            $table->unsignedInteger('FK_SubCategoryRP')->nullable();
            $table->foreign('FK_SubCategoryRP')->references('ID_SubCategoryRP')->on('subcategoryrespelpublic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respels', function (Blueprint $table) {
            $table->dropColumn('RespelPublic');
            $table->dropForeign('respels_fk_subcategoryrp_foreign');
            $table->dropColumn('FK_SubCategoryRP');
        });
    }
}
