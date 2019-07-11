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
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1127607127;
        $personal->PersFirstName = 'Luis';
        $personal->PersSecondName = 'Alberto';
        $personal->PersLastName = 'De la hoz Ricaurte';
        $personal->PersLibreta = 1127607127;
        $personal->PersBirthday = '17/08/1984';
        $personal->PersCellphone = 3014145321;
        $personal->PersAddress = 'cll 23 #11c-03';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Davivienda';
        $personal->PersIngreso = '3/05/2019';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 1;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Sistemas@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1000322832;
        $personal->PersFirstName = 'Andres';
        $personal->PersSecondName = 'Alejandro';
        $personal->PersLastName = 'Martinez Montoya';
        $personal->PersLibreta = 1000322832;
        $personal->PersBirthday = '26/12/2000';
        $personal->PersCellphone = 3213889851;
        $personal->PersAddress = 'Crr 2 #17-14 Barrio El Hato';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '11/02/2019';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 2;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Sistemas3@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1002526800;
        $personal->PersFirstName = 'Duvan';
        $personal->PersSecondName = 'Arley';
        $personal->PersLastName = 'Gonzalez Morato';
        $personal->PersLibreta = 1002526800;
        $personal->PersBirthday = '23/09/2000';
        $personal->PersCellphone = 3227392232;
        $personal->PersAddress = 'Cll 17 # 3e-73 Barrio Iregui';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '11/02/2019';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 2;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Sistemas2@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 86064344;
        $personal->PersFirstName = 'Victor';
        $personal->PersSecondName = 'Hugo';
        $personal->PersLastName = 'Velasco Parrado';
        $personal->PersLibreta = 86064344;
        $personal->PersBirthday = '27/05/1980';
        $personal->PersCellphone = 3115133749;
        $personal->PersAddress = 'Crr 2 # 1-04 Trr 14 Apto 201 Conj Altos de Madrid';
        $personal->PersEPS = 'medimas';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '30/11/2008';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 5;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'dirtecnica@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 80864648;
        $personal->PersFirstName = 'Jhon';
        $personal->PersSecondName = 'gilberto';
        $personal->PersLastName = 'Gonzales Bravo';
        $personal->PersLibreta = 80864648;
        $personal->PersBirthday = '23/07/1985';
        $personal->PersCellphone = 3154251268;
        $personal->PersAddress = 'cll 5 este # 651 barro Trebol de guali';
        $personal->PersEPS = 'nueva eps';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '15/07/2013';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 3;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'logistica@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 11447586;
        $personal->PersFirstName = 'Duvan';
        $personal->PersSecondName = 'Alexander';
        $personal->PersLastName = 'Campos Moncada';
        $personal->PersLibreta = 11447586;
        $personal->PersBirthday = '25/02/1983';
        $personal->PersCellphone = 3208898335;
        $personal->PersAddress = 'Bloque 11 401 Hacienda el rolsal';
        $personal->PersEPS = 'medimas';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '6/02/2006';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 4;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'asistentelogistica@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1073515439;
        $personal->PersFirstName = 'Jhonatan';
        $personal->PersSecondName = 'Alejandro';
        $personal->PersLastName = 'Gamba Cubillos';
        $personal->PersLibreta = 1073515439;
        $personal->PersBirthday = '15/09/1994';
        $personal->PersCellphone = 3174644547;
        $personal->PersAddress = 'Cll 20 # 14-40 urb Caminos de Mosquera';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'sura';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '6/02/2019';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 4;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'auxiliarlogistico@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1032436523;
        $personal->PersFirstName = 'Andres';
        $personal->PersSecondName = 'Felipe';
        $personal->PersLastName = 'Moreno Bello';
        $personal->PersLibreta = 1032436523;
        $personal->PersBirthday = '21/04/1990';
        $personal->PersCellphone = 3057099564;
        $personal->PersAddress = 'Urb Normandia del parque 1';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '1/03/2013';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 7;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'ingenierohseq@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 52556208;
        $personal->PersFirstName = 'Leider';
        $personal->PersSecondName = 'Edilsa';
        $personal->PersLastName = 'Osorio Hoyos';
        $personal->PersLibreta = 52556208;
        $personal->PersBirthday = '24/03/1971';
        $personal->PersCellphone = 3176673032;
        $personal->PersAddress = 'Cll 5 # 5-95 URB TENJO';
        $personal->PersEPS = 'Compensar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '15/09/2008';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 8;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'gerenteplanta@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 80578466;
        $personal->PersFirstName = 'Camilo';
        $personal->PersSecondName = 'Andres';
        $personal->PersLastName = 'Triviño Suarez';
        $personal->PersLibreta = 80578466;
        $personal->PersBirthday = '14/01/1980';
        $personal->PersCellphone = 3103339997;
        $personal->PersAddress = 'Cll 6b # 11- 19 Barrio San Luis';
        $personal->PersEPS = 'Compensar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '16/12/2018';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 9;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'ingtratamiento1@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1070955862;
        $personal->PersFirstName = 'Oscar';
        $personal->PersSecondName = 'Camilo';
        $personal->PersLastName = 'Vasquez Hernandez';
        $personal->PersLibreta = 1070955862;
        $personal->PersBirthday = '21/08/1989';
        $personal->PersCellphone = 3187805600;
        $personal->PersAddress = 'Crr 2b sur # 8a45';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '9/01/2018';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 9;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'ingtratamiento3@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1198869084;
        $personal->PersFirstName = 'William';
        $personal->PersLastName = 'Cendales';
        $personal->PersLibreta = 1198869084;
        $personal->PersBirthday = '25/05/2005';
        $personal->PersCellphone = 3564546897;
        $personal->PersAddress = 'sub estacion balsillas km 5';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '5/05/2006';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 9;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'ingtratamiento2@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 3143926;
        $personal->PersFirstName = 'Alfonso';
        $personal->PersLastName = 'Riaño Sosa';
        $personal->PersLibreta = 3143926;
        $personal->PersBirthday = '26/05/2005';
        $personal->PersCellphone = 3176673013;
        $personal->PersAddress = 'sub estacion balsillas km 6';
        $personal->PersEPS = 'cruz blanca';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '1/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 10;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Conductor1@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 16161456;
        $personal->PersFirstName = 'Victor';
        $personal->PersLastName = 'Vaquero Herrera';
        $personal->PersLibreta = 16161456;
        $personal->PersBirthday = '27/05/2005';
        $personal->PersCellphone = 3175031289;
        $personal->PersAddress = 'sub estacion balsillas km 7';
        $personal->PersEPS = 'coomeva';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '2/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 10;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Conductor2@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 79006056;
        $personal->PersFirstName = 'Jose';
        $personal->PersSecondName = 'Fabian';
        $personal->PersLastName = 'Perez Castro';
        $personal->PersLibreta = 79006056;
        $personal->PersBirthday = '28/05/2005';
        $personal->PersCellphone = 3176673017;
        $personal->PersAddress = 'sub estacion balsillas km 8';
        $personal->PersEPS = 'salud total';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '3/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 10;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Conductor3@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1087007539;
        $personal->PersFirstName = 'Hilber';
        $personal->PersSecondName = 'Manolo';
        $personal->PersLastName = 'Benavides Arevalo';
        $personal->PersLibreta = 1087007539;
        $personal->PersBirthday = '29/05/2005';
        $personal->PersCellphone = 3156019567;
        $personal->PersAddress = 'sub estacion balsillas km 9';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '4/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 10;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Conductor4@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 79886908;
        $personal->PersFirstName = 'Juan';
        $personal->PersSecondName = 'Alejandro';
        $personal->PersLastName = 'Galeano Pulido';
        $personal->PersLibreta = 79886908;
        $personal->PersBirthday = '30/05/2005';
        $personal->PersCellphone = 3175019689;
        $personal->PersAddress = 'sub estacion balsillas km 10';
        $personal->PersEPS = 'cruz blanca';
        $personal->PersARL = 'sura';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '5/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 10;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Conductor5@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 70846762;
        $personal->PersFirstName = 'Orlando';
        $personal->PersLastName = 'Pinillos';
        $personal->PersLibreta = 70846762;
        $personal->PersBirthday = '31/05/2005';
        $personal->PersCellphone = 3165291730;
        $personal->PersAddress = 'Cll 120# 7-62 Ed cei3 ofi 605';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '6/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 3;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'subgerencia@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 27896835;
        $personal->PersFirstName = 'Maria';
        $personal->PersSecondName = 'Cristina';
        $personal->PersLastName = 'Molano González';
        $personal->PersLibreta = 27896835;
        $personal->PersBirthday = '1/06/2005';
        $personal->PersCellphone = 3164684868;
        $personal->PersAddress = 'Cll 120# 7-62 Ed cei3 ofi 606';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '7/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 16;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'CuentasCorporativas@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 86153540;
        $personal->PersFirstName = 'Lorena';
        $personal->PersLastName = 'Urriago Javela';
        $personal->PersLibreta = 86153540;
        $personal->PersBirthday = '2/06/2005';
        $personal->PersCellphone = 3212138751;
        $personal->PersAddress = 'Cll 120# 7-62 Ed cei3 ofi 607';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '8/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 12;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Comercial2@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 11262782;
        $personal->PersFirstName = 'Briyith';
        $personal->PersLastName = 'Rodriguez Sanchez';
        $personal->PersLibreta = 11262782;
        $personal->PersBirthday = '3/06/2005';
        $personal->PersCellphone = 3108614367;
        $personal->PersAddress = 'Cll 120# 7-62 Ed cei3 ofi 608';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '9/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 12;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Comercial1@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 16315776;
        $personal->PersFirstName = 'Miguel';
        $personal->PersSecondName = 'Felipe';
        $personal->PersLastName = 'Martinez';
        $personal->PersLibreta = 16315776;
        $personal->PersBirthday = '4/06/2005';
        $personal->PersCellphone = 3222621708;
        $personal->PersAddress = 'Cll 120# 7-62 Ed cei3 ofi 609';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '10/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 12;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Comercial3@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 89309581;
        $personal->PersFirstName = 'Lady';
        $personal->PersLastName = 'Céspedes Moreno';
        $personal->PersLibreta = 89309581;
        $personal->PersBirthday = '5/06/2005';
        $personal->PersCellphone = 3164393895;
        $personal->PersAddress = 'Cll 120# 7-62 Ed cei3 ofi 610';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '11/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 13;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'servicomercial@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 92238474;
        $personal->PersFirstName = 'Nidia';
        $personal->PersLastName = 'Zorillo';
        $personal->PersLibreta = 92238474;
        $personal->PersBirthday = '6/06/2005';
        $personal->PersCellphone = 3555532355;
        $personal->PersAddress = 'Cll 120# 7-62 Ed cei3 ofi 611';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '13/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 14;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Gestion@prosarc.com.co';
        $personal->save();

        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 90348105;
        $personal->PersFirstName = 'Andres';
        $personal->PersSecondName = 'Felipe';
        $personal->PersLastName = 'Cardenas';
        $personal->PersLibreta = 90348105;
        $personal->PersBirthday = '7/06/2005';
        $personal->PersCellphone = 3556546546;
        $personal->PersAddress = 'Cll 120# 7-62 Ed cei3 ofi 612';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '12/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 15;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'gerencia@prosarc.com.co';
        $personal->save();
    }
}
