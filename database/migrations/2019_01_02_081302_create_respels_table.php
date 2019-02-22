<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respels', function (Blueprint $table) {
            $table->increments('ID_Respel');
            $table->string('RespelName', 128);
            $table->text('RespelDescrip');
            $table->string('RespelClasf4741', 64);
            $table->string('RespelIgrosidad', 128);
            $table->string('RespelHojaSeguridad', 128);
            $table->string('RespelTarj', 128);
            $table->string('RespelSlug')->unique();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respels');
    }
}
