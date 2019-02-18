<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticuloPorProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // falta crear la tabla de cotizacion
        Schema::create('articulo_por_proveedors', function (Blueprint $table) {
            $table->increments('ID_ArtiProve');
            $table->timestamps();
            $table->integer('ArtiUnidad'); /*articulos en unidades o peso? */
            $table->integer('ArtiCant'); /*kg o unid por articulo*/ 
            $table->integer('ArtiPrecio');  /*precio del articulo ofertado por el proveedor*/
            $table->integer('ArtiCostoUnid'); /*precio por unidad del articulo*/
            $table->integer('ArtiMinimo'); /*cantidad minima de compra*/
            $table->unsignedInteger('FK_ArtiActiv'); /*foranea de la tabla Activos*/
            // $table->unsignedInteger('FK_ArtCotiz'); /*foranea de la tabla cotizacion*/
            $table->unsignedInteger('FK_AutorizedBy');/*compra de articulo autorizado por*/
            $table->foreign('FK_ArtiActiv')->references('ID_Act')->on('Activos');
            // $table->foreign('FK_ArtCotiz')->references('ID_Pers')->on('Cotizacion');
            $table->foreign('FK_AutorizedBy')->references('id')->on('Users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulo_por_proveedors');
    }
}
