<?php

namespace App;

class Permisos{

	const Jefes = ['Programador', 'AdministradorPlanta', 'JefeLogistica', 'JefeOperaciones', 'AdministradorBogota', 'JefeComercial'];
	/* Using ->
		Menu.php
		PersonalInternoController::Index
		ContactoController::create
		ContactoController::edit
		Contactos/index
		Contactos/show
		Contactos/showProveedor
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
    const CLIENTE = ['Cliente'];
    /* Using ->
		ClienteController:index,show,edit
		cliencontoller:index,show,edit
		clientes/create2
		clientes/index
		clientes/show
		clientes/edit
		ContactoController::Index
		ContactoController::show
	*/
    const PROGRAMADOR = ['Programador'];
    /* Using ->
		ClienteController:index,show,edit
		ContactoController::Index
		ContactoController::show
		Contactos/show
		Contactos/showProveedor
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