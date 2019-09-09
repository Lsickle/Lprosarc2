<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespelpublicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respelpublic', function (Blueprint $table) {
            $table->bigIncrements('ID_PRespel');
            $table->string('PRespelName', 128);
            $table->string('PRespelDescrip')->nullable();
            $table->string('PYRespelClasf4741', 12)->nullable();
            $table->string('PARespelClasf4741', 12)->nullable();
            $table->string('PRespelIgrosidad', 128);
            $table->string('PRespelEstado', 32);
            $table->string('PRespelHojaSeguridad', 128)->nullable();
            $table->string('PRespelTarj', 128)->nullable();
            $table->string('PRespelStatus', 16)->nullable();
            $table->string('PRespelSlug');
            $table->boolean('PRespelDelete');
            $table->string('PRespelFoto', 128)->nullable();
            $table->boolean('PSustanciaControlada');
            $table->boolean('PSustanciaControladaTipo')->nullable();
            $table->string('PSustanciaControladaNombre', 128)->nullable();
            $table->string('PSustanciaControladaDocumento', 128)->nullable();
            $table->boolean('PRespelDeclaracion');
            $table->string('PRespelStatusDescription')->nullable();
            $table->unsignedInteger('FK_SubCategoryRP');
            $table->foreign('FK_SubCategoryRP')->references('ID_SubCategoryRP')->on('subcategoryrespelpublic')->onDelete('restrict');
            $table->timestamps();
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
        Schema::dropIfExists('respelpublic');
    }
}
