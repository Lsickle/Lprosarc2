<?php

use Illuminate\Database\Seeder;

class GeneradorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Generador::class, 10)->create()->each(function(App\Generador $Gen){
            $id= $Gen->ID_Gener;
            $Gen->GenerSede()->saveMany(factory(App\GenerSede::class, 3)->make([
                'FK_GSede' => $id,   
                'ID_GSede' => null,/*function($countsede) {
                    return $countsede;
                    $countsede++;
                    }*/
                ])
            );
        });
    }

}
