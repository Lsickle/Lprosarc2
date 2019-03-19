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
use App\MantenimientoVehiculo;
use App\ordenCompra;
use App\Quotation;
use App\Tratamiento;
use App\CategoriaActivo;
use App\SubcategoriaActivo;
use App\Activo;
use App\Requerimiento;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        //$this->call(RoleTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(MunicipiosTableSeeder::class);
        $this->call(RealclientesTableSeeder::class);
        $this->call(RealSedesTableSeeder::class);
        $this->call(generadorsTableSeeder::class);
        $this->call(AreasTableSeeder::class);
        $this->call(CargosTableSeeder::class);
        $this->call(PersonalsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TrainingsTableSeeder::class);
        $this->call(TrainingPersonalsTableSeeder::class);
        $this->call(AssistancesTableSeeder::class);
        $this->call(InventarioTechTableSeeder::class);
        $this->call(VehicleTableSeeder::class);
        $this->call(MantenVehicTableSeeder::class);
        $this->call(VehicProgTableSeeder::class);
        $this->call(OrdenCompraTableSeeder::class);
        $this->call(CotizacionTableSeeder::class);
        // $this->call(TratamientoTableSeeder::class);
        $this->call(CategoriaActivoTableSeeder::class);
        $this->call(SubCategoriaActivoTableSeeder::class);
        $this->call(ActivoTableSeeder::class);
        $this->call(SolicitudServicioTableSeeder::class);
        $this->call(RespelTableSeeder::class);
        $this->call(SolicitudResiduoTableSeeder::class);
        $this->call(RequerimientoTableSeeder::class);
        $this->call(SGeneradorResiduoTableSeeder::class);
    }
}
