<?php

use Illuminate\Database\Seeder;
use App\Cotizacion;

class CotizacionsTableSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cotizacion = new Cotizacion();
        $cotizacion->CotiNumero = "001";
        $cotizacion->CotiFechaSolicitud = "2018-02-20 07:00:00";
        $cotizacion->CotiFechaRespuesta = "2018-02-20 07:00:00";
        $cotizacion->CotiFechaVencimiento = "2019-02-20 07:00:00";
        $cotizacion->CotiVencida = "1";
        $cotizacion->CotiPrecioTotal = "650000";
        $cotizacion->CotiPrecioSubtotal = "350000";
        $cotizacion->FK_CotiSede = "1";
        $cotizacion->CotiDelete = '0';
        $cotizacion->CotiStatus = 'Aprobada';
        $cotizacion->save();

        $cotizacion = new Cotizacion();
        $cotizacion->CotiNumero = "001";
        $cotizacion->CotiFechaSolicitud = "2018-02-20 07:00:00";
        $cotizacion->CotiFechaRespuesta = "2018-02-20 07:00:00";
        $cotizacion->CotiFechaVencimiento = "2019-02-20 07:00:00";
        $cotizacion->CotiVencida = "1";
        $cotizacion->CotiPrecioTotal = "650000";
        $cotizacion->CotiPrecioSubtotal = "350000";
        $cotizacion->FK_CotiSede = "3";
        $cotizacion->CotiDelete = '0';
        $cotizacion->CotiStatus = 'Aprobada';
        $cotizacion->save();

        $cotizacion = new Cotizacion();
        $cotizacion->CotiNumero = "002";
        $cotizacion->CotiFechaSolicitud = "2018-10-20 07:00:00";
        $cotizacion->CotiFechaRespuesta = "2018-10-20 07:00:00";
        $cotizacion->CotiFechaVencimiento = "2019-10-20 07:00:00";
        $cotizacion->CotiVencida = "0";
        $cotizacion->CotiPrecioTotal = "2650000";
        $cotizacion->CotiPrecioSubtotal = "2350000";
        $cotizacion->FK_CotiSede = "3";
        $cotizacion->CotiDelete = '0';
        $cotizacion->CotiStatus = 'Aprobada';
        $cotizacion->save();

        $cotizacion = new Cotizacion();
        $cotizacion->CotiNumero = "003";
        $cotizacion->CotiFechaSolicitud = "2018-05-20 07:00:00";
        $cotizacion->CotiFechaRespuesta = "2018-06-10 07:00:00";
        $cotizacion->CotiFechaVencimiento = "2019-06-10 07:00:00";
        $cotizacion->CotiVencida = "0";
        $cotizacion->CotiPrecioTotal = "1650000";
        $cotizacion->CotiPrecioSubtotal = "1350000";
        $cotizacion->FK_CotiSede = "3";
        $cotizacion->CotiDelete = '0';
        $cotizacion->CotiStatus = 'Aprobada';
        $cotizacion->save();

        $cotizacion = new Cotizacion();
        $cotizacion->CotiNumero = "004";
        $cotizacion->CotiFechaSolicitud = "2019-01-22 07:00:00";
        $cotizacion->CotiFechaRespuesta = "2019-02-22 07:00:00";
        $cotizacion->CotiFechaVencimiento = "2020-02-20 07:00:00";
        $cotizacion->CotiVencida = "0";
        $cotizacion->CotiPrecioTotal = "1650000";
        $cotizacion->CotiPrecioSubtotal = "1350000";
        $cotizacion->FK_CotiSede = "5";
        $cotizacion->CotiDelete = '0';
        $cotizacion->CotiStatus = 'Aprobada';
        $cotizacion->save();

        $cotizacion = new Cotizacion();
        $cotizacion->CotiNumero = "005";
        $cotizacion->CotiFechaSolicitud = "2019-02-20 07:00:00";
        $cotizacion->CotiFechaRespuesta = "2019-02-21 07:00:00";
        $cotizacion->CotiFechaVencimiento = "2020-03-20 07:00:00";
        $cotizacion->CotiVencida = "0";
        $cotizacion->CotiPrecioTotal = "1650000";
        $cotizacion->CotiPrecioSubtotal = "1350000";
        $cotizacion->FK_CotiSede = "5";
        $cotizacion->CotiDelete = '0';
        $cotizacion->CotiStatus = 'Aprobada';
        $cotizacion->save();

        $cotizacion = new Cotizacion();
        $cotizacion->CotiNumero = "006";
        $cotizacion->CotiFechaSolicitud = "2019-05-20 07:00:00";
        $cotizacion->CotiFechaRespuesta = "2019-05-21 07:00:00";
        $cotizacion->CotiFechaVencimiento = "2020-05-20 07:00:00";
        $cotizacion->CotiVencida = "0";
        $cotizacion->CotiPrecioTotal = "1650000";
        $cotizacion->CotiPrecioSubtotal = "1350000";
        $cotizacion->FK_CotiSede = "5";
        $cotizacion->CotiDelete = '0';
        $cotizacion->CotiStatus = 'Aprobada';
        $cotizacion->save();
    }
}
