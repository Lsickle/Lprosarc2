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
            $table->unsignedInteger('FK_VCSolSer')->nullable();
            $table->foreign('FK_VCSolSer')->references('ID_SolSer')->on('solicitud_servicios');
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
        Schema::dropIfExists('verification_codes');
    }
}
