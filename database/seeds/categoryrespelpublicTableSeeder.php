<?php

use Illuminate\Database\Seeder;
use App\Categoryrespelpublic;

class categoryrespelpublicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categRP = new Categoryrespelpublic();
        $categRP->CategoryRpName = "General";
        $categRP->save();
    }
}
