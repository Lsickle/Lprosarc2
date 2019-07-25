<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contratos', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('ContraPdf');
			$table->date('ContraVigencia');
			$table->date('ContraNotifiVigencia')->nullabe();
			$table->unsignedInteger('Fk_ContraCli');
			$table->foreign('Fk_ContraCli')->references('ID_Cli')->on('clientes');
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
		Schema::dropIfExists('contratos');
	}
}
