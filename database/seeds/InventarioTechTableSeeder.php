<?php

use Illuminate\Database\Seeder;
use App\InventarioTechnology;

class InventarioTechTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $inventario = new InventarioTechnology();
        $inventario->TecnBrand = "Asus";
        $inventario->TecnModel = "NX001";
        $inventario->TecnSerial = "2SF76G73H23H2";
        $inventario->TecnOs = "Windows 10";
        $inventario->TecnRam = 4;
        $inventario->TecnScreen = "14";
        $inventario->TecnAccessory1 = "Mouse HP";
        $inventario->Tecnobserv = "Ingresando portatil";
        $inventario->FK_TecnPerson = 1;
        $inventario->save();

        $inventario = new InventarioTechnology();
        $inventario->TecnBrand = "Lenovo";
        $inventario->TecnModel = "Ideapad 330";
        $inventario->TecnSerial = "2712BNBDASND123";
        $inventario->TecnOs = "Windows 10";
        $inventario->TecnRam = 4;
        $inventario->TecnScreen = "12";
        $inventario->TecnAccessory2 = "Mouse";
        $inventario->Tecnobserv = "Ingresando portatil";
        $inventario->FK_TecnPerson = 3;
        $inventario->save();

        $inventario = new InventarioTechnology();
        $inventario->TecnBrand = "Asus";
        $inventario->TecnModel = "KFS242";
        $inventario->TecnSerial = "2SF72134SFA23H2";
        $inventario->TecnOs = "Windows 10";
        $inventario->TecnRam = 4;
        $inventario->TecnScreen = "14";
        $inventario->Tecnobserv = "Ingresando portatil";
        $inventario->FK_TecnPerson = 5;
        $inventario->save();

        $inventario = new InventarioTechnology();
        $inventario->TecnBrand = "Lenovo";
        $inventario->TecnModel = "Ideapad 330";
        $inventario->TecnSerial = "2SF76G73H2LSHA21333H2";
        $inventario->TecnOs = "Windows 10";
        $inventario->TecnRam = 4;
        $inventario->TecnScreen = "12";
        $inventario->Tecnobserv = "Ingresando portatil";
        $inventario->FK_TecnPerson = 2;
        $inventario->save();

        $inventario = new InventarioTechnology();
        $inventario->TecnBrand = "Acer";
        $inventario->TecnModel = "8723942";
        $inventario->TecnSerial = "2SF76KJSADJG73H23H2";
        $inventario->TecnOs = "Windows 10";
        $inventario->TecnRam = 8;
        $inventario->TecnScreen = "14";
        $inventario->TecnAccessory1 = "Parlantes";
        $inventario->Tecnobserv = "Ingresando portatil";
        $inventario->FK_TecnPerson = 4;
        $inventario->save();
    }
}
