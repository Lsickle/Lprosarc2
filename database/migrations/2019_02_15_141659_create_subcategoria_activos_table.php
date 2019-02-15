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
            $table->unsignedInteger('FK_SubCat');
            $table->foreign('FK_SubCat')->references('ID_CatAct')->on('categoria_activos');
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
