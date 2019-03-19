<?php

use Illuminate\Database\Seeder;
use App\Quotation;

class QuotationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cotizacion = new Quotation();
        $cotizacion->CotizNum = "001";
        $cotizacion->CotizStatus = "Aprobada";
        $cotizacion->CotizSubTotal = "7327732";
        // $cotizacion->created_at = "2019-02-20 1:38:02";
        // $cotizacion->updated_at = "2019-02-20 10:38:02";
        $cotizacion->FK_CotizOrden = "1";
        $cotizacion->FK_CotizSede = "2";
        $cotizacion->save();
        
        $cotizacion = new Quotation();
        $cotizacion->CotizNum = "002";
        $cotizacion->CotizStatus = "AprobadaParcial";
        $cotizacion->CotizSubTotal = "773873";
        // $cotizacion->created_at = "2018-02-12 1:38:02";
        // $cotizacion->updated_at = "2018-02-20 10:38:02";
        $cotizacion->FK_CotizOrden = "3";
        $cotizacion->FK_CotizSede = "5";
        $cotizacion->save();
        
        $cotizacion = new Quotation();
        $cotizacion->CotizNum = "003";
        $cotizacion->CotizStatus = "Aprobada";
        $cotizacion->CotizSubTotal = "328721";
        // $cotizacion->created_at = "2019-01-19 1:38:02";
        // $cotizacion->updated_at = "2019-02-20 10:38:02";
        $cotizacion->FK_CotizOrden = "2";
        $cotizacion->FK_CotizSede = "1";
        $cotizacion->save();
        
        $cotizacion = new Quotation();
        $cotizacion->CotizNum = "004";
        $cotizacion->CotizStatus = "AprobadaParcial";
        $cotizacion->CotizSubTotal = "6342432";
        // $cotizacion->created_at = "2018-02-20 1:38:02";
        // $cotizacion->updated_at = "2019-02-02 10:38:02";
        $cotizacion->FK_CotizOrden = "5";
        $cotizacion->FK_CotizSede = "4";
        $cotizacion->save();
        
        $cotizacion = new Quotation();
        $cotizacion->CotizNum = "005";
        $cotizacion->CotizStatus = "Aprobada";
        $cotizacion->CotizSubTotal = "262387";
        // $cotizacion->created_at = "2019-02-20 4:38:02";
        // $cotizacion->updated_at = "2019-02-20 17:38:02";
        $cotizacion->FK_CotizOrden = "4";
        $cotizacion->FK_CotizSede = "3";
        $cotizacion->save();
        
    }
}
