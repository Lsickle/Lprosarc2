<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManifiestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifiestos', function (Blueprint $table) {
            $table->increments('ID_Manif');
            $table->Integer('ManifNumero');
            $table->string('ManifiEspName',64);
            $table->string('ManifiEspValue',64);
            $table->string('ManifObservacion');
            $table->string('ManifSrc');
            $table->boolean('ManiAuthJo');
            $table->boolean('ManiAuthJl');
            $table->boolean('ManiAuthDp');
            $table->string('CertAnexo');
            $table->unsignedInteger('FK_ManiSolSer');
            $table->foreign('FK_ManiSolSer')->references('ID_ResEnv')->on('solicitud_servicios');
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
        Schema::dropIfExists('manifiestos');
    }
}
