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

            /*ECABEZAMIENTO TITULO*/
            ->add(Html::raw(trans('adminlte_lang::message.header'))->addParentClass('header'))

            /*PESTAÑA DE INICIO / HOME*/
            ->action('HomeController@index', '<i class="fa fa-home"></i> <span>'.trans('adminlte_lang::message.home').'</span>')

            /*PESTAÑA DE CLIENTES*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Menu::new()
            /*"PREPEND SIRVE PARA COLOCAR UN ETIQUETA FUERA DEL MENU (ul)"*/
            ->prepend('<a href="#"><i class="fa fa-id-card"></i> <span>'.trans('adminlte_lang::message.clientcontact').'</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            
            /*LE ASIGNA UNA CLASE A ESA ETIQUETA CUANDO ¡NO! ESTA ACTIVA*/
            ->addParentClass('treeview')
            
            /*PESTAÑA DE CLIENTES Y CUANDO SE ACTIVA ASIGNA UNA NUEVA CLASE*/
            ->add(Link::toUrl('/clientes', '<i class="fa fa-list-ul"></i>'. trans('adminlte_lang::message.clientindex')))

            /*LE ASIGNA UNA CLASE DE MENU*/
            ->addClass('treeview-menu')

            /*UN SUBMENU */
            ->add(Menu::new()
            ->prepend('<a href="#"><i class="fa fa-building"></i> <span>Sedes</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/sclientes', '<i class="fa fa-map"></i>'. trans('adminlte_lang::message.csedeindex')))
            ->addClass('treeview-menu')
            )
            )
            )
            /*PESTAÑA DE MI CLIENTE*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'),
            (Link::toUrl(route('cliente', Auth::user()->UsSlug), '<i class="fas fa-user-shield"></i> '. trans('adminlte_lang::message.clientsidebar')))
            )
            /*PESTAÑA DE SEDES*/
            ->addIf(Auth::user()->UsRol === "Cliente",
            (Link::toUrl('/sclientes', '<i class="fa fa-building"></i><span> Sedes</span>'))
            )
            /*PESTAÑA DE GENERADORES*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Menu::new()
            ->prepend('<a href="#"><i class="fa fa-industry"></i> <span>'. trans('adminlte_lang::message.genermenu').' </span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/generadores', '<i class="fa fa-list-ul"></i>'. trans('adminlte_lang::message.generindex')))
            ->addClass('treeview-menu')
            ->add(Menu::new()
            ->prepend('<a href="#"><i class="fa fa-building"></i> <span>Sede Generador</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i> </a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/sgeneradores', '<i class="fa fa-map"></i>'. trans('adminlte_lang::message.csedeindex')))
            ->addClass('treeview-menu')
            )
            )
            )
            /*PESTAÑA DE RESIDUOS*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message."Cliente"') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Menu::new()
            ->prepend('<a href="#"><i class="fas fa-biohazard"></i> <span>'. trans('adminlte_lang::langresiduos.residuolisttitle').' </span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/respels', '<i class="fa fa-search"></i>'. trans('adminlte_lang::langresiduos.residuolisttitle')))
            ->add(Link::toUrl('/requerimientos', '<i class="fas fa-list-ol"></i> Requerimientos de Residuos'))
            ->add(Link::toUrl('/tratamiento', '<i class="fas fa-vial"></i> Tratamientos'))
            ->addClass('treeview-menu')
            )
            )
            /*PESTAÑA DE DOCUMENTOS*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Menu::new()
            ->prepend('<a href="#"><i class="fas fa-print"></i> <span>Documentos</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/certificado', '<i class="fas fa-certificate"></i> Certificados'))
            ->add(Link::toUrl('/manifiesto', '<i class="fas fa-tools"></i> Manifiestos'))
            ->addClass('treeview-menu')
            )
            )
            /*PESTAÑA DE PERSONAL*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')  || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.JefeLogistica') || Auth::user()->UsRol === trans('adminlte_lang::message.AsistenteLogistica') || Auth::user()->UsRol === trans('adminlte_lang::message.AuxiliarLogistica'),
            (Menu::new()
            ->prepend('<a href="#"><i class="fas fa-users"></i> <span>Personal</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->addif(Auth::user()->UsRol === "Cliente", Link::toUrl('/personal', '<i class="fas fa-list-alt"></i>'.trans('adminlte_lang::message.MenuClienPers')))
            ->addif(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')  || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'), Link::toUrl('/personalInterno', '<i class="fas fa-list-alt"></i>'.trans('adminlte_lang::message.MenuPersInter')))
            ->addif(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador')  || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.JefeLogistica') || Auth::user()->UsRol === trans('adminlte_lang::message.AsistenteLogistica') || Auth::user()->UsRol === trans('adminlte_lang::message.AuxiliarLogistica'), Link::toUrl('/personal', '<i class="fas fa-list-alt"></i>'.trans('adminlte_lang::message.MenuPersClien')))
            ->add(Link::toUrl('/asistencia', '<i class="fas fa-tasks"></i>'.trans('adminlte_lang::message.MenuPersAsis')))
            ->add(Link::toUrl('/horario', '<i class="fas fa-user-clock"></i>'.trans('adminlte_lang::message.MenuPersHorari')))
            ->add(Link::toUrl('/cargos', '<i class="fas fa-tools"></i>'.trans('adminlte_lang::message.MenuPersCarg')))
            ->add(Link::toUrl('/areas', '<i class="fas fa-archive"></i>'.trans('adminlte_lang::message.MenuPersAreas')))
            ->add(Link::toUrl('/inventariotech', '<i class="fas fa-laptop"></i>'.trans('adminlte_lang::message.MenuPersInven')))
            ->addClass('treeview-menu')
            )
            )
            /*PESTAÑA DE CAPACITACIONES*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Menu::new()
            ->prepend('<a href="#"><i class="fas fa-scroll"></i> <span>Capacitaciones</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/capacitacion', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/capacitacion-personal', '<i class="fas fa-user-check"></i> Capacitaciones del personal'))
            ->addClass('treeview-menu')
            )
            )
            /*PESTAÑA DE VEHICULOS*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Menu::new()
            ->prepend('<a href="#"><i class="fas fa-truck-moving"></i> <span>Vehiculos</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/vehicle', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/prueba', '<i class="fas fa-calendar-alt"></i> Programación'))
            ->add(Link::toUrl('/vehicle-mantenimiento', '<i class="fas fa-tools"></i> Mantenimiento'))
            ->addClass('treeview-menu')
            )
            )
            /*PESTAÑA DE COMPRA*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Menu::new()
            ->prepend('<a href="#"><i class="fas fa-money-bill-wave"></i> <span>Compra</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/compra/orden', '<i class="fas fa-file-invoice-dollar"></i> Orden'))
            ->add(Link::toUrl('/compra/cotizacion', '<i class="fas fa-file-invoice"></i> Cotizacion'))
            ->addClass('treeview-menu')
            )
            )
            /*PESTAÑA DE COTIZACIONES*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),            
            (Menu::new()
            ->prepend('<a href="#"><i class="fas fa-clipboard-list"></i> <span>Cotizaciones</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/cotizacion', '<i class="fas fa-list"></i> Lista'))
            ->add(Link::toUrl('/tarifas', '<i class="fas fa-dollar-sign"></i> Tarifas'))
            ->addClass('treeview-menu')
            )
            )
            /*PESTAÑA DE ACTIVOS*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Menu::new()
            ->prepend('<a href="#"><i class="fas fa-laptop"></i> <span>Activos</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/activos', '<i class="fas fa-list-alt"></i> Inventario'))
            ->add(Link::toUrl('/movimiento-activos', '<i class="fas fa-list-alt"></i> Movimientos'))
            ->addClass('treeview-menu')
            )
            )
            /*PESTAÑA DE SOLICITUD*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Menu::new()
            ->prepend('<a href="#"><i class="fas fa-people-carry"></i> <span>Solicitud</span><i class="fas fa-angle-left pull-right" style="color:#FFFFFF;" width="18" height="18"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/solicitud-servicio', '<i class="fas fa-file-signature"></i> Inventario de servicios'))
            ->add(Link::toUrl('/recurso', '<i class="fas fa-video"></i> Recursos'))
            ->addClass('treeview-menu')
            )
            )
            /*PESTAÑA DE ARTICULOS*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),
            (Link::toUrl('/articulos-proveedor', '<i class="far fa-newspaper"></i> <span>Articulos</span>'))
            )
            /*PESTAÑA DE CODIGO QR*/
            ->addIf(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'),

            (Link::toUrl('/code', '<i class="fas fa-qrcode"></i> <span>Codigo Qr</span>'))
            )
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