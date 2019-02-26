<?php

use Illuminate\Database\Seeder;
use App\Respel;

class RespelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Respel = new Respel();
        $Respel->RespelName = 'Trapos';
        $Respel->RespelDescrip = 'Precaucion con el producto';
        $Respel->RespelClasf4741 = 'Si';
        $Respel->RespelIgrosidad = 'Infamable';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'Si';
        $Respel->RespelTarj = 'Si';
        $Respel->RespelStatus = 'Aprobada';
        $Respel->RespelSlug = 'user00';
        $Respel->FK_RespelGenerSede = '2';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Gasolina';
        $Respel->RespelDescrip = 'Precaucion';
        $Respel->RespelClasf4741 = 'No';
        $Respel->RespelIgrosidad = 'Toxico';
        $Respel->RespelEstado = 'Liquido';
        $Respel->RespelHojaSeguridad = 'Si';
        $Respel->RespelTarj = 'No';
        $Respel->RespelStatus = 'Negada';
        $Respel->RespelSlug = 'user02';
        $Respel->FK_RespelGenerSede = '4';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Teccnologia';
        $Respel->RespelDescrip = 'N\A';
        $Respel->RespelClasf4741 = 'Si';
        $Respel->RespelIgrosidad = 'Electrico';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'No';
        $Respel->RespelTarj = 'No';
        $Respel->RespelStatus = 'Pendiente';
        $Respel->RespelSlug = 'user03';
        $Respel->FK_RespelGenerSede = '3';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Cascos';
        $Respel->RespelDescrip = 'N\A';
        $Respel->RespelClasf4741 = 'No';
        $Respel->RespelIgrosidad = 'N\A';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'No';
        $Respel->RespelTarj = 'Si';
        $Respel->RespelStatus = 'Incompleta';
        $Respel->RespelSlug = 'user04';
        $Respel->FK_RespelGenerSede = '1';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Relleno';
        $Respel->RespelDescrip = 'Olores nauseabundos';
        $Respel->RespelClasf4741 = 'No';
        $Respel->RespelIgrosidad = 'Muy Toxico';
        $Respel->RespelEstado = 'Gaseoso';
        $Respel->RespelHojaSeguridad = 'Si';
        $Respel->RespelTarj = 'Si';
        $Respel->RespelStatus = 'Aprobada';
        $Respel->RespelSlug = 'user05';
        $Respel->FK_RespelGenerSede = '5';
        $Respel->save();
    }
}
