<?php

use Illuminate\Database\Seeder;
use App\Vehiculo;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicle = new Vehiculo();
        $vehicle->VehicPlaca = "BKW-243";
        $vehicle->VehicInternExtern = "1";
        $vehicle->VehicTipo = "Camioneta";
        $vehicle->VehicCapacidad = "100";
        $vehicle->VehicKmActual = "1000";
        $vehicle->FK_VehiSede = "1";
        $vehicle->save();
        
        $vehicle = new Vehiculo();
        $vehicle->VehicPlaca = "HTS-098";
        $vehicle->VehicInternExtern = "0";
        $vehicle->VehicTipo = "Turbo";
        $vehicle->VehicCapacidad = "10000";
        $vehicle->VehicKmActual = "100";
        $vehicle->FK_VehiSede = "4";
        $vehicle->save();

        $vehicle = new Vehiculo();
        $vehicle->VehicPlaca = "CSS-131";
        $vehicle->VehicInternExtern = "0";
        $vehicle->VehicTipo = "Camion";
        $vehicle->VehicCapacidad = "464650";
        $vehicle->VehicKmActual = "7597";
        $vehicle->FK_VehiSede = "10";
        $vehicle->save();

        $vehicle = new Vehiculo();
        $vehicle->VehicPlaca = "FEE-132";
        $vehicle->VehicInternExtern = "1";
        $vehicle->VehicTipo = "Mula";
        $vehicle->VehicCapacidad = "728983837";
        $vehicle->VehicKmActual = "100034";
        $vehicle->FK_VehiSede = "8";
        $vehicle->save();

        $vehicle = new Vehiculo();
        $vehicle->VehicPlaca = "GDJ-GSH";
        $vehicle->VehicInternExtern = "1";
        $vehicle->VehicTipo = "Bus";
        $vehicle->VehicCapacidad = "6798";
        $vehicle->VehicKmActual = "06843";
        $vehicle->FK_VehiSede = "1";
        $vehicle->save();
    }
}
