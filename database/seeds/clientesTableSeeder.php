<?php

use Illuminate\Database\Seeder;

class clientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\cliente::class, 120)->create()->each(function(App\cliente $Cliente){
        	$id= $Cliente->ID_Cli;
        	$Cliente->sede()->saveMany(
        		factory(App\sede::class, 5)->make(['Cliente' => $id])
        	);
        });
    }
}
