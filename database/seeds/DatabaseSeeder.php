<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\sede;
use App\cliente;
use App\generador;
use App\GenerSede;
use App\departamento;
use App\Municipios;
use App\Area;
use App\Cargo;
use App\Personal;
use App\Training;
use App\TrainingPersonal;
use App\Assistance;
use App\InventarioTechnology;
use App\Vehiculo;
use App\ProgramacionVehiculo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(clientesTableSeeder::class);
        $this->call(generadorsTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(MunicipiosTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(CargosTableSeeder::class);
        $this->call(PersonalsTableSeeder::class);
        $this->call(TrainingsTableSeeder::class);
        $this->call(TrainingPersonalsTableSeeder::class);
        $this->call(AssistancesTableSeeder::class);
        $this->call(InventarioTechTableSeeder::class);
        $this->call(VehicleTableSeeder::class);
        $this->call(VehicProgTableSeeder::class);
    }
}
