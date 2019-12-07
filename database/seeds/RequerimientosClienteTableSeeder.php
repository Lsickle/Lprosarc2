<?php

use Illuminate\Database\Seeder;

class RequerimientosClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requerimientos_clientes')->insert([
            'RequeCliBascula' => 1,
            'RequeCliCapacitacion' => 1,
            'RequeCliMasPerson' => 1,
            'RequeCliVehicExclusive' => 1,
            'RequeCliPlatform' => 1,
            'FK_RequeClient' => 2,
        ]);

        DB::table('requerimientos_clientes')->insert([
            'RequeCliBascula' => 0,
            'RequeCliCapacitacion' => 1,
            'RequeCliMasPerson' => 0,
            'RequeCliVehicExclusive' => 1,
            'RequeCliPlatform' => 0,
            'FK_RequeClient' => 3,
        ]);
    }
}
