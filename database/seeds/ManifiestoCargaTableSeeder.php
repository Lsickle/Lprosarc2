<?php

use Illuminate\Database\Seeder;
use App\ManifiestoCarga;

class ManicargfiestoCargaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manicarg = new ManifiestoCarga();
        $manicarg->FK_ManiCargSolSer = 1;
        $manicarg->save();


        $manicarg = new ManifiestoCarga();
        $manicarg->FK_ManiCargSolSer = 2;
        $manicarg->save();


        $manicarg = new ManifiestoCarga();
        $manicarg->FK_ManiCargSolSer = 3;
        $manicarg->save();


        $manicarg = new ManifiestoCarga();
        $manicarg->FK_ManiCargSolSer = 4;
        $manicarg->save();


        $manicarg = new ManifiestoCarga();
        $manicarg->FK_ManiCargSolSer = 5;
        $manicarg->save();
    }
}
