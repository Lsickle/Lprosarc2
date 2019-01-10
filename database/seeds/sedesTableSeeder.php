<?php

use Illuminate\Database\Seeder;

class sedesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\sede::class, 1)->create();
    }
}
