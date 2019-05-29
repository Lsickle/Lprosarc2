<?php

use Illuminate\Database\Seeder;
use App\Respel;
use Illuminate\Support\Facades\Hash;

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
        $Respel->RespelDescrip = 'Precaución con el producto';
        $Respel->YRespelClasf4741 = 'Y10';
        $Respel->ARespelClasf4741 = 'null';
        $Respel->RespelIgrosidad = 'Inflamable';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Aprobada';
        $Respel->RespelSlug = Hash::make(now().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '2';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '1';
        $Respel->SustanciaControladaTipo = '1';
        $Respel->SustanciaControladaNombre = 'Aceite combustible para motor- ACPM';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Gasolina';
        $Respel->RespelDescrip = 'Precaución';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'null';
        $Respel->RespelIgrosidad = 'Toxico';
        $Respel->RespelEstado = 'Liquido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Rechazado';
        $Respel->RespelSlug = Hash::make(now().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '4';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaNombre = '';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Tecnología';
        $Respel->RespelDescrip = 'residuos de procesos tecnológicos';
        $Respel->YRespelClasf4741 = 'null';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Patógeno - Infeccioso';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Pendiente';
        $Respel->RespelSlug = Hash::make(now().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '3';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaNombre = '';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Cascos';
        $Respel->RespelDescrip = 'N\A';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'null';
        $Respel->RespelIgrosidad = 'Corrosivo';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Incompleta';
        $Respel->RespelSlug = Hash::make(now().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '1';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '1';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaNombre = 'Ácido sulfúrico';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'Relleno';
        $Respel->RespelDescrip = 'Olores nauseabundos';
        $Respel->YRespelClasf4741 = 'null';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Reactivo';
        $Respel->RespelEstado = 'Gaseoso';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Aprobado';
        $Respel->RespelSlug = Hash::make(now().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '5';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaNombre = '';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->save();

        $Respel = new Respel();
        $Respel->RespelName = 'desechos radiactivos';
        $Respel->RespelDescrip = 'desechos de la producción de energía usando isotopos radiactivos';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->ARespelClasf4741 = 'null';
        $Respel->RespelIgrosidad = 'Radiactivo';
        $Respel->RespelEstado = 'Mezcla';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Vencido';
        $Respel->RespelSlug = Hash::make(now().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '6';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaNombre = '';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->save();
    }
}
