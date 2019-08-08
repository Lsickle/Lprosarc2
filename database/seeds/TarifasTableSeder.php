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
        $tarifa->TarifaTipounidad1 = "Kg";
        $tarifa->TarifaPesoinicial1 = "0";
        $tarifa->TarifaPrecio1 = "2500";
        $tarifa->TarifaDelete = 0;
        $tarifa->save();

        $tarifa = new Tarifa();
        $tarifa->TarifaTipounidad1 = "L";
        $tarifa->TarifaPesoinicial1 = "0";
        $tarifa->TarifaPrecio1 = "5000";
        $tarifa->TarifaDelete = 0;
        $tarifa->save();

        $tarifa = new Tarifa();
        $tarifa->TarifaTipounidad1 = "Kg";
        $tarifa->TarifaPesoinicial1 = "0";
        $tarifa->TarifaPrecio1 = "1500";
        $tarifa->TarifaDelete = 0;
        $tarifa->save();

        $tarifa = new Tarifa();
        $tarifa->TarifaTipounidad1 = "Kg";
        $tarifa->TarifaPesoinicial1 = "0";
        $tarifa->TarifaPrecio1 = "300";
        $tarifa->TarifaDelete = 0;
        $tarifa->save();

        $tarifa = new Tarifa();
        $tarifa->TarifaTipounidad1 = "Kg";
        $tarifa->TarifaPesoinicial1 = "0";
        $tarifa->TarifaPrecio1 = "8000";
        $tarifa->TarifaDelete = 0;
        $tarifa->save();
    }
}
