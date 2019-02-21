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
        
        $subcatecactivo = new SubcategoriaActivo();
        $subcatecactivo->SubCatName = "Sentarse";
        
        $subcatecactivo = new SubcategoriaActivo();
        $subcatecactivo->SubCatName = "Higine personal";
        
        $subcatecactivo = new SubcategoriaActivo();
        $subcatecactivo->SubCatName = "Cuadros";
        
        $subcatecactivo = new SubcategoriaActivo();
        $subcatecactivo->SubCatName = "No lo se";

    }
}
