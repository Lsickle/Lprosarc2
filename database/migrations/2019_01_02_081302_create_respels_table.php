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
            $table->text('RespelDescrip')->nullable();
            $table->string('YRespelClasf4741', 12)->nullable();
            $table->string('ARespelClasf4741', 12)->nullable();
            $table->string('RespelIgrosidad', 128);
            $table->string('RespelEstado',32);
            $table->string('RespelHojaSeguridad', 128)->nullable();
            $table->string('RespelTarj', 128)->nullable();
            $table->string('RespelStatus',16)->nullable();
            $table->timestamps();
            $table->string('RespelSlug')->unique();
            $table->unsignedInteger('FK_RespelSede')->nullable();
            $table->foreign('FK_RespelSede')->references('ID_Sede')->on('sedes')->onDelete('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            // $table->foreign('FK_RespelGenerSede')->references('ID_GSede')->on('gener_sedes');
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
