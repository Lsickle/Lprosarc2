<?php

use Illuminate\Database\Seeder;
use App\ResiduosGener;


class SGeneradorResiduoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "2";
        $SGenerRes->FK_Respel = "1";
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "1";
        $SGenerRes->FK_Respel = "3";
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "5";
        $SGenerRes->FK_Respel = "2";
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "3";
        $SGenerRes->FK_Respel = "5";
        $SGenerRes->save();

        $SGenerRes = new ResiduosGener();
        $SGenerRes->FK_SGener = "4";
        $SGenerRes->FK_Respel = "4";
        $SGenerRes->save();
    }
}
