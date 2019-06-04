<?php

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;
use Illuminate\Support\Facades\Auth;


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
            /*PESTAÑA DE INICIO / HOME*/
            ->action('HomeController@index', '<i class="fa fa-home"></i> <span>'.trans('adminlte_lang::message.home').'</span>')

            /*TITULO DEL MENU1 PARA PROSARC*/
	            ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), (Html::raw(trans('adminlte_lang::message.MenuProsarcTitle'))->addParentClass('header')))
				/*PESTAÑA DE MI EMPRESA*/
				->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),(Link::toUrl(route('cliente', Auth::user()->UsSlug), '<i class="fas fa-user-shield"></i> <span>'. trans('adminlte_lang::message.MenuClien2').'</span>')))

				/*PESTAÑA DE LAS SEDES DE PROSARC*/
				->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), (Link::toUrl('/sclientes', '<i class="fa fa-building"></i> <span>'. trans('adminlte_lang::message.MenuSedes').'</span>')))
				
				/*PESTAÑA DE LOS CONTACTOS DE PROSARC*/
				->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), (Link::toUrl('/contactos', '<i class="fas fa-address-book"></i> <span>'. trans('adminlte_lang::message.MenuContactos').'</span>')))
				
	            /*PESTAÑA DE PERSONAL*/
		        ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
			        (Menu::new()
				        ->prepend('<a href="#"><i class="fas fa-users"></i> <span>'.trans('adminlte_lang::message.MenuPersonal').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				        ->addParentClass('treeview')
				        ->addif(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), Link::toUrl('/personalInterno', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuPerslist')))
				        ->add(Link::toUrl('/asistencia', '<i class="fas fa-tasks"></i> '.trans('adminlte_lang::message.MenuPersAsis')))
				        ->add(Link::toUrl('/horario', '<i class="fas fa-user-clock"></i> '.trans('adminlte_lang::message.MenuPersHorari')))
				        ->add(Link::toUrl('/cargosInterno', '<i class="fas fa-tools"></i> '.trans('adminlte_lang::message.MenuPersCarg')))
				        ->add(Link::toUrl('/areasInterno', '<i class="fas fa-archive"></i> '.trans('adminlte_lang::message.MenuPersAreas')))
				        ->add(Link::toUrl('/inventariotech', '<i class="fas fa-laptop"></i> '.trans('adminlte_lang::message.MenuPersInven')))
				        ->addClass('treeview-menu')
			        )
		        )
		        /*PESTAÑA DE CAPACITACIONES*/
		        ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
			         (Menu::new()
				         ->prepend('<a href="#"><i class="fas fa-scroll"></i> <span>'.trans('adminlte_lang::message.MenuTrainingTitle').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				         ->addParentClass('treeview')
				         ->add(Link::toUrl('/capacitacion', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuTraininglist')))
				         ->add(Link::toUrl('/capacitacion-personal', '<i class="fas fa-user-check"></i> '.trans('adminlte_lang::message.MenuTrainingPers')))
				         ->addClass('treeview-menu')
			         )
		        )
		        /*PESTAÑA DE VEHICULOS*/
		        ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
			          (Menu::new()
				          ->prepend('<a href="#"><i class="fas fa-truck-moving"></i> <span>'.trans('adminlte_lang::message.MenuVehicleTitle').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				          ->addParentClass('treeview')
				          ->add(Link::toUrl('/vehicle', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuVehiclelist')))
				          ->add(Link::toUrl('/vehicle-programacion', '<i class="fas fa-calendar-alt"></i> '.trans('adminlte_lang::message.MenuPrograVehic')))
				          ->add(Link::toUrl('/vehicle-mantenimiento', '<i class="fas fa-tools"></i> '.trans('adminlte_lang::message.MenuMantVehic')))
				          ->addClass('treeview-menu')
			          )
		        )
		        /*PESTAÑA DE COMPRA*/
			    ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
		              (Menu::new()
				          ->prepend('<a href="#"><i class="fas fa-money-bill-wave"></i> <span>'.trans('adminlte_lang::message.MenuShopTitle').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				          ->addParentClass('treeview')
				          ->add(Link::toUrl('/compra/orden', '<i class="fas fa-file-invoice-dollar"></i> '.trans('adminlte_lang::message.MenuShopOrde')))
				          ->add(Link::toUrl('/compra/cotizacion', '<i class="fas fa-file-invoice"></i> '.trans('adminlte_lang::message.MenuShopCoti')))
				          ->addClass('treeview-menu')
			          )
		        )
			    /*PESTAÑA DE ARTICULOS*/
	            ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),(Link::toUrl('/articulos-proveedor', '<i class="far fa-newspaper"></i> <span>'. trans('adminlte_lang::message.MenuArticu').'</span>')))
            	/*PESTAÑA DE CODIGO QR*/
	            ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), (Link::toUrl('/code', '<i class="fas fa-qrcode"></i> <span>'. trans('adminlte_lang::message.MenuQr').'</span>')))

	        /*FIN DEL MENU1 PARA PROSARC




            /*TITULO DEL MENU2 PARA PROSARC*/
	            ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), (Html::raw(trans('adminlte_lang::message.MenuProsarcCliTitle'))->addParentClass('header')))
	            /*PESTAÑA DE CLIENTES*/
	            ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), (Link::toUrl('/clientes', '<i class="fa fa-list-ul"></i> <span>'. trans('adminlte_lang::message.MenuClien').'</span>')))
	            /*PESTAÑA DE LAS SEDES DEL CLIENTE*/
	            ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), (Link::toUrl('/sedes', '<i class="fa fa-building"></i> <span>'. trans('adminlte_lang::message.MenuSedesClien').'</span>')))
	            /*PESTAÑA DE GENERADORES*/
	            ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
	                  (Menu::new()
	                        ->prepend('<a href="#"><i class="fa fa-industry"></i> <span>'. trans('adminlte_lang::message.MenuGener').' </span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
	                        ->addParentClass('treeview')
	                        ->add(Link::toUrl('/generadores', '<i class="fa fa-list-ul"></i> '. trans('adminlte_lang::message.MenuGenerClien')))
	                        ->add(Link::toUrl('/sgeneradores', '<i class="fa fa-map"></i> '. trans('adminlte_lang::message.MenuSedesGener')))
	                        ->addClass('treeview-menu')
	                  )
	            )
	            /*PESTAÑA DE RESIDUOS*/
		        ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
			         (Menu::new()
				         ->prepend('<a href="#"><i class="fas fa-biohazard"></i> <span>'. trans('adminlte_lang::message.MenuRespel').' </span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				         ->addParentClass('treeview')
				         ->add(Link::toUrl('/respels', '<i class="fa fa-search"></i> '. trans('adminlte_lang::message.MenuRespelList')))
				         ->add(Link::toUrl('/requerimientos', '<i class="fas fa-list-ol"></i> '.trans('adminlte_lang::message.MenuRequRespel')))
				         ->add(Link::toUrl('/tratamiento', '<i class="fas fa-vial"></i> '.trans('adminlte_lang::message.MenuTrataRespel')))
				         ->addClass('treeview-menu')
			         )
		        )
		        /*PESTAÑA DE DOCUMENTOS*/
		        ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
			        (Menu::new()
				         ->prepend('<a href="#"><i class="fas fa-print"></i> <span>'. trans('adminlte_lang::message.MenuDocumentsTitle').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				         ->addParentClass('treeview')
				         ->add(Link::toUrl('/certificado', '<i class="fas fa-certificate"></i> '. trans('adminlte_lang::message.MenuCertificado')))
				         ->add(Link::toUrl('/manifiesto', '<i class="fas fa-tools"></i> '. trans('adminlte_lang::message.MenuManifiesto')))
				         ->addClass('treeview-menu')
		        	)
		        )
		        /*PESTAÑA DE PERSONAL*/
		        ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), 
			        (Menu::new()
				        ->prepend('<a href="#"><i class="fas fa-users"></i> <span>'.trans('adminlte_lang::message.MenuPersonal2').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				        ->addParentClass('treeview')
				        ->add(Link::toUrl('/personal', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuPerslist')))
				        ->add(Link::toUrl('/cargos', '<i class="fas fa-tools"></i>'.trans('adminlte_lang::message.MenuPersCarg')))
				        ->add(Link::toUrl('/areas', '<i class="fas fa-archive"></i>'.trans('adminlte_lang::message.MenuPersAreas')))
				        ->addClass('treeview-menu')
			        )
		        )
		        /*PESTAÑA DE COTIZACIONES*/
			    ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
				    (Menu::new()
					    ->prepend('<a href="#"><i class="fas fa-clipboard-list"></i> <span>'. trans('adminlte_lang::message.MenuCotiTitle').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
					    ->addParentClass('treeview')
					    ->add(Link::toUrl('/cotizacion', '<i class="fas fa-list"></i> '. trans('adminlte_lang::message.MenuCotiList')))
					    ->add(Link::toUrl('/tarifas', '<i class="fas fa-dollar-sign"></i> '. trans('adminlte_lang::message.MenuCotiTarifas')))
					    ->addClass('treeview-menu')
				    )
			    )
			    /*PESTAÑA DE ACTIVOS*/
			    ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
				     (Menu::new()
					     ->prepend('<a href="#"><i class="fas fa-laptop"></i> <span>'.trans('adminlte_lang::message.MenuActivTitle').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
					     ->addParentClass('treeview')
					     ->add(Link::toUrl('/activos', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuActivInven')))
					     ->add(Link::toUrl('/movimiento-activos', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuActivMovi')))
					     ->addClass('treeview-menu')
				     )
			    )
			    /*PESTAÑA DE SOLICITUD*/
			    // ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),
				//     (Menu::new()
				// 	    ->prepend('<a href="#"><i class="fas fa-people-carry"></i> <span>'.trans('adminlte_lang::message.MenuServTitle').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				// 	    ->addParentClass('treeview')
				// 	    ->add(Link::toUrl('/solicitud-servicio', '<i class="fas fa-file-signature"></i> '.trans('adminlte_lang::message.MenuServlist')))
				// 	    ->add(Link::toUrl('/recurso', '<i class="fas fa-video"></i> '.trans('adminlte_lang::message.MenuServEviden')))
				// 	    ->addClass('treeview-menu')
				//     )
				// )
				->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'),(Link::toUrl('/solicitud-servicio', '<i class="fas fa-people-carry"></i> <span>'.trans('adminlte_lang::message.MenuServTitle').'<span>')))


	        /*FIN DEL MENU2 PARA PROSARC*/



            /*TITULO DEL MENU PARA CLIENTE*/
	            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'), (Html::raw(trans('adminlte_lang::message.MenuClienTitle'))->addParentClass('header')))
	            /*PESTAÑA DE MI CLIENTE*/
	            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),(Link::toUrl(route('cliente', Auth::user()->UsSlug), '<i class="fas fa-user-shield"></i> <span>'. trans('adminlte_lang::message.MenuClien2').'</span>')))
	            /*PESTAÑA DE LAS SEDES DEL CLIENTE*/
	            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),(Link::toUrl('/sclientes', '<i class="fa fa-building"></i> <span>'. trans('adminlte_lang::message.MenuSedes').'</span>')))
	            /*PESTAÑA DE GENERADORES*/
	            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),
	                  (Menu::new()
	                        ->prepend('<a href="#"><i class="fa fa-industry"></i> <span>'. trans('adminlte_lang::message.MenuGenerClientitle').' </span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
	                        ->addParentClass('treeview')
	                        ->add(Link::toUrl('/generadores', '<i class="fa fa-list-ul"></i> '. trans('adminlte_lang::message.MenuGenerClien')))
	                        ->add(Link::toUrl('/sgeneradores', '<i class="fa fa-map"></i> '. trans('adminlte_lang::message.MenuSedesGener')))
	                        ->addClass('treeview-menu')
	                  )
	            )
	            /*PESTAÑA DE RESIDUOS*/
		        ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),
			         (Menu::new()
				         ->prepend('<a href="#"><i class="fas fa-biohazard"></i> <span>'. trans('adminlte_lang::message.MenuRespelClien').' </span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				         ->addParentClass('treeview')
				         ->add(Link::toUrl('/respels', '<i class="fa fa-search"></i> '. trans('adminlte_lang::message.MenuRespelList')))
				         ->add(Link::toUrl('/requerimientos', '<i class="fas fa-list-ol"></i> '.trans('adminlte_lang::message.MenuRequRespel')))
				         // ->add(Link::toUrl('/tratamiento', '<i class="fas fa-vial"></i> '.trans('adminlte_lang::message.MenuTrataRespel')))
				         ->addClass('treeview-menu')
			         )
		        )
		        /*PESTAÑA DE DOCUMENTOS*/
		        ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),
			        (Menu::new()
				         ->prepend('<a href="#"><i class="fas fa-print"></i> <span>'. trans('adminlte_lang::message.MenuDocumentsClien').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				         ->addParentClass('treeview')
				         ->add(Link::toUrl('/certificado', '<i class="fas fa-certificate"></i> '. trans('adminlte_lang::message.MenuCertificado')))
				         ->add(Link::toUrl('/manifiesto', '<i class="fas fa-tools"></i> '. trans('adminlte_lang::message.MenuManifiesto')))
				         ->addClass('treeview-menu')
		        	)
		        )
		        /*PESTAÑA DE PERSONAL*/
		        ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'), 
			        (Menu::new()
				        ->prepend('<a href="#"><i class="fas fa-users"></i> <span>'.trans('adminlte_lang::message.MenuPersonal').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				        ->addParentClass('treeview')
				        ->addif(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'), Link::toUrl('/personal', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuPerslist')))
				        ->add(Link::toUrl('/cargos', '<i class="fas fa-tools"></i>'.trans('adminlte_lang::message.MenuPersCarg')))
				        ->add(Link::toUrl('/areas', '<i class="fas fa-archive"></i>'.trans('adminlte_lang::message.MenuPersAreas')))
				        ->addClass('treeview-menu')
			        )
		        )
		        /*PESTAÑA DE COTIZACIONES*/
			    ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),
				    (Menu::new()
					    ->prepend('<a href="#"><i class="fas fa-clipboard-list"></i> <span>'. trans('adminlte_lang::message.MenuCotiClien').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
					    ->addParentClass('treeview')
					    ->add(Link::toUrl('/cotizacion', '<i class="fas fa-list"></i> '. trans('adminlte_lang::message.MenuCotiList')))
					    ->add(Link::toUrl('/tarifas', '<i class="fas fa-dollar-sign"></i> '. trans('adminlte_lang::message.MenuCotiTarifas')))
					    ->addClass('treeview-menu')
				    )
			    )
			    /*PESTAÑA DE ACTIVOS*/
			    ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),
				     (Menu::new()
					     ->prepend('<a href="#"><i class="fas fa-laptop"></i> <span>'.trans('adminlte_lang::message.MenuActivClien').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
					     ->addParentClass('treeview')
					     ->add(Link::toUrl('/activos', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuActivInven')))
					     ->add(Link::toUrl('/movimiento-activos', '<i class="fas fa-list-alt"></i> '.trans('adminlte_lang::message.MenuActivMovi')))
					     ->addClass('treeview-menu')
				     )
			    )
			    /*PESTAÑA DE SOLICITUD*/
			    // ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),
				//     (Menu::new()
				// 	    ->prepend('<a href="#"><i class="fas fa-people-carry"></i> <span>'.trans('adminlte_lang::message.MenuServClien').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
				// 	    ->addParentClass('treeview')
				// 	    ->add(Link::toUrl('/solicitud-servicio', '<i class="fas fa-file-signature"></i> '.trans('adminlte_lang::message.MenuServlist')))
				// 	    ->add(Link::toUrl('/recurso', '<i class="fas fa-video"></i> '.trans('adminlte_lang::message.MenuServEviden')))
				// 	    ->addClass('treeview-menu')
				//     )
				// )
				
				// ->addIf(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'), 
				// (Link::toUrl('/contactos', '<i class="fas fa-address-book"></i> <span>'. trans('adminlte_lang::message.MenuContactos').'</span>')))


			    ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),(Link::toUrl('/solicitud-servicio', '<i class="fas fa-people-carry"></i> <span>'.trans('adminlte_lang::message.MenuServTitle').'<span>')))

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