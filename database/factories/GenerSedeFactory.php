<?php

use Faker\Generator as Faker;

$factory->define(App\GenerSede::class, function (Faker $faker) {
	$gsedename=$faker->randomElement(['norte', 'sur','este', 'oeste', 'principal']);
	$gslug=$gsedename.' '.$faker->unique()->numberBetween($min = 100, $max = 9000);
	$gsactualizado = $faker->dateTime($max = 'now');
	$gscreado= $faker->dateTime($max = $gsactualizado);
	/*cellpart hace referencia a una parte de una numero celular ejemplo:cellpart1=316 cellpart2=40135421*/
	$cellpart2=$faker->optional($weight = 0.9)->numerify('#######');/*10% chance of NULL*/

	if ($cellpart2!=null) {
		$cellpart1=$faker->numberBetween($min = 300, $max = 316);
		$ext1= $faker->optional($weight = 0.3)->numerify('####');/*70% chance of NULL*/
		$cellpart4=$faker->optional($weight = 0.9)->numerify('#######');/*10% chance of NULL*/
	}else{
		$cellpart4=null;
		$cellpart1=null;
		$cellpart3=null;
		$ext2=null;
		$ext1=null;
	};

	if ($cellpart4!=null) {
		$cellpart3=$faker->numberBetween($min = 300, $max = 316);
		$ext2= $faker->optional($weight = 0.3)->numerify('####');/*70% chance of NULL*/
	}else{
		$cellpart3=null;
		$ext2=null;
	};

	$gsedecorreo=$gsedename.'@'.$faker->freeEmailDomain();
    return [
        'GSedeName'=> $gsedename,
        'GSedeAddress'=> $faker->address(),
        'GSedePhone1'=> '('.$cellpart1.')'.$cellpart2,
        'GSedeExt1'=>  $ext1,
        'GSedePhone2'=> '('.$cellpart3.')'.$cellpart4,
        'GSedeExt2'=> $ext2,
        'GSedeEmail'=> $gsedecorreo,
        'GSedeCelular'=> $faker->optional($weight = 0.8)->numerify('###.###.###.###-#'),/*20% chance of NULL*/
        'GSedeSlug'=> str_slug($gslug), /*$title-$gsedeclass,*/
        'created_at'=> $gscreado,
        'updated_at'=> $gsactualizado
    ];
});
