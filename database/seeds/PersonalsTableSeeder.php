<?php

use Illuminate\Database\Seeder;
use App\Personal;

class PersonalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = "CC";
        $personal->PersDocNumber = '1010101010';
        $personal->PersFirstName = "Sin";
        $personal->PersSecondName = "persona";
        $personal->PersLastName = "asignada";
        $personal->PersCellphone = '5555555555';
        $personal->FK_PersCargo = '1';
        $personal->PersSlug = "pers-sin-asignada-2019-02-20";
        $personal->PersDelete = 0;
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = "CC";
        $personal->PersDocNumber = '1002526800';
        $personal->PersFirstName = "Duvan";
        $personal->PersSecondName = "Arley";
        $personal->PersLastName = "Gonzalez_Morato";
        $personal->PersCellphone = '3227392232';
        $personal->FK_PersCargo = '4';
        $personal->PersSlug = "pers-duvan-gonzalez_morato-2019-02-20";
        $personal->PersDelete = 0;
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = "CC";
        $personal->PersDocNumber = '76543532';
        $personal->PersFirstName = "Luis";
        $personal->PersLastName = "De_la_Hoz";
        $personal->PersCellphone = '3223822393';
        $personal->FK_PersCargo = '3';
        $personal->PersSlug = "pers-luis-de_la_hoz-2019-02-20";
        $personal->PersDelete = 0;
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = "CC";
        $personal->PersDocNumber = '1002526460';
        $personal->PersFirstName = "Andres";
        $personal->PersLastName = "Ramirez";
        $personal->PersCellphone = '3227396432';
        $personal->FK_PersCargo = '5';
        $personal->PersSlug = "pers-andres-ramirez-2019-02-20";
        $personal->PersDelete = 0;
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = "CC";
        $personal->PersDocNumber = '105354634';
        $personal->PersFirstName = "Camilo";
        $personal->PersSecondName = "Andres";
        $personal->PersLastName = "Murcia";
        $personal->PersCellphone = '3221234232';
        $personal->FK_PersCargo = '1';
        $personal->PersSlug = "pers-camilo-murcia-2019-02-20";
        $personal->PersDelete = 0;
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = "CC";
        $personal->PersDocNumber = '109765643';
        $personal->PersFirstName = "Maria";
        $personal->PersLastName = "Gonzalez_Sosa";
        $personal->PersCellphone = '3244562456';
        $personal->FK_PersCargo = '2';
        $personal->PersSlug = "pers-maria-gonzalez_sosa-2019-02-20";
        $personal->PersDelete = 0;
        $personal->save();
    }
}
