<?php

use Illuminate\Database\Seeder;
use App\Recurso;

class RecursoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Recursos = new Recurso();
        $Recursos->RecName = "Cliente1";
        $Recursos->RecCarte = "Foto";
        $Recursos->RecTipo = "Carge";
        $Recursos->RecSrc = "/img/defaul.png";
        $Recursos->RecFormat = ".png";
        $Recursos->RecRmSrc = "/img";
        $Recursos->SlugRec = "user01";
        $Recursos->RecDelete = "0";
        $Recursos->FK_RecSolRes = "1";
        $Recursos->save();

        $Recursos = new Recurso();
        $Recursos->RecName = "Cliente2";
        $Recursos->RecCarte = "Foto";
        $Recursos->RecTipo = "Descargue";
        $Recursos->RecSrc = "/img/defaul.png";
        $Recursos->RecFormat = ".png";
        $Recursos->RecRmSrc = "/img";
        $Recursos->SlugRec = "user02";
        $Recursos->RecDelete = "0";
        $Recursos->FK_RecSolRes = "3";
        $Recursos->save();

        $Recursos = new Recurso();
        $Recursos->RecName = "Cliente3";
        $Recursos->RecCarte = "Foto";
        $Recursos->RecTipo = "Pesaje";
        $Recursos->RecSrc = "/img/defaul.png";
        $Recursos->RecFormat = ".png";
        $Recursos->RecRmSrc = "/img";
        $Recursos->SlugRec = "user03";
        $Recursos->RecDelete = "0";
        $Recursos->FK_RecSolRes = "2";
        $Recursos->save();

        $Recursos = new Recurso();
        $Recursos->RecName = "Cliente4";
        $Recursos->RecCarte = "Foto";
        $Recursos->RecTipo = "Reempacado";
        $Recursos->RecSrc = "/img/defaul.png";
        $Recursos->RecFormat = ".png";
        $Recursos->RecRmSrc = "/img";
        $Recursos->SlugRec = "user04";
        $Recursos->RecDelete = "0";
        $Recursos->FK_RecSolRes = "5";
        $Recursos->save();

        $Recursos = new Recurso();
        $Recursos->RecName = "Cliente5";
        $Recursos->RecCarte = "Foto";
        $Recursos->RecTipo = "Mezclado";
        $Recursos->RecSrc = "/img/defaul.png";
        $Recursos->RecFormat = ".png";
        $Recursos->RecRmSrc = "/img";
        $Recursos->SlugRec = "user05";
        $Recursos->RecDelete = "0";
        $Recursos->FK_RecSolRes = "4";
        $Recursos->save();
    }
}
