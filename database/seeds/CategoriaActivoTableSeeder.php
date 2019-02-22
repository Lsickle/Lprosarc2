<?php

use Illuminate\Database\Seeder;
use App\CategoriaActivo;

class CategoriaActivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categactivo = new CategoriaActivo();
        $categactivo->CatName = "Tecnologia";
        $categactivo->save();
        
        $categactivo = new CategoriaActivo();
        $categactivo->CatName = "Muebles";
        $categactivo->save();

        
        $categactivo = new CategoriaActivo();
        $categactivo->CatName = "Aseo";
        $categactivo->save();

        
        $categactivo = new CategoriaActivo();
        $categactivo->CatName = "Decorativo";
        $categactivo->save();

        
        $categactivo = new CategoriaActivo();
        $categactivo->CatName = "Maquinaria";
        $categactivo->save();

    }
}
