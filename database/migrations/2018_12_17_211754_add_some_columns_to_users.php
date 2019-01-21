<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /*UsStatus= ON/OFF*/
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('UsType', 64);
            $table->string('UsAvatar', 255);
            $table->string('UsQuestion', 128);
            $table->string('UsAnswer', 128);
            $table->string('UsStatus', 16);
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';

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
            $table->dropColumn('UsType');
            $table->dropColumn('UsAvatar');
            $table->dropColumn('UsQuestion');
            $table->dropColumn('UsAnswer');
            $table->dropColumn('UsStatus');
        });
    }
}
