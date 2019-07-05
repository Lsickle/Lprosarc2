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