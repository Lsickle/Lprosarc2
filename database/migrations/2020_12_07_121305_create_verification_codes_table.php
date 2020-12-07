<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerificationCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verification_codes', function (Blueprint $table) {
            $table->bigIncrements('ID_VCode');
            $table->json('VC_RM')->nullable();
            $table->string('VC_Empresa');
            $table->string('VCode');
            $table->unsignedInteger('FK_VCSolSer')->nullable();
            $table->unsignedBigInteger('FK_VCGroup')->nullable();
            $table->timestamps();
            $table->foreign('FK_VCSolSer')->references('ID_SolSer')->on('solicitud_servicios')->onDelete('cascade');    
            $table->foreign('FK_VCGroup')->references('ID_GCode')->on('group_codes')->onDelete('cascade');
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
        Schema::dropIfExists('verification_codes');
    }
}
