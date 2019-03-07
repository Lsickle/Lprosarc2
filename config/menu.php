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
    return Menu::adminlteMenu()

        /*ECABEZAMIENTO TITULO*/
        ->add(Html::raw(trans('adminlte_lang::message.header'))->addParentClass('header'))

        /*PESTAÑA DE INICIO / HOME*/
        ->action('HomeController@index', '<i class="fa fa-home"></i><span>'.trans('adminlte_lang::message.home').'</span>')

        /*VALIDACION DEL ROL CON EL QUE INGRESO*/
         /*->addIf(Auth::user()->UsRol == "Programador" || Auth::user()->UsRol == "admin")*/

        /*PESTAÑA DE CLIENTES*/
        ->add(Menu::new()
                /*"PREPEND SIRVE PARA COLOCAR UN ETIQUETA FUERA DEL MENU (ul)"*/
            ->prepend('<a href="#"><i class="fa fa-id-card"></i><span>'.trans('adminlte_lang::message.contacts').'</span><i class="fas fa-angle-left pull-right"></i></a>')

             /*LE ASIGNA UNA CLASE A ESA ETIQUETA CUANDO ¡NO! ESTA ACTIVA*/
            ->addParentClass('treeview')

            /*PESTAÑA DE CLIENTES Y CUANDO SE ACTIVA ASIGNA UNA NUEVA CLASE*/
            ->add(Link::toUrl('/clientes', '<i class="fa fa-list-ul"></i>'. trans('adminlte_lang::message.clientindex')))

            /*LE ASIGNA UNA CLASE DE MENU*/
            ->addClass('treeview-menu')

            /*UN SUBMENU */
            ->add(Menu::new()
                ->prepend('<a href="#"><i class="fa fa-building"></i> Sedes<span class="pull-right-container"><i class="fas fa-angle-left pull-right"></i></span></a>')
                ->addParentClass('treeview')
                ->add(Link::toUrl('/sclientes', '<i class="fa fa-map"></i>'. trans('adminlte_lang::message.csedeindex')))
                ->addClass('treeview-menu')
            )
        )
        /*PESTAÑA DE GENERADORES*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fa fa-industry"></i> <span>'. trans('adminlte_lang::message.genermenu').'</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/generadores', '<i class="fa fa-list-ul"></i>'. trans('adminlte_lang::message.generindex')))
            ->addClass('treeview-menu')
            ->add(Menu::new()
                ->prepend('<a href="#"><i class="fa fa-building"></i>Sede Generador<span class="pull-right-container"><i class="fas fa-angle-left pull-right"></i> </span></a>')
                ->addParentClass('treeview')
                ->add(Link::toUrl('/sgeneradores', '<i class="fa fa-map"></i>'. trans('adminlte_lang::message.csedeindex')))
                ->addClass('treeview-menu')
            )
        )
        /*PESTAÑA DE RESIDUOS*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-biohazard"></i> <span>'. trans('adminlte_lang::langresiduos.residuolisttitle').'</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/respels', '<i class="fa fa-search"></i>'. trans('adminlte_lang::langresiduos.residuolisttitle')))
            ->add(Link::toUrl('/requerimientos', '<i class="fas fa-list-ol"></i> Requerimientos de Residuos'))
            ->add(Link::toUrl('/tratamiento', '<i class="fas fa-vial"></i> Tratamientos'))
            ->addClass('treeview-menu')
        )
        /*PESTAÑA DE DOCUMENTOS*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-print"></i> <span>Documentos</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/certificado', '<i class="fas fa-certificate"></i> Certificados'))
            ->add(Link::toUrl('/manifiesto', '<i class="fas fa-tools"></i> Manifiestos'))
            ->addClass('treeview-menu')
        )
        /*PESTAÑA DE PERSONAL*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-users"></i> <span>Personal</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/personal', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/asistencia', '<i class="fas fa-tasks"></i> Asistencia'))
            ->add(Link::toUrl('/cargos', '<i class="fas fa-tools"></i> Cargos'))
            ->add(Link::toUrl('/areas', '<i class="fas fa-archive"></i> Areas'))
            ->add(Link::toUrl('/inventariotech', '<i class="fas fa-laptop"></i> Inventario Tecnologia'))
            ->addClass('treeview-menu')
        )
        /*PESTAÑA DE CAPACITACIONES*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-scroll"></i> <span>Capacitaciones</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/capacitacion', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/capacitacion-personal', '<i class="fas fa-user-check"></i> Capacitaciones del personal'))
            ->addClass('treeview-menu')
        )
        /*PESTAÑA DE VEHICULOS*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-truck-moving"></i></i> <span> Vehiculos</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/vehicle', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/vehicle-programacion', '<i class="fas fa-calendar-alt"></i> Programación'))
            ->add(Link::toUrl('/vehicle-mantenimiento', '<i class="fas fa-tools"></i> Mantenimiento'))
            ->addClass('treeview-menu')
        )
        /*PESTAÑA DE VEHICULOS*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-truck-moving"></i></i> <span> Vehiculos</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/vehicle', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/vehicle-programacion', '<i class="fas fa-calendar-alt"></i> Programación'))
            ->add(Link::toUrl('/vehicle-mantenimiento', '<i class="fas fa-tools"></i> Mantenimiento'))
            ->addClass('treeview-menu')
        )
        /*PESTAÑA DE VEHICULOS*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-truck-moving"></i></i> <span> Vehiculos</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/vehicle', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/vehicle-programacion', '<i class="fas fa-calendar-alt"></i> Programación'))
            ->add(Link::toUrl('/vehicle-mantenimiento', '<i class="fas fa-tools"></i> Mantenimiento'))
            ->addClass('treeview-menu')
        )
        /*PESTAÑA DE VEHICULOS*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-truck-moving"></i></i> <span> Vehiculos</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/vehicle', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/vehicle-programacion', '<i class="fas fa-calendar-alt"></i> Programación'))
            ->add(Link::toUrl('/vehicle-mantenimiento', '<i class="fas fa-tools"></i> Mantenimiento'))
            ->addClass('treeview-menu')
        )
        /*PESTAÑA DE VEHICULOS*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-truck-moving"></i></i> <span> Vehiculos</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/vehicle', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/vehicle-programacion', '<i class="fas fa-calendar-alt"></i> Programación'))
            ->add(Link::toUrl('/vehicle-mantenimiento', '<i class="fas fa-tools"></i> Mantenimiento'))
            ->addClass('treeview-menu')
        )
        /*PESTAÑA DE VEHICULOS*/
        ->add(Menu::new()
            ->prepend('<a href="#"><i class="fas fa-truck-moving"></i></i> <span> Vehiculos</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::toUrl('/vehicle', '<i class="fas fa-list-alt"></i> Listar'))
            ->add(Link::toUrl('/vehicle-programacion', '<i class="fas fa-calendar-alt"></i> Programación'))
            ->add(Link::toUrl('/vehicle-mantenimiento', '<i class="fas fa-tools"></i> Mantenimiento'))
            ->addClass('treeview-menu')
        )
























        ->add(Menu::adminlteSeparator('Acacha Adminlte'))
        #adminlte_menu
        /*->add(Link::toUrl('/prueba', '<i class="fa fa-link"></i><span>/prueba</span>'))*/
        ->add(Menu::adminlteSeparator('SECONDARY MENU'))
        ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-share"></i><span>Multilevel</span> <i class="fas fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::to('/prueba', 'Link1'))->addClass('treeview-menu')
            ->add(Link::to('/clientes', 'Link2'))
            ->url('/clientes/create', 'Google')
            ->add(Menu::new()->prepend('<a href="#"><span>Multilevel 2</span> <i class="fas fa-angle-left pull-right"></i></a>')
                ->addParentClass('treeview')
                ->add(Link::to('/link21', 'Link21'))->addClass('treeview-menu')
                ->add(Link::to('/link22', 'Link22'))
                ->url('http://www.google.com', 'Google')
            )
        )
//        ->add(
//            Menu::fullsubmenuexample()
//        )
//        ->add(
//            Menu::adminlteSubmenu('Best menu')
//                ->add(Link::to('/acacha', 'acacha'))
//                ->add(Link::to('/profile', 'Profile'))
//                ->url('http://www.google.com', 'Google')
//        )
        ->setActiveFromRequest();
});