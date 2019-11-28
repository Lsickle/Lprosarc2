<?php

use Illuminate\Database\Seeder;
use App\Generador;


class GeneradorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Generador::class, 10)->create()->each(function(App\Generador $Gen){
        //     $id= $Gen->ID_Gener;
        //     $Gen->GenerSede()->saveMany(factory(App\GenerSede::class, 3)->make([
        //         'FK_GSede' => $id,   
        //         'ID_GSede' => null,/*function($countsede) {
        //             return $countsede;
        //             $countsede++;
        //             }*/
        //         ])
        //     );
        // });

        
        /*id = 1*/
        $generador = new Generador();
        $generador->GenerName = 'GenerClient A';
        $generador->GenerNit = '802.049.554-4';
        $generador->GenerShortname = 'GenerClientA';
        $generador->GenerCode = '1a8001';
        $generador->GenerType = '';
        $generador->FK_GenerCli = '3';
        $generador->GenerSlug = hash('sha256', rand().time().$generador->GenerNit);
        $generador->GenerDelete = 0;
        $generador->save();

        /*id = 2*/
        $generador = new Generador();
        $generador->GenerName = 'GenerClient B';
        $generador->GenerNit = '835.543.543-6';
        $generador->GenerShortname = 'GenerClientB';
        $generador->GenerCode = '198ert';
        $generador->GenerType = '';
        $generador->FK_GenerCli = '3';
        $generador->GenerSlug = hash('sha256', rand().time().$generador->GenerNit);
        $generador->GenerDelete = 0;
        $generador->save();

        /*id = 3*/
        $generador = new Generador();
        $generador->GenerName = 'GenerClient C';
        $generador->GenerNit = '836.543.543-7';
        $generador->GenerShortname = 'GenerClientC';
        $generador->GenerCode = '195adf';
        $generador->GenerType = '';
        $generador->FK_GenerCli = '4';
        $generador->GenerSlug = hash('sha256', rand().time().$generador->GenerNit);
        $generador->GenerDelete = 0;
        $generador->save();

        /*id = 4*/
        $generador = new Generador();
        $generador->GenerName = 'GenerCorporation A';
        $generador->GenerNit = '802.049.554-4';
        $generador->GenerShortname = 'GenerCorporationA';
        $generador->GenerCode = '194abf';
        $generador->GenerType = '';
        $generador->FK_GenerCli = '5';
        $generador->GenerSlug = hash('sha256', rand().time().$generador->GenerNit);
        $generador->GenerDelete = 0;
        $generador->save();

        /*id = 5*/
        $generador = new Generador();
        $generador->GenerName = 'GenerCorporation B';
        $generador->GenerNit = '835.543.543-6';
        $generador->GenerShortname = 'GenerCorporationA';
        $generador->GenerCode = '193abd';
        $generador->GenerType = '';
        $generador->FK_GenerCli = '5';
        $generador->GenerSlug = hash('sha256', rand().time().$generador->GenerNit);
        $generador->GenerDelete = 0;
        $generador->save();

        /*id = 6*/
        $generador = new Generador();
        $generador->GenerName = 'GenerCorporation C';
        $generador->GenerNit = '836.543.543-7';
        $generador->GenerShortname = 'GenerCorporationA';
        $generador->GenerCode = '192abc';
        $generador->GenerType = '';
        $generador->FK_GenerCli = '6';
        $generador->GenerSlug = hash('sha256', rand().time().$generador->GenerNit);
        $generador->GenerDelete = 0;
        $generador->save();
    }

}
