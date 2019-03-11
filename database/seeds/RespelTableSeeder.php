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
        $Respel->YRespelClasf4741 = 'Y10';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Infamable';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'Si';
        $Respel->RespelTarj = 'Si';
        $Respel->RespelStatus = 'Aprobada';
        $Respel->RespelSlug = 'user00';
        $Respel->FK_RespelSede = '2';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Gasolina';
        $Respel->RespelDescrip = 'Precaucion';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Toxico';
        $Respel->RespelEstado = 'Liquido';
        $Respel->RespelHojaSeguridad = 'Si';
        $Respel->RespelTarj = 'No';
        $Respel->RespelStatus = 'Negada';
        $Respel->RespelSlug = 'user02';
        $Respel->FK_RespelSede = '4';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Teccnologia';
        $Respel->RespelDescrip = 'N\A';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Electrico';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'No';
        $Respel->RespelTarj = 'No';
        $Respel->RespelStatus = 'Pendiente';
        $Respel->RespelSlug = 'user03';
        $Respel->FK_RespelSede = '3';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Cascos';
        $Respel->RespelDescrip = 'N\A';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'N\A';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'No';
        $Respel->RespelTarj = 'Si';
        $Respel->RespelStatus = 'Incompleta';
        $Respel->RespelSlug = 'user04';
        $Respel->FK_RespelSede = '1';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Relleno';
        $Respel->RespelDescrip = 'Olores nauseabundos';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Muy Toxico';
        $Respel->RespelEstado = 'Gaseoso';
        $Respel->RespelHojaSeguridad = 'Si';
        $Respel->RespelTarj = 'Si';
        $Respel->RespelStatus = 'Aprobada';
        $Respel->RespelSlug = 'user05';
        $Respel->FK_RespelSede = '5';
        $Respel->save();
    }
}
