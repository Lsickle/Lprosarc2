<?php

namespace App;

class Permisos{

    const Menu1 = ['Programador', 'AdministradorPlanta', 'JefeLogistica', 'JefeOperaciones', 'AdministradorBogota', 'JefeComercial'];
    /*using: ClienteController:index,show,edit cliencontoller:index,show,edit clientes/create2 clientes/index clientes/show clientes/edit*/
    const CLIENTE = ['Cliente'];
    /*ClienteController:index,show,edit*/
    const PROGRAMADOR = ['Programador'];
    /*cliencontoller:index,show,edit*/
    const TODOPROSARC = [
    	'Programador',
		'AdministradorPlanta',
		'Hseq',
		'JefeLogistica',
		'AsistenteLogistica',
		'Conductor',
		'JefeOperaciones',
		'Supervisor',
		'AdministradorBogota',
		'JefeComercial',
		'Tesorería',
		'Comercial',
		'AsistenteComercial',
		'Cliente'
	];
	/*scliencontroller:create*/
	const CLIENTEYADMINS = [
		'Programador',
		'Cliente',
		'AdministradorPlanta', 
		'AdministradorBogota'
	];



	const Jefes = ['Programador', 'AdministradorPlanta', 'JefeLogistica', 'JefeOperaciones', 'AdministradorBogota', 'JefeComercial'];
	/* Using ->
		Menu.php
		PersonalInternoController::Index
	*/
	const ProgVehic1 = ['Programador', 'JefeLogistica'];
	/* Using ->
		ProgramacionVehicle/create
		VehicProgController::Create
		ProgramacionVehicle/edit
	*/
	const ProgVehic2 = ['Programador', 'JefeLogistica', 'AsistenteLogistica'];
	/* Using ->
		ProgramacionVehicle/create
		VehicProgController::Edit
		ProgramacionVehicle/edit
	*/
	const PersInter1 = ['Programador', 'AdministradorPlanta','AdministradorBogota'];
	/* Using ->
		personalInterno/index
		PersonalInternoController::Create
		personalInterno/show
	*/

}

/*
Programador
AdministradorPlanta - 
Hseq
JefeLogistica - 
AsistenteLogistica
Conductor
JefeOperaciones - 
Supervisor
AdministradorBogota - 
JefeComercial - 
Tesorería
Comercial
AsistenteComercial
Cliente
 */