<?php

use Illuminate\Database\Seeder;
use App\GenerSede;
use Faker\Generator as Faker;


class GenerSedesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\GenerSede::class, 60)->create();

        $faker = \Faker\Factory::create();
        
      	$genersede = new GenerSede();
		$genersede->GSedeName = 'sede operativa';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '1';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'sede administrativa';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '1';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'sede principal';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '2';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'sede comercial';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '2';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'planta de procesamiento';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '3';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'oficinas administrativas';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '3';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'planta de reciclaje';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '3';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'sede principal';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '4';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'sede administrativa';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '4';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'centro de recoleccion';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '4';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'sede administrativa';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '5';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'centro de acopio';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '5';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'sede administrativa';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '6';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'planta de distibucion';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '6';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

		$genersede = new GenerSede();
		$genersede->GSedeName = 'planta de produccion';
		$genersede->GSedeAddress = $faker->address();
		$genersede->GSedePhone1 = '031 '.$faker->numerify('### ####');
		$genersede->GSedeExt1 = $faker->optional($weight = 0.3)->numerify('####');
		$genersede->GSedePhone2 = '';
		$genersede->GSedeExt2 = '';
		$genersede->GSedeEmail = $faker->randomElement(['compras', 'ambiental', 'operaciones', 'logistica', 'principal']).'@'.$faker->freeEmailDomain();
		$genersede->GSedeCelular = $faker->numberBetween($min = 300, $max = 316).' '.$faker->numerify('### ####');
		$genersede->FK_GSede = '6';
		$genersede->FK_GSedeMun = $faker->randomElement(['169', '557', '584', '581', '636']);
		$genersede->GSedeSlug = hash('sha256', rand().time().$genersede->GSedeAddress);
		$genersede->GSedeDelete = 0;
		$genersede->save();

    }
}
