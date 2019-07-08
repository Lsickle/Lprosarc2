<?php

namespace App;

class Permisos{

	const Jefes = ['Programador', 'AdministradorPlanta', 'JefeLogistica', 'JefeOperaciones', 'AdministradorBogota', 'JefeComercial'];
	/* Using ->
		Menu.php
		PersonalInternoController::Index
	*/
	const ProgVehic1 = ['Programador', 'JefeLogistica'];
	/* Using ->
		ProgramacionVehicle/index
		ProgramacionVehicle/create
		VehicProgController::create
		ProgramacionVehicle/edit
		ManteniVehicle/index
		vehicle/index
		VehicleController::create,edit
		solicitud-serv/show
	*/
	const ProgVehic2 = ['Programador', 'JefeLogistica', 'AsistenteLogistica'];
	/* Using ->
		ProgramacionVehicle/index
		ProgramacionVehicle/create
		VehicProgController::edit
		ProgramacionVehicle/edit
		solicitud-serv/show
	*/
	const PersInter1 = ['Programador', 'AdministradorPlanta','AdministradorBogota'];
	/* Using ->
		personalInterno/index
		PersonalInternoController::create,edit
		personalInterno/show
		areasInterno/index
		AreaInternoController::create,edit
		cargosInterno/index
		CargoInternoController::create,edit
		partials/controlsidebar
	*/
	const SolSer1 = ['Programador', 'JefeOperaciones', 'Supervisor'];
	/*Using ->
		solicitud-serv/show
	*/
	const SolSer2 = ['Programador', 'JefeOperaciones', 'Supervisor', 'JefeLogistica', 'AsistenteLogistica'];
	/*Using ->
		solicitud-serv/show
	*/
	const CLIENTE = ['Cliente'];
	/* Using ->
		ClienteController:index,show,edit
		cliencontoller:index,show,edit
		clientes/create2
		clientes/index
		clientes/show
		clientes/edit
	*/
	const PROGRAMADOR = ['Programador'];
	/* Using ->
		ClienteController:index,show,edit
	*/
	const TODOPROSARC = ['Programador', 'AdministradorPlanta', 'Hseq', 'JefeLogistica', 'AsistenteLogistica', 'Conductor', 'JefeOperaciones', 'Supervisor', 'AdministradorBogota', 'JefeComercial', 'Tesorería', 'Comercial', 'AsistenteComercial'];
	/* Using ->
		cliencontoller:index,show,edit
	*/
	const CLIENTEYADMINS = ['Programador', 'Cliente', 'AdministradorPlanta', 'AdministradorBogota'];
	/* Using ->
		scliencontroller:create
	*/

}

/*
Programador
AdministradorPlanta
Hseq
JefeLogistica
AsistenteLogistica
Conductor
JefeOperaciones
Supervisor
AdministradorBogota
JefeComercial
Tesorería
Comercial
AsistenteComercial
Cliente
 */