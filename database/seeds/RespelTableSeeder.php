<?php

use Illuminate\Database\Seeder;
use App\Respel;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class RespelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $faker = \Faker\Factory::create();
        /*id = 1 */
        $Respel = new Respel();
        $Respel->RespelName = 'Trapos contaminados con hidrocarburos';
        $Respel->RespelDescrip = 'trapos contaminados con gasolina';
        $Respel->YRespelClasf4741 = 'Y10';
        $Respel->RespelIgrosidad = 'Inflamable';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Aprobado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '2';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '1';
        $Respel->SustanciaControladaTipo = '1';
        $Respel->SustanciaControladaNombre = 'Aceite combustible para motor- ACPM';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 2 */
        $Respel = new Respel();
        $Respel->RespelName = 'Gasolina ';
        $Respel->RespelDescrip = 'gasolina mezclada con otros componentes liquidos';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->RespelIgrosidad = 'Toxico';
        $Respel->RespelEstado = 'Liquido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Revisado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '2';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = '';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 3 */
        $Respel = new Respel();
        $Respel->RespelName = 'residuos hospitalarios';
        $Respel->RespelDescrip = 'residuos de procesos medico-quirurgicos';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Patógeno - Infeccioso';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Pendiente';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '3';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 4 */
        $Respel = new Respel();
        $Respel->RespelName = 'canecas contaminadas con acido';
        $Respel->RespelDescrip = 'canecas y otros contaminadas con acido sulfurico';
        $Respel->YRespelClasf4741 = 'Y34';
        $Respel->RespelIgrosidad = 'Corrosivo';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Aprobado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '3';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '1';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaNombre = 'Ácido sulfúrico';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 5 */
        $Respel = new Respel();
        $Respel->RespelName = 'desperdicio de carnes procesadas';
        $Respel->RespelDescrip = 'productos carnicos en descomposicion resultante de la produccion de embutidos';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Toxico';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Revisado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '4';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 6 */
        $Respel = new Respel();
        $Respel->RespelName = 'desechos radiactivos';
        $Respel->RespelDescrip = 'desechos de la producción de energía usando isotopos radiactivos';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->RespelIgrosidad = 'Radiactivo';
        $Respel->RespelEstado = 'Mezcla';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Incompleto';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '4';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 7 */
        $Respel = new Respel();
        $Respel->RespelName = 'Trapos sucios de acpm';
        $Respel->RespelDescrip = 'trapos y estopas contaminadas con ACPM';
        $Respel->YRespelClasf4741 = 'Y10';
        $Respel->RespelIgrosidad = 'Inflamable';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Aprobado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '5';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '1';
        $Respel->SustanciaControladaTipo = '1';
        $Respel->SustanciaControladaNombre = 'Aceite combustible para motor- ACPM';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 8 */
        $Respel = new Respel();
        $Respel->RespelName = 'medicamentos vencidos';
        $Respel->RespelDescrip = 'medicamentos varios vencidos';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->RespelIgrosidad = 'Toxico';
        $Respel->RespelEstado = 'Liquido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Revisado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '5';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 9 */
        $Respel = new Respel();
        $Respel->RespelName = 'Aparatos de Tecnología';
        $Respel->RespelDescrip = 'residuos de procesos tecnológicos';
        $Respel->ARespelClasf4741 = '';
        $Respel->RespelIgrosidad = 'No peligroso';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Pendiente';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '6';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 10 */
        $Respel = new Respel();
        $Respel->RespelName = 'Cascos y botas usados';
        $Respel->RespelDescrip = 'N\A';
        $Respel->RespelIgrosidad = 'No peligroso';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Aprobado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '6';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '1';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaNombre = 'Ácido sulfúrico';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 11 */
        $Respel = new Respel();
        $Respel->RespelName = 'embases con gases';
        $Respel->RespelDescrip = 'embases con gases producidos en proceso industrial';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Reactivo';
        $Respel->RespelEstado = 'Gaseoso';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Revisado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '7';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 12 */
        $Respel = new Respel();
        $Respel->RespelName = 'desechos radiactivos';
        $Respel->RespelDescrip = 'desechos de la producción de energía usando isotopos radiactivos';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->RespelIgrosidad = 'Radiactivo';
        $Respel->RespelEstado = 'Mezcla';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Incompleto';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '7';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 13 */
        $Respel = new Respel();
        $Respel->RespelName = 'dotaciones y botas usados';
        $Respel->RespelDescrip = 'N\A';
        $Respel->RespelIgrosidad = 'No peligroso';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Aprobado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '1';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '1';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaNombre = 'Ácido sulfúrico';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelPublic = '1';
        $Respel->FK_SubCategoryRP = 1;
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
        
        /*id = 14 */
        $Respel = new Respel();
        $Respel->RespelName = 'EPPs';
        $Respel->RespelDescrip = 'elementos de proteccion usados';
        $Respel->YRespelClasf4741 = 'Y14';
        $Respel->RespelIgrosidad = 'Patógeno - Infeccioso';
        $Respel->RespelEstado = 'Mezcla';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Pendiente';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '1';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelPublic = '1';
        $Respel->FK_SubCategoryRP = 1;
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();

        /*id = 15 */
        $Respel = new Respel();
        $Respel->RespelName = 'residuos hospitalarios';
        $Respel->RespelDescrip = 'residuos de procesos medico-quirurgicos';
        $Respel->ARespelClasf4741 = 'A1010';
        $Respel->RespelIgrosidad = 'Patógeno - Infeccioso';
        $Respel->RespelEstado = 'Solido';
        $Respel->RespelHojaSeguridad = 'RespelHojaDefault.pdf';
        $Respel->RespelTarj = 'RespelTarjetaDefault.pdf';
        $Respel->RespelStatus = 'Aprobado';
        $Respel->RespelSlug = hash('sha256', time().rand().$Respel->RespelName);
        $Respel->RespelDelete = '0';
        $Respel->FK_RespelCoti = '3';
        $Respel->RespelFoto= 'RespelFotoDefault.png';
        $Respel->SustanciaControlada = '0';
        $Respel->SustanciaControladaTipo = '0';
        $Respel->SustanciaControladaDocumento = 'SustanciaControlDocDefault.pdf';
        $Respel->RespelDeclaracion = '1';
        $Respel->RespelPublic = '1';
        $Respel->FK_SubCategoryRP = 1;
        $Respel->RespelStatusDescription = 'Residuo cargado automaticamente en la base de datos de SisPRO';
        $Respel->save();
    }
}
