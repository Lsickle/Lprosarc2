<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Sede;
use App\Cliente;
use App\Generador;
use App\GenerSede;
use App\Departamento;
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
use App\OrdenCompra;
use App\Quotation;
use App\Tratamiento;
use App\Clasificacion;
use App\CategoriaActivo;
use App\SubcategoriaActivo;
use App\Activo;
use App\Requerimiento;
use App\Cotizacion;
use App\Recurso;
use App\Certificado;
use App\ArticuloPorProveedor;
use App\MovimientoActivo;
use App\Tarifa;
use App\Pretratamiento;
use App\ManifiestoCarga;
use App\Subcategoryrespelpublic;
use App\Categoryrespelpublic;
use App\RolsTableSeeder;



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
        $this->call(RolsTableSeeder::class);
        $this->call(DepartamentosTableSeeder::class);
        $this->call(MunicipiosTableSeeder::class);
        $this->call(RealclientesTableSeeder::class);
        $this->call(RealSedesTableSeeder::class);
        $this->call(GeneradorsTableSeeder::class);
        $this->call(GenerSedesTableSeeder::class);
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
        // $this->call(TratamientoTableSeeder::class);
        $this->call(CategoriaActivoTableSeeder::class);
        $this->call(SubCategoriaActivoTableSeeder::class);
        $this->call(ActivoTableSeeder::class);
        $this->call(SolicitudServicioTableSeeder::class);
        $this->call(VehicProgTableSeeder::class);
        $this->call(OrdenCompraTableSeeder::class);
        $this->call(QuotationTableSeeder::class);
        $this->call(CotizacionsTableSeder::class);
        $this->call(RespelTableSeeder::class);
        $this->call(ClasificacionTableSeeder::class);
        $this->call(PretratamientosTableSeeder::class);
        $this->call(TratamientoTableSeeder::class);
        $this->call(SGeneradorResiduoTableSeeder::class);
        $this->call(RequerimientoTableSeeder::class);
        $this->call(TarifasTableSeder::class);
        $this->call(SolicitudResiduoTableSeeder::class);
        $this->call(CertificadoTableSeeder::class);
        $this->call(RecursoTableSeeder::class);
        $this->call(ArticuloXProveedorTableSeeder::class);
        $this->call(MovimientoActivoTableSeeder::class);
        $this->call(ManifiestoCargaTableSeeder::class);
        $this->call(categoryrespelpublicTableSeeder::class);
        $this->call(subcategoryrespelpublicTableSeeder::class);
        $this->call(RequerimientosClienteTableSeeder::class);
        
    }
}
