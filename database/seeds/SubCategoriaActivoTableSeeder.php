<?php

use Illuminate\Database\Seeder;
use App\SubcategoriaActivo;

class SubCategoriaActivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcatecactivo = new SubcategoriaActivo();
        $subcatecactivo->SubCatName = "Electrodomesticos";
        $subcatecactivo->FK_SubCat = "1";
        $subcatecactivo->save();
        
        $subcatecactivo = new SubcategoriaActivo();
        $subcatecactivo->SubCatName = "Sentarse";
        $subcatecactivo->FK_SubCat = "4";
        $subcatecactivo->save();
        
        $subcatecactivo = new SubcategoriaActivo();
        $subcatecactivo->SubCatName = "Higine personal";
        $subcatecactivo->FK_SubCat = "2";        
        $subcatecactivo->save();
        
        $subcatecactivo = new SubcategoriaActivo();
        $subcatecactivo->SubCatName = "Cuadros";
        $subcatecactivo->FK_SubCat = "5";
        $subcatecactivo->save();
        
        $subcatecactivo = new SubcategoriaActivo();
        $subcatecactivo->SubCatName = "No lo se";
        $subcatecactivo->FK_SubCat = "3";
        $subcatecactivo->save();

    }
}
