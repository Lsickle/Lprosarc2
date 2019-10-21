<?php

use Illuminate\Database\Seeder;
use App\Subcategoryrespelpublic;


class subcategoryrespelpublicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categRP = new Subcategoryrespelpublic();
        $categRP->SubCategoryRpName = "General";
        $categRP->FK_CategoryRP = 1;
        $categRP->save();
    }
}
