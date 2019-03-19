<?php

use Illuminate\Database\Seeder;
use App\SolicitudResiduo;

class SolicitudResiduoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = '60';
        $Residuo->SolResKgRecibido = '45';
        $Residuo->SolResKgConciliado = '65';
        $Residuo->SolResKgTratado = '345';
        $Residuo->SolResSolSer = '2';
        $Residuo->SolResRespel = '3';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user01';
        $Residuo->save();
        
        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = '63223';
        $Residuo->SolResKgRecibido = '362237';
        $Residuo->SolResKgConciliado = '461278';
        $Residuo->SolResKgTratado = '32567';
        $Residuo->SolResSolSer = '4';
        $Residuo->SolResRespel = '2';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user02';
        $Residuo->save();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = '456';
        $Residuo->SolResKgRecibido = '1892';
        $Residuo->SolResKgConciliado = '1362';
        $Residuo->SolResKgTratado = '6732';
        $Residuo->SolResSolSer = '5';
        $Residuo->SolResRespel = '1';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user03';
        $Residuo->save();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = '7348';
        $Residuo->SolResKgRecibido = '86127';
        $Residuo->SolResKgConciliado = '7814';
        $Residuo->SolResKgTratado = '6712';
        $Residuo->SolResSolSer = '1';
        $Residuo->SolResRespel = '4';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user04';
        $Residuo->save();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = '3846';
        $Residuo->SolResKgRecibido = '48246';
        $Residuo->SolResKgConciliado = '66827';
        $Residuo->SolResKgTratado = '6354';
        $Residuo->SolResSolSer = '3';
        $Residuo->SolResRespel = '5';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user05';
        $Residuo->save();
    }
}
