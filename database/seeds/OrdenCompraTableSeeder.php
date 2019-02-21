<?php

use Illuminate\Database\Seeder;
use App\orderCompra;

class OrdenCompraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ordencompra = new OrderCompra();
        $ordencompra->OrdenNum = "001";
        $ordencompra->OrdenStatus = "Pendiente";
        $ordencompra->created_at = "2019-02-20 1:38:02";
        $ordencompra->updated_at = "2019-02-20 11:38:02";
        $ordencompra->OrdenInvoice = "001";
        $ordencompra->OrdenRecibida = "1";
        $ordencompra->OrdenPagada = "0";
        $ordencompra->OrdenTotal = "32221421";
        $ordencompra->OrdenAutor = "0";
        $ordencompra->FK_OrdenCreateBy = "1";
        $ordencompra->FK_OrdenProg = "2";
        $ordencompra->save();
        
        $ordencompra = new OrderCompra();
        $ordencompra->OrdenNum = "002";
        $ordencompra->OrdenStatus = "Cotizada";
        $ordencompra->created_at = "2018-02-20 1:38:02";
        $ordencompra->updated_at = "2018-02-20 10:38:02";
        $ordencompra->OrdenInvoice = "002";
        $ordencompra->OrdenRecibida = "0";
        $ordencompra->OrdenPagada = "1";
        $ordencompra->OrdenTotal = "763378";
        $ordencompra->OrdenAutor = "1";
        $ordencompra->FK_OrdenCreateBy = "2";
        $ordencompra->FK_OrdenProg = "5";
        $ordencompra->save();
        
        $ordencompra = new OrderCompra();
        $ordencompra->OrdenNum = "003";
        $ordencompra->OrdenStatus = "Autorizada";
        $ordencompra->created_at = "2019-02-16 12:38:02";
        $ordencompra->updated_at = "2019-02-20 20:38:02";
        $ordencompra->OrdenInvoice = "003";
        $ordencompra->OrdenRecibida = "0";
        $ordencompra->OrdenPagada = "0";
        $ordencompra->OrdenTotal = "12546564";
        $ordencompra->OrdenAutor = "1";
        $ordencompra->FK_OrdenCreateBy = "5";
        $ordencompra->FK_OrdenProg = "3";
        $ordencompra->save();
        
        $ordencompra = new OrderCompra();
        $ordencompra->OrdenNum = "004";
        $ordencompra->OrdenStatus = "Rechazada";
        $ordencompra->created_at = "2019-02-20 1:38:02";
        $ordencompra->updated_at = "2019-02-20 1:38:02";
        $ordencompra->OrdenInvoice = "001";
        $ordencompra->OrdenRecibida = "1";
        $ordencompra->OrdenPagada = "0";
        $ordencompra->OrdenTotal = "32221421";
        $ordencompra->OrdenAutor = "0";
        $ordencompra->FK_OrdenCreateBy = "3";
        $ordencompra->FK_OrdenProg = "1";
        $ordencompra->save();
        
        $ordencompra = new OrderCompra();
        $ordencompra->OrdenNum = "005";
        $ordencompra->OrdenStatus = "Eliminada";
        $ordencompra->created_at = "2019-01-20 11:38:02";
        $ordencompra->updated_at = "2019-02-01 13:38:02";
        $ordencompra->OrdenInvoice = "005";
        $ordencompra->OrdenRecibida = "0";
        $ordencompra->OrdenPagada = "1";
        $ordencompra->OrdenTotal = "143411";
        $ordencompra->OrdenAutor = "0";
        $ordencompra->FK_OrdenCreateBy = "4";
        $ordencompra->FK_OrdenProg = "4";
        $ordencompra->save();
        
    }
}
