<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequerimientosClientesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requerimientos_clientes', function (Blueprint $table) {
			$table->bigIncrements('ID_RequeCli');
			$table->boolean('RequeCliBascula')->nullable();
			$table->boolean('RequeCliCapacitacion')->nullable();
			$table->boolean('RequeCliMasPerson')->nullable();
			$table->boolean('RequeCliVehicExclusive')->nullable();
			$table->boolean('RequeCliPlatform')->nullable();
			$table->unsignedInteger('FK_RequeClient')->nullable();
			$table->foreign('FK_RequeClient')->references('ID_Cli')->on('clientes')->onDelete('cascade');
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
		Schema::dropIfExists('requerimientos_clientes');
	}
}
