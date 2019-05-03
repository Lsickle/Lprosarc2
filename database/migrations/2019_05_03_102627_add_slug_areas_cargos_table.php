
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugAreasCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->string('AreaSlug')->unique();
        });
        Schema::table('cargos', function (Blueprint $table) {
            $table->string('CargSlug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn('AreaSlug');
        });
        Schema::table('cargos', function (Blueprint $table) {
            $table->dropColumn('CargSlug');
        });
    }
}
