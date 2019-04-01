<?php

use Illuminate\Database\Seeder;
use App\ArticuloPorProveedor;

class ArticuloXProveedorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Proveedor = new ArticuloPorProveedor();
        $Proveedor->ArtiUnidad = "1";
        $Proveedor->ArtiCant = "34";
        $Proveedor->ArtiPrecio = "234567";
        $Proveedor->ArtiCostoUnid = "123";
        $Proveedor->ArtiMinimo = "123456";
        $Proveedor->FK_ArtiActiv = "1";
        $Proveedor->FK_ArtCotiz = "3";
        $Proveedor->FK_AutorizedBy = "5";
        $Proveedor->ArtDelete = 0;
        $Proveedor->save();

        $Proveedor = new ArticuloPorProveedor();
        $Proveedor->ArtiUnidad = "0";
        $Proveedor->ArtiCant = "4567";
        $Proveedor->ArtiPrecio = "4567";
        $Proveedor->ArtiCostoUnid = "234";
        $Proveedor->ArtiMinimo = "2345";
        $Proveedor->FK_ArtiActiv = "3";
        $Proveedor->FK_ArtCotiz = "1";
        $Proveedor->FK_AutorizedBy = "2";
        $Proveedor->ArtDelete = 0;
        $Proveedor->save();

        $Proveedor = new ArticuloPorProveedor();
        $Proveedor->ArtiUnidad = "1";
        $Proveedor->ArtiCant = "3456";
        $Proveedor->ArtiPrecio = "98765";
        $Proveedor->ArtiCostoUnid = "3456";
        $Proveedor->ArtiMinimo = "3456";
        $Proveedor->FK_ArtiActiv = "4";
        $Proveedor->FK_ArtCotiz = "2";
        $Proveedor->FK_AutorizedBy = "1";
        $Proveedor->ArtDelete = 0;
        $Proveedor->save();

        $Proveedor = new ArticuloPorProveedor();
        $Proveedor->ArtiUnidad = "0";
        $Proveedor->ArtiCant = "654";
        $Proveedor->ArtiPrecio = "2345";
        $Proveedor->ArtiCostoUnid = "5678";
        $Proveedor->ArtiMinimo = "345";
        $Proveedor->FK_ArtiActiv = "5";
        $Proveedor->FK_ArtCotiz = "4";
        $Proveedor->FK_AutorizedBy = "3";
        $Proveedor->ArtDelete = 0;
        $Proveedor->save();

        $Proveedor = new ArticuloPorProveedor();
        $Proveedor->ArtiUnidad = "0";
        $Proveedor->ArtiCant = "2345";
        $Proveedor->ArtiPrecio = "345";
        $Proveedor->ArtiCostoUnid = "34567";
        $Proveedor->ArtiMinimo = "3456";
        $Proveedor->FK_ArtiActiv = "2";
        $Proveedor->FK_ArtCotiz = "5";
        $Proveedor->FK_AutorizedBy = "4";
        $Proveedor->ArtDelete = 0;
        $Proveedor->save();
    }
}
