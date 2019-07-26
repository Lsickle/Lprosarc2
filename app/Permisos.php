<?php

namespace App;

class Permisos{

	const Jefes = ['Programador', 'AdministradorPlanta', 'JefeLogistica', 'JefeOperaciones', 'AdministradorBogota', 'JefeComercial'];
	/* Using ->
		partials/controlsidebar
		Menu.php
		PersonalInternoController::Index
		ContactoController::create
		ContactoController::edit
		Contactos/index
		Contactos/show
		Contactos/showProveedor
		partials/mainheader
	*/
	const ProgVehic1 = ['Programador', 'JefeLogistica'];
	/* Using ->
		ProgramacionVehicle/create
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
		SolicitudServicioController::changestatus
	*/
	const PersInter1 = ['Programador', 'AdministradorPlanta','AdministradorBogota'];
	/* Using ->
		partials/controlsidebar
		permisos/index
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
		recursos/show
	*/
	const SolSer2 = ['Programador', 'JefeOperaciones', 'Supervisor', 'JefeLogistica', 'AsistenteLogistica'];
	/*Using ->
		solicitud-serv/show
	*/

	const CLIENTE = ['Cliente'];
	/* Using ->
		genercontroller:index,edit
		ClienteController:index,show,edit
		cliencontoller:index,show,edit
		generadores/index
		generadores/show
		clientes/create2
		clientes/index
		clientes/show
		clientes/edit
		ContactoController::Index
		ContactoController::show
		RespelController::Index
		RespelController::Create
		RespelController::Store
		RespelController::Show
		RespelController::Edit
		SolicitudResiduoController::edit
		SolicitudServicioController::index,create,edit,changestatus
		recursos/show
		AreaController:index,create,edit
		CargoController::index,create,edit
		PersonalController::index,create
		personal/index
		solicitud-serv/index
		solicitud-serv/show
		Menu.php
	*/

	const PROGRAMADOR = ['Programador'];
	/* Using ->
		genercontroller:index
		generadores/index
		generadores/show
		ClienteController:index,show,edit
		ContactoController::Index
		ContactoController::show
		Contactos/show
		Contactos/showProveedor
		RespelController::Index
		RespelController::Create
		RespelController::Edit
		RespelController::Update
		RespelController::Destroy
		RespelController::updateStatusRespel
		AreaController:index,create,edit
		AreaInternoController::index
		CargoController::index,create,edit
		CargoInternoController::index
		PersonalController::index,create,edit
		PersonalInternoController::index
		SolicitudServicioController::create,edit,changestatus
		VehicleController::index
		VehicManteController::index
		personal/index
		personal/show
		ProgramacionVehicle/edit
		solicitud-serv/index
		solicitud-serv/show
		sclientes/sedes/show
	*/
	const TODOPROSARC = ['Programador', 'AdministradorPlanta', 'Hseq', 'JefeLogistica', 'AsistenteLogistica', 'Conductor', 'JefeOperaciones', 'Supervisor', 'AdministradorBogota', 'JefeComercial', 'Tesorería', 'Comercial', 'AsistenteComercial'];
	/* Using ->
		cliencontoller:index,show,edit
		AreaInternoController::index
		CargoInternoController::index
		SolicitudServicioController::changestatus
		VehicleController::index
		VehicManteController::index
		Menu.php
		VehicProgController::create
		ProgramacionVehicle/index
	*/
	const CLIENTEYADMINS = ['Programador', 'Cliente', 'AdministradorPlanta', 'AdministradorBogota'];
	/* Using ->
		scliencontroller:create
	*/
	const ASISTENTELOGISTICA = ['AsistenteLogistica'];
	/* Using ->
		ProgramacionVehicle/edit
	*/
	const JEFELOGISTICA = ['JefeLogistica'];
	/* Using ->
		ProgramacionVehicle/edit
	*/
	const SolSerCertifi = ['AdministradorPlanta'];
	/*
		solicitud-serv/index
		SolicitudServicioController::changestatus
		SolicitudServicioController::index
	 */
	const SOLSERACEPTADO = ['Tesorería'];
	/*
		solicitud-serv/index
		SolicitudServicioController::changestatus
		SolicitudServicioController::index
	 */


	const ComercialYJefeComercial = ['AdministradorBogota', 'JefeComercial', 'Comercial'];
	/*
		respel/edit
		
	 */
	
	const COMERCIAL = ['Comercial'];
	/* Using ->
		clientcontoller::index
	*/
	const AsigComercial = ['Programador', 'AdministradorBogota'];
	/* Using ->
		clientes/index
	*/

	const JefeOperaciones = ['Programador', 'JefeOperaciones'];
	/*Using ->
		pretratamientos/edit
		pretratamientocontoller::destroy
	*/

	/*CONJUNTO DE ARRAY PARA EL MENU.PHP PARA PERSONAL DE PROSARC*/
	const AREAS = ['Programador','AdministradorPlanta','AdministradorBogota'];
	const CARGOS = ['Programador','AdministradorPlanta','AdministradorBogota'];
	const PERSONAL = ['Programador','AdministradorPlanta','JefeLogistica','JefeOperaciones','AdministradorBogota'];
	const PROGRAMACIONES = ['Programador','AdministradorPlanta','JefeLogistica','AsistenteLogistica','Conductor','JefeOperaciones','Supervisor','AdministradorBogota','Tesorería','Comercial'];
	const VEHICULOS = ['Programador','AdministradorPlanta','JefeLogistica','AsistenteLogistica','AdministradorBogota'];
	const CONTACTOS = ['Programador','AdministradorPlanta','JefeLogistica','AdministradorBogota','JefeOperaciones'];
	const CONTRATOS = ['Programador','AdministradorPlanta','AdministradorBogota','Comercial','AsistenteComercial'];
	const LISTACLIENTES = ['Programador','AdministradorPlanta','JefeLogistica','AsistenteLogistica','JefeOperaciones','Supervisor','AdministradorBogota','Tesorería','Comercial','AsistenteComercial'];
	const LISTAGENERADORES = ['Programador','AdministradorPlanta','JefeLogistica','AsistenteLogistica','JefeOperaciones','Supervisor','AdministradorBogota','Tesorería','Comercial','AsistenteComercial'];
	const LISTARESIDUOS = ['Programador','AdministradorPlanta','JefeOperaciones','Supervisor','AdministradorBogota','Tesorería','Comercial'];
	const TRATAMIENTOS = ['Programador','AdministradorPlanta','JefeOperaciones','Supervisor','AdministradorBogota','Tesorería','Comercial'];
	const PERSONALCLIENTE = ['Programador','AdministradorPlanta','JefeLogistica','AsistenteLogistica','JefeOperaciones','Supervisor','AdministradorBogota','Tesorería','Comercial','AsistenteComercial'];
	const SERVICIOS = ['Programador','AdministradorPlanta','JefeLogistica','AsistenteLogistica','JefeOperaciones','Supervisor','AdministradorBogota','Tesorería','Comercial','AsistenteComercial'];
	const PRETRATAMIENTOS = ['Programador','AdministradorPlanta','JefeOperaciones','Supervisor','AdministradorBogota','Tesorería','Comercial'];

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
Tesorería
Comercial
AsistenteComercial
Cliente
 */