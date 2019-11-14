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
        $Residuo->FK_SolResSolSer = '2';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Residuo->FK_SolResRequerimiento = 1;
        $Residuo->FK_SolResRg = 1;
        $Residuo->save();
        
        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = '63223';
        $Residuo->SolResKgRecibido = '362237';
        $Residuo->SolResKgConciliado = '461278';
        $Residuo->SolResKgTratado = '32567';
        $Residuo->FK_SolResSolSer = '4';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Residuo->FK_SolResRequerimiento = 2;
        $Residuo->FK_SolResRg = 2;
        $Residuo->save();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = '456';
        $Residuo->SolResKgRecibido = '1892';
        $Residuo->SolResKgConciliado = '1362';
        $Residuo->SolResKgTratado = '6732';
        $Residuo->FK_SolResSolSer = '5';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Residuo->FK_SolResRequerimiento = 3;
        $Residuo->FK_SolResRg = 3;
        $Residuo->save();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = '7348';
        $Residuo->SolResKgRecibido = '86127';
        $Residuo->SolResKgConciliado = '7814';
        $Residuo->SolResKgTratado = '6712';
        $Residuo->FK_SolResSolSer = '1';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Residuo->FK_SolResRequerimiento = 4;
        $Residuo->FK_SolResRg = 1;
        $Residuo->save();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResKgEnviado = '3846';
        $Residuo->SolResKgRecibido = '48246';
        $Residuo->SolResKgConciliado = '66827';
        $Residuo->SolResKgTratado = '6354';
        $Residuo->FK_SolResSolSer = '3';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = substr(md5(rand()), 0,32)."SiRes".substr(md5(rand()), 0,32)."Prosarc".substr(md5(rand()), 0,32);
        $Residuo->FK_SolResRequerimiento = 5;
        $Residuo->FK_SolResRg = 5;
        $Residuo->save();
    }
}
