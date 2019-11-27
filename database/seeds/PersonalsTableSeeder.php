<?php

use Illuminate\Database\Seeder;
use App\Personal;
use Faker\Generator as Faker;

class PersonalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){  
        
        $faker = \Faker\Factory::create();
        /*personal PROSARC*//*personal PROSARC*//*personal PROSARC*//*personal PROSARC*//*personal PROSARC*/
        /*id = 01 */
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
        
        /*id = 02 */
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
        
        /*id = 03 */
        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1007510085;
        $personal->PersFirstName = 'Heidy';
        $personal->PersSecondName = 'Vanessa';
        $personal->PersLastName = 'Pastor Muñoz';
        $personal->PersLibreta = '';
        $personal->PersBirthday = '23/08/2001';
        $personal->PersCellphone = 3222327520;
        $personal->PersAddress = 'Cll 14a #6a - 20';
        $personal->PersEPS = 'Convida';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '28/10/2019';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 2;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'Sistemas2@prosarc.com.co';
        $personal->save();
        
        /*id = 04 */
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
        
        /*id = 05 */
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
        
        /*id = 06 */
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
        
        /*id = 07 */
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
        
        /*id = 08 */
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
        
        /*id = 09 */
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
        $personal->FK_PersCargo = 16;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'gerenteplanta@prosarc.com.co';
        $personal->save();
        
        /*id = 10 */
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
        
        /*id = 11 */
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
        
        /*id = 12 */
        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1198869084;
        $personal->PersFirstName = 'William';
        $personal->PersLastName = 'Cendales Arevalo';
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
        
        /*id = 13 */
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
        
        /*id = 14 */
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
        
        /*id = 15 */
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
        
        /*id = 16 */
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
        
        /*id = 17 */
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
        
        /*id = 18 */
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
        
        /*id = 19 */
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
        $personal->FK_PersCargo = 12;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'CuentasCorporativas@prosarc.com.co';
        $personal->save();
        
        /*id = 20 */
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
        
        /*id = 21 */
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
        
        /*id = 22 */
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
        
        /*id = 23 */
        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 16315776;
        $personal->PersFirstName = 'Santiago';
        $personal->PersSecondName = '';
        $personal->PersLastName = 'Zapata';
        $personal->PersLibreta = 16315776;
        $personal->PersBirthday = '4/06/2005';
        $personal->PersCellphone = 3104782792;
        $personal->PersAddress = 'Cll 120# 7-62 Ed cei3 ofi 609';
        $personal->PersEPS = 'Famisanar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '10/05/2012';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 12;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'aprovechablesyraee@prosarc.com.co';
        $personal->save();
        
        /*id = 24 */
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
        
        /*id = 25 */
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
        
        /*id = 26 */
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

        /*id = 27 */
        $personal = new Personal();
        $personal->PersType = 0;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 5555555;
        $personal->PersFirstName = 'David';
        $personal->PersSecondName = '';
        $personal->PersLastName = 'Pizza';
        $personal->PersLibreta = 5555555;
        $personal->PersBirthday = '24/03/1971';
        $personal->PersCellphone = 3016894387;
        $personal->PersAddress = 'Cll ppal de Mosquera';
        $personal->PersEPS = 'Compensar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '15/09/2019';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 8;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'gerenteplanta@prosarc.com.co';
        $personal->save();

        /*personal EXTERNO*//*personal EXTERNO*//*personal EXTERNO*//*personal EXTERNO*//*personal EXTERNO*/
        /*id = 28 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = 1127609981;
        $personal->PersFirstName = 'Alejandro';
        $personal->PersSecondName = 'Gabriel';
        $personal->PersLastName = 'De la hoz Caceres';
        $personal->PersLibreta = 1127609981;
        $personal->PersBirthday = '24/03/1971';
        $personal->PersCellphone = 3014141414;
        $personal->PersAddress = 'Cll ppal de Mosquera';
        $personal->PersEPS = 'Compensar';
        $personal->PersARL = 'Colpatria';
        $personal->PersBank = 'Av Villas';
        $personal->PersIngreso = '15/09/2019';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 17;
        $personal->PersDelete = 0;
        $personal->PersEmail = 'luisdelahoz0@gmail.com';
        $personal->PersFactura = 1;
        $personal->save();

        /*id = 29 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 18;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 30 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 19;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 31 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 20;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 32 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 21;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 33 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 22;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 34 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 23;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 35 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 24;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 36 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 25;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 37 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 26;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 38 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 27;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 39 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 28;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 40 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 29;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 41 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 30;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 42 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 31;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 43 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 32;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 44 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 33;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 45 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 34;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 46 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 35;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 0;
        $personal->save();

        /*id = 47 */
        $personal = new Personal();
        $personal->PersType = 1;
        $personal->PersDocType = 'CC';
        $personal->PersDocNumber = $faker->unique()->numberBetween($min = 800000000, $max = 1200000000);
        $personal->PersFirstName = $faker->firstName();
        $personal->PersSecondName = $faker->firstName();
        $personal->PersLastName = $faker->lastName();
        $personal->PersLibreta = $personal->PersDocNumber;
        $personal->PersBirthday = $faker->date($format = 'Y-m-d', $max = '1960-01-01') ;
        $personal->PersCellphone = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
        $personal->PersAddress = $faker->address();
        $personal->PersEPS = '';
        $personal->PersARL = '';
        $personal->PersBank = '';
        $personal->PersIngreso = '';
        $personal->PersSlug = hash('sha256', rand().time().$personal->PersDocNumber);
        $personal->FK_PersCargo = 36;
        $personal->PersDelete = 0;
        $personal->PersEmail = $personal->PersFirstName.$faker->freeEmailDomain();
        $personal->PersEPS = '';
        $personal->PersFactura = 1;
        $personal->save();
    }
}
