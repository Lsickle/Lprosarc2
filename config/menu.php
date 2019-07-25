<?php

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\userController;
use App\Cliente;
use App\Permisos;


Menu::macro('adminlteMenu', function () {
	return Menu::new()
		->addClass('sidebar-menu tree')->setAttribute('data-widget','tree');
});

Menu::macro('adminlteSeparator', function ($title) {
	return Html::raw($title)->addParentClass('header');
});
Menu::macro('sidebar', function () {//COMIENZO DEL SIDEBAR EN VERSION DE MENU
	if (Auth::user()->email_verified_at <> null && Auth::user()->FK_UserPers <> NULL) {
		return Menu::adminlteMenu()

			/*INICIO DEL MENU1 PARA PROSARC*/
				/*PESTAÑA DE MI EMPRESA*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) || in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC),
					(Menu::new()
						->prepend('<a href="#"><i class="fas fa-user-shield"></i> <span>'.trans('adminlte_lang::message.MenuClien2').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
						->addParentClass('treeview')
						/*PESTAÑA DE LAS SEDES DE PROSARC*/
						->add(Link::toUrl(route('cliente-show', Cliente::where('ID_Cli', userController::IDClienteSegunUsuario())->first()->CliSlug), '<i class="fas fa-building"></i> <span>'. trans('adminlte_lang::message.MenuSedes').'</span>'))
						/*PESTAÑA DE AREAS DE PROSARC*/
						->addIf(in_array(Auth::user()->UsRol, Permisos::AREAS) || in_array(Auth::user()->UsRol2, Permisos::AREAS), Link::toUrl('/areasInterno', '<i class="fas fa-archive"></i> <span>'.trans('adminlte_lang::message.MenuPersAreas').' </span>'))
						/*PESTAÑA DE CARGOS DE PROSARC*/
						->addIf(in_array(Auth::user()->UsRol, Permisos::CARGOS) || in_array(Auth::user()->UsRol2, Permisos::CARGOS), Link::toUrl('/cargosInterno', '<i class="fas fa-tools"></i> <span>'.trans('adminlte_lang::message.MenuPersCarg').' </span>'))
						/*PESTAÑA DE PERSONAL*/
						->addIf(in_array(Auth::user()->UsRol, Permisos::PERSONAL) || in_array(Auth::user()->UsRol2, Permisos::PERSONAL),(Link::toUrl('/personalInterno', '<i class="fas fa-users"></i> <span>'.trans('adminlte_lang::message.MenuPersonal').'</span>')))
						->addClass('treeview-menu')
					)
				)
				/*PESTAÑA DE PROGRAMACIONES DE SERVICIOS*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::PROGRAMACIONES) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMACIONES), Link::toUrl('/vehicle-programacion', '<i class="fas fa-calendar-alt"></i> <span>'.trans('adminlte_lang::message.MenuPrograVehic').' </span>'))
				/*PESTAÑA DE VEHICULOS*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::VEHICULOS) || in_array(Auth::user()->UsRol2, Permisos::VEHICULOS),
					(Menu::new()
						->prepend('<a href="#"><i class="fas fa-truck-moving"></i> <span>'.trans('adminlte_lang::message.MenuVehicleTitle').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
						->addParentClass('treeview')
						->add(Link::toUrl('/vehicle', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuVehiclelist')))
						->add(Link::toUrl('/vehicle-mantenimiento', '<i class="fas fa-tools"></i> '.trans('adminlte_lang::message.MenuMantVehic')))
						->addClass('treeview-menu')
					)
				)
				/*PESTAÑA DE LOS CONTACTOS DE PROSARC*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::CONTACTOS) || in_array(Auth::user()->UsRol2, Permisos::CONTACTOS), (Link::toUrl('/contactos', '<i class="fas fa-address-book"></i> <span>'. trans('adminlte_lang::message.MenuContactos').'</span>')))
				/*PESTAÑA DE LOS CONTRATOS*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::CONTRATOS) || in_array(Auth::user()->UsRol2, Permisos::CONTRATOS), (Link::toUrl('/contratos', '<i class="fas fa-address-book"></i> <span>'. /*trans('adminlte_lang::message.MenuContactos')*/'Contratos'.'</span>')))
				/*PESTAÑA DE LISTA DE CLIENTES*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::LISTACLIENTES) || in_array(Auth::user()->UsRol2, Permisos::LISTACLIENTES), (Link::toUrl('/clientes', '<i class="fa fa-list-ul"></i> <span>'. trans('adminlte_lang::message.MenuClien').'</span>')))
				/*PESTAÑA DE GENERADORES*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::LISTAGENERADORES) || in_array(Auth::user()->UsRol2, Permisos::LISTAGENERADORES),(Link::toUrl('/generadores', '<i class="fa fa-industry"></i> '. trans('adminlte_lang::message.MenuGenerClien'))))
				/*PESTAÑA DE RESIDUOS*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::LISTARESIDUOS) || in_array(Auth::user()->UsRol2, Permisos::LISTARESIDUOS),(Link::toUrl('/respels', '<i class="fa fa-biohazard"></i> '. trans('adminlte_lang::message.MenuRespelList'))))
				/*PESTAÑA DE TRATAMIENTOS*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::TRATAMIENTOS) || in_array(Auth::user()->UsRol2, Permisos::TRATAMIENTOS),(Link::toUrl('/tratamiento', '<i class="fas fa-vial"></i> '.trans('adminlte_lang::message.MenuTrataRespel'))))
				/*PESTAÑA DE PRETRATAMIENTOS*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::PRETRATAMIENTOS) || in_array(Auth::user()->UsRol2, Permisos::TRATAMIENTOS),(Link::toUrl('/pretratamiento', '<i class="fab fa-stack-overflow"></i> '.trans('adminlte_lang::message.MenuPreTrataRespel'))))
				/*PESTAÑA DE PERSONAL DEL CLIENTE*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::PERSONALCLIENTE) || in_array(Auth::user()->UsRol2, Permisos::PERSONALCLIENTE), Link::toUrl('/personal', '<i class="fas fa-users"></i> <span>'.trans('adminlte_lang::message.MenuPersonal2').'</span>'))
				/*PESTAÑA DE SOLICITUDES DE SERVICIO*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::SERVICIOS) || in_array(Auth::user()->UsRol2, Permisos::SERVICIOS),(Link::toUrl('/solicitud-servicio', '<i class="fas fa-people-carry"></i> <span>'.trans('adminlte_lang::message.MenuServTitle').'<span>')))
			/*FIN DEL MENU1 PARA PROSARC*/

				// CODIGO PARA CREAR CABEZERA EN EL MENU
				// ->addIf(in_array(Auth::user()->UsRol, Permisos::CLIENTE), (Html::raw(trans('adminlte_lang::message.MenuClienTitle'))->addParentClass('header')))

			/*INICIO DEL MENU PARA CLIENTE*/
				/*PESTAÑA DE MI CLIENTE*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::CLIENTE),(Link::toUrl(route('cliente-show',  Cliente::where('ID_Cli', userController::IDClienteSegunUsuario())->first()->CliSlug), '<i class="fas fa-user-shield"></i> <span>'. trans('adminlte_lang::message.MenuClien2').'</span>')))
				/*PESTAÑA DE GENERADORES*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::CLIENTE),(Link::toUrl('/generadores', '<i class="fa fa-industry"></i> '. trans('adminlte_lang::message.MenuGenerClientitle'))))
				/*PESTAÑA DE RESIDUOS*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::CLIENTE),(Link::toUrl('/respels', '<i class="fa fa-biohazard"></i> '. trans('adminlte_lang::message.MenuRespelList'))))
				/*PESTAÑA DE PERSONAL*/
				->addif(in_array(Auth::user()->UsRol, Permisos::CLIENTE), Link::toUrl('/areas', '<i class="fas fa-archive"></i> <span>'.trans('adminlte_lang::message.MenuPersAreas').'</span>'))
				->addif(in_array(Auth::user()->UsRol, Permisos::CLIENTE), Link::toUrl('/cargos', '<i class="fas fa-tools"></i> <span>'.trans('adminlte_lang::message.MenuPersCarg').'</span>'))
				->addif(in_array(Auth::user()->UsRol, Permisos::CLIENTE), Link::toUrl('/personal', '<i class="fas fa-users"></i> <span>'.trans('adminlte_lang::message.MenuPersonal').'</span>'))
				/*PESTAÑA DE SOLICITUD*/
				->addIf(in_array(Auth::user()->UsRol, Permisos::CLIENTE),(Link::toUrl('/solicitud-servicio', '<i class="fas fa-people-carry"></i> <span>'.trans('adminlte_lang::message.MenuServTitle').'<span>')))
				// ->addif(in_array(Auth::user()->UsRol, Permisos::CLIENTE), Link::toUrl('/preguntas-frecuentes', '<i class="fas fa-question-circle"></i> <span>'.trans('adminlte_lang::message.frequent questions').'</span>'))
			/*FIN DEL MENU PARA EL CLIENTE*/

		->setActiveFromRequest();
	}
	else{
		return Menu::adminlteMenu()
			/*ECABEZAMIENTO TITULO*/
			->add(Html::raw(trans('adminlte_lang::message.header'))->addParentClass('header'))

			/*PESTAÑA DE INICIO / HOME*/
			->action('HomeController@index', '<i class="fa fa-home"></i> <span>'.trans('adminlte_lang::message.home').'</span>')
			->setActiveFromRequest();
	}
});
/*VALIDACION DEL ROL CON EL QUE INGRESO*/
// ->addIf("CONDICION", LINK/ADD)