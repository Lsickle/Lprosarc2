<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('ID_Video');
            $table->timestamps();
            $table->string('VideoName',128);
            $table->string('VideoTipo',32);
            $table->string('VideoTipoOther',64);
            $table->string('VideoSrc',255);
            $table->string('VideoFormat',32);
            $table->unsignedInteger('FK_VideoRespel');
            $table->foreign('FK_VideoRespel')->references('ID_ResEnv')->on('respel_envios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
