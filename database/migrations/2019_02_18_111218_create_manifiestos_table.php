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
            $table->Integer('ManifKg');
            $table->string('ManifiEspName',64);
            $table->string('ManifiEspValue',64);
            $table->string('ManifObservacion');
            $table->string('ManifSrc');
            $table->string('CertAnexo');
            $table->unsignedInteger('FK_MAnifRespel');
            $table->unsignedInteger('FK_MAnifRm');
            $table->unsignedInteger('FK_MAnifGener');
            $table->unsignedInteger('FK_ManifProvee');
            $table->foreign('FK_MAnifRespel')->references('ID_ResEnv')->on('res_envios');
            $table->foreign('FK_MAnifRm')->references('ID_Rm')->on('recibo_materials');
            $table->foreign('FK_MAnifGener')->references('ID_GSede')->on('gener_sedes');
            $table->foreign('FK_ManifProvee')->references('ID_Sede')->on('sedes');
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
