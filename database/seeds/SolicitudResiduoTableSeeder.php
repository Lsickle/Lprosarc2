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
        $Residuo->SolResCateEnviado = '60';
        $Residuo->SolResCateRecibido = '45';
        $Residuo->SolResCateConciliado = '65';
        $Residuo->SolResCateTratado = '345';
        $Residuo->FK_SolResSolSer = '2';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user01';
        $Residuo->SolResTipoCate = 'Kilogramos';
        $Residuo->FK_SolResTratamiento = 1;
        $Residuo->FK_SolResRg = 1;
        $Residuo->SolResUnidades = 10;
        $Residuo->save();
        
        $Residuo = new SolicitudResiduo();
        $Residuo->SolResCateEnviado = '63223';
        $Residuo->SolResCateRecibido = '362237';
        $Residuo->SolResCateConciliado = '461278';
        $Residuo->SolResCateTratado = '32567';
        $Residuo->FK_SolResSolSer = '4';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user02';
        $Residuo->SolResTipoCate = 'Kilogramos';
        $Residuo->FK_SolResTratamiento = 2;
        $Residuo->FK_SolResRg = 2;
        $Residuo->SolResUnidades = 10;
        $Residuo->save();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResCateEnviado = '456';
        $Residuo->SolResCateRecibido = '1892';
        $Residuo->SolResCateConciliado = '1362';
        $Residuo->SolResCateTratado = '6732';
        $Residuo->FK_SolResSolSer = '5';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user03';
        $Residuo->SolResTipoCate = 'Kilogramos';
        $Residuo->FK_SolResTratamiento = 3;
        $Residuo->FK_SolResRg = 3;
        $Residuo->SolResUnidades = 10;
        $Residuo->save();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResCateEnviado = '7348';
        $Residuo->SolResCateRecibido = '86127';
        $Residuo->SolResCateConciliado = '7814';
        $Residuo->SolResCateTratado = '6712';
        $Residuo->FK_SolResSolSer = '1';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user04';
        $Residuo->SolResTipoCate = 'Kilogramos';
        $Residuo->FK_SolResTratamiento = 4;
        $Residuo->FK_SolResRg = 1;
        $Residuo->SolResUnidades = 10;
        $Residuo->save();

        $Residuo = new SolicitudResiduo();
        $Residuo->SolResCateEnviado = '3846';
        $Residuo->SolResCateRecibido = '48246';
        $Residuo->SolResCateConciliado = '66827';
        $Residuo->SolResCateTratado = '6354';
        $Residuo->FK_SolResSolSer = '3';
        $Residuo->SolResDelete = '0';
        $Residuo->SolResSlug = 'user05';
        $Residuo->SolResTipoCate = 'Kilogramos';
        $Residuo->FK_SolResTratamiento = 5;
        $Residuo->FK_SolResRg = 5;
        $Residuo->SolResUnidades = 10;
        $Residuo->save();
    }
}
