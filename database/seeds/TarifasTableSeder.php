<?php

use Illuminate\Database\Seeder;
use App\Tarifa;

class TarifasTableSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tarifa = new Tarifa();
        $tarifa->TarifaTipounidad1 = "kg";
        $tarifa->TarifaPesoinicial1 = "1";
        $tarifa->TarifaPesofinal1 = "100";
        $tarifa->TarifaPrecio1 = "5000";
        $tarifa->TarifaTipounidad2 = "kg";
        $tarifa->TarifaPesoinicial2 = "101";
        $tarifa->TarifaPesofinal2 = "500";
        $tarifa->TarifaPrecio2 = "4000";
        $tarifa->TarifaTipounidad3 = 'kg';
        $tarifa->TarifaPesoinicial3 = '501';
        $tarifa->TarifaPesofinal3 = '10000';
        $tarifa->TarifaPrecio3 = '3000';
        $tarifa->FK_TarifaTrat = '1';
        $tarifa->save();

        $tarifa = new Tarifa();
        $tarifa->TarifaTipounidad1 = "kg";
        $tarifa->TarifaPesoinicial1 = "1";
        $tarifa->TarifaPesofinal1 = "200";
        $tarifa->TarifaPrecio1 = "5000";
        $tarifa->TarifaTipounidad2 = "kg";
        $tarifa->TarifaPesoinicial2 = "201";
        $tarifa->TarifaPesofinal2 = "500";
        $tarifa->TarifaPrecio2 = "4000";
        $tarifa->TarifaTipounidad3 = 'kg';
        $tarifa->TarifaPesoinicial3 = '501';
        $tarifa->TarifaPesofinal3 = '20000';
        $tarifa->TarifaPrecio3 = '3000';
        $tarifa->FK_TarifaTrat = '2';
        $tarifa->save();

        $tarifa = new Tarifa();
        $tarifa->TarifaTipounidad1 = "kg";
        $tarifa->TarifaPesoinicial1 = "1";
        $tarifa->TarifaPesofinal1 = "500";
        $tarifa->TarifaPrecio1 = "1500";
        $tarifa->TarifaTipounidad2 = "kg";
        $tarifa->TarifaPesoinicial2 = "501";
        $tarifa->TarifaPesofinal2 = "5000";
        $tarifa->TarifaPrecio2 = "1400";
        $tarifa->TarifaTipounidad3 = 'kg';
        $tarifa->TarifaPesoinicial3 = '5001';
        $tarifa->TarifaPesofinal3 = '20000';
        $tarifa->TarifaPrecio3 = '1200';
        $tarifa->FK_TarifaTrat = '3';
        $tarifa->save();

        $tarifa = new Tarifa();
        $tarifa->TarifaTipounidad1 = "kg";
        $tarifa->TarifaPesoinicial1 = "1";
        $tarifa->TarifaPesofinal1 = "1000";
        $tarifa->TarifaPrecio1 = "5000";
        $tarifa->TarifaTipounidad2 = "kg";
        $tarifa->TarifaPesoinicial2 = "1001";
        $tarifa->TarifaPesofinal2 = "5000";
        $tarifa->TarifaPrecio2 = "4000";
        $tarifa->TarifaTipounidad3 = 'kg';
        $tarifa->TarifaPesoinicial3 = '5001';
        $tarifa->TarifaPesofinal3 = '100000';
        $tarifa->TarifaPrecio3 = '3000';
        $tarifa->FK_TarifaTrat = '5';
        $tarifa->save();

        $tarifa = new Tarifa();
        $tarifa->TarifaTipounidad1 = "kg";
        $tarifa->TarifaPesoinicial1 = "1";
        $tarifa->TarifaPesofinal1 = "100";
        $tarifa->TarifaPrecio1 = "8000";
        $tarifa->TarifaTipounidad2 = "kg";
        $tarifa->TarifaPesoinicial2 = "101";
        $tarifa->TarifaPesofinal2 = "500";
        $tarifa->TarifaPrecio2 = "6000";
        $tarifa->TarifaTipounidad3 = 'kg';
        $tarifa->TarifaPesoinicial3 = '501';
        $tarifa->TarifaPesofinal3 = '10000';
        $tarifa->TarifaPrecio3 = '4000';
        $tarifa->FK_TarifaTrat = '4';
        $tarifa->save();
    }
}
