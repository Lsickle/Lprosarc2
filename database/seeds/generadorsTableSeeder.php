<?php

use Illuminate\Database\Seeder;

class generadorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\generador::class, 10)->create()->each(function(App\generador $Gen){
            $id= $Gen->ID_Gener;
            $Gen->GenerSede()->saveMany(factory(App\GenerSede::class, 3)->make([
                'Generador' => $id,   
                'ID_GSede' => null,/*function($countsede) {
                    return $countsede;
                    $countsede++;
                    }*/
                ])
            );
        });
    }

}
