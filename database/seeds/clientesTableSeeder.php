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
        factory(App\Cliente::class, 12)->create()->each(function(App\Cliente $Cli){
            $id= $Cli->ID_Cli;
            $Cli->sede()->saveMany(factory(App\Sede::class, 5)->make([
                'FK_SedeCli' => $id,   
                'ID_Sede' => null,/*function($countsede) {
                    return $countsede;
                    $countsede++;
                    }*/
                ])
            );
        });
    }
}
