<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Prosarc = new Cliente();
        $Prosarc->CliNit = '900.079.188-0';
        $Prosarc->CliName = 'PROTECCIÓN SERVICIOS AMBIENTALES RESPEL DE COLOMBIA S.A. ESP.';
        $Prosarc->CliShortname = 'Prosarc S.A. ESP.';
        $Prosarc->CliCategoria = 'Proveedor';
        $Prosarc->CliSlug = hash('sha256', rand().time().$Prosarc->CliNit);
        $Prosarc->CliDelete = 0;
        $Prosarc->save();

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
