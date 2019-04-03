<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriaActivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategoria_activos', function (Blueprint $table) {
            $table->increments('ID_SubCat');
            $table->string('SubCatName',200); /*nombre de la Subcategoria*/
            $table->timestamps();
            $table->unsignedInteger('FK_SubCat')->nullable();
            $table->foreign('FK_SubCat')->references('ID_CatAct')->on('categoria_activos')->onDelete('cascade');
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
        Schema::dropIfExists('subcategoria_activos');
    }
}
