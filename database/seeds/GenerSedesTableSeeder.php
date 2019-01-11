<?php

use Illuminate\Database\Seeder;

class GenerSedesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\GenerSede::class, 60)->create();
    }
}
