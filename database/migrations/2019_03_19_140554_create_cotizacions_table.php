<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->increments('ID_Coti');
            $table->Integer('CotiNumero');
            $table->datetime('CotiFechaSolicitud');
            $table->datetime('CotiFechaRespuesta')->nullable();
            $table->datetime('CotiFechaVencimiento')->nullable();/*en caso de se deba renegociar el precio predeterminado es un año*/
            $table->boolean('CotiVencida')->nullable(); /*si o no*/
            $table->string('CotiPrecioTotal')->nullable();
            $table->string('CotiPrecioSubtotal')->nullable();
            $table->boolean('CotiDelete');
            $table->timestamps();
            $table->unsignedInteger('FK_CotiSede')->nullable();
            $table->foreign('FK_CotiSede')->references('ID_Sede')->on('sedes');
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
        Schema::dropIfExists('cotizacions');
    }
}
