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
		PersonalInternoController::Edit
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