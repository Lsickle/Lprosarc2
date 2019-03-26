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
        $Respel->RespelHojaSeguridad = 'LogoProsarc.png';
        $Respel->RespelTarj = 'default.png';
        $Respel->RespelStatus = 'Aprobada';
        $Respel->RespelSlug = 'user00';
        $Respel->FK_RespelCoti = '2';
        $Respel->RespelDelete = '0';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Gasolina';
        $Respel->RespelDescrip = 'Precaucion';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Toxico';
        $Respel->RespelEstado = 'Liquido';
        $Respel->RespelHojaSeguridad = 'LogoProsarc.png';
        $Respel->RespelTarj = 'default.png';
        $Respel->RespelStatus = 'Negada';
        $Respel->RespelSlug = 'user02';
        $Respel->FK_RespelCoti = '4';
        $Respel->RespelDelete = '0';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Teccnologia';
        $Respel->RespelDescrip = 'N\A';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Electrico';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'LogoProsarc.png';
        $Respel->RespelTarj = 'default.png';
        $Respel->RespelStatus = 'Pendiente';
        $Respel->RespelSlug = 'user03';
        $Respel->FK_RespelCoti = '3';
        $Respel->RespelDelete = '0';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Cascos';
        $Respel->RespelDescrip = 'N\A';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'N\A';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'LogoProsarc.png';
        $Respel->RespelTarj = 'default.png';
        $Respel->RespelStatus = 'Incompleta';
        $Respel->RespelSlug = 'user04';
        $Respel->FK_RespelCoti = '1';
        $Respel->RespelDelete = '0';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Relleno';
        $Respel->RespelDescrip = 'Olores nauseabundos';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Muy Toxico';
        $Respel->RespelEstado = 'Gaseoso';
        $Respel->RespelHojaSeguridad = 'LogoProsarc.png';
        $Respel->RespelTarj = 'default.png';
        $Respel->RespelStatus = 'Aprobada';
        $Respel->RespelSlug = 'user05';
        $Respel->FK_RespelCoti = '5';
        $Respel->RespelDelete = '0';
        $Respel->save();
    }
}
