<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToVariusColumsInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('UsType', 64)->nullable()->change();
            $table->string('UsAvatar', 255)->nullable()->change();
            $table->string('UsQuestion', 128)->nullable()->change();
            $table->string('UsAnswer', 128)->nullable()->change();
            $table->string('UsStatus', 8)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('UsType', 64)->change();
            $table->string('UsAvatar', 255)->change();
            $table->string('UsQuestion', 128)->change();
            $table->string('UsAnswer', 128)->change();
            $table->string('UsStatus', 8)->change();
        });
    }
}
