<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoryrespelpublicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategoryrespelpublic', function (Blueprint $table) {
            $table->bigIncrements('ID_SubCategoryRP');
            $table->string('SubCategoryRpName', 64);
            $table->unsignedInteger('FK_CategoryRP');
            $table->foreign('FK_CategoryRP')->references('ID_CategoryRP')->on('categoryrespelpublic')->onDelete('restrict');
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
        Schema::dropIfExists('subcategoryrespelpublic');
    }
}
