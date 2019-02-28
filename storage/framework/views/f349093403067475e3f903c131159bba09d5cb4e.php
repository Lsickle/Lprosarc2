<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <?php if(! Auth::guest()): ?>
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="../../../images/<?php echo e(Auth::user()->UsAvatar); ?>"
                        class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip" title="<?php echo e(Auth::user()->name); ?>"><?php echo e(Auth::user()->name); ?></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success" class="treeview-menu"></i> <?php echo e(trans('adminlte_lang::message.online')); ?></a>
                    </div>
                </div>         
            <?php endif; ?>

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="<?php echo e(trans('adminlte_lang::message.search')); ?>..."/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header"><?php echo e(trans('adminlte_lang::message.header')); ?></li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="<?php echo e(url('home')); ?>"><i class='fa fa-home'></i> <span><?php echo e(trans('adminlte_lang::message.home')); ?></span></a></li>
                <?php if(Auth::user()->id==1): ?>
                <li class="treeview">
                    <a href="#"><i class='fa fa-id-card'></i> <span><?php echo e(trans('adminlte_lang::message.contacts')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/clientes"><i class='fa fa-list-ul'></i><?php echo e(trans('adminlte_lang::message.clientindex')); ?></a></li>
                        <li><a href="/clientes/create"><i class='fa fa-user-plus'></i><?php echo e(trans('adminlte_lang::message.clientregister')); ?></a></li>
                        
                        <li class="treeview">
                          <a href="#"><i class="fa fa-building"></i>Sedes
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            
                            <li><a href="/sclientes"><i class='fa fa-map'></i><?php echo e(trans('adminlte_lang::message.csedeindex')); ?></a></li>
                            
                            <li><a href="/sclientes/create"><i class='fa fa-map-marked-alt'></i><?php echo e(trans('adminlte_lang::message.csederegister')); ?></a></li>
                          </ul>
                        </li>

                        
                        
                    </ul>
                </li>
                <?php endif; ?>
                <li class="treeview">
                    <a href="#"><i class='fa fa-industry'></i> <span><?php echo e(trans('adminlte_lang::message.genermenu')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/Generadores/"><i class='fa fa-list-ul'></i><?php echo e(trans('adminlte_lang::message.generindex')); ?></a></li>
                        <li><a href="/Generadores/create"><i class='fa fa-user-plus'></i><?php echo e(trans('adminlte_lang::message.generregister')); ?></a></li>
                        
                        <li class="treeview">
                          <a href="#"><i class="fa fa-building"></i>Sede Generador
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            
                            <li><a href="/sgeneradores"><i class='fa fa-map'></i><?php echo e(trans('adminlte_lang::message.csedeindex')); ?></a></li>
                            
                            <li><a href="/sgeneradores/create"><i class='fa fa-map-marked-alt'></i><?php echo e(trans('adminlte_lang::message.csederegister')); ?></a></li>
                          </ul>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fas fa-biohazard'></i> <span><?php echo e(trans('adminlte_lang::langresiduos.residuolisttitle')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/respels"><i class='fa fa-search'></i><?php echo e(trans('adminlte_lang::langresiduos.residuolistitem1')); ?></a></li>

                        <li><a href="/respels/create"><i class='fa fa-file-text'></i><?php echo e(trans('adminlte_lang::langresiduos.residuolistitem2')); ?></a></li>
                        
                        <li><a href="/tratamiento"><i class="fas fa-vial"></i> Tratamientos</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fas fa-print"></i> <span>Recibos</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/recibo-material"><i class="fas fa-radiation"></i> Materiales</a></li>
                        <li><a href="/certificado"><i class="fas fa-certificate"></i> Certificados</a></li>
                        <li><a href="/manifiesto"><i class='fas fa-tools'></i> Manifiestos</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fas fa-users"></i> <span>Personal</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/personal"><i class="fas fa-list-alt"></i> Listar</a></li>
                        <li><a href="/asistencia"><i class="fas fa-tasks"></i> Asistencia</a></li>
                        <li><a href="/cargos"><i class='fas fa-tools'></i> Cargos</a></li>
                        <li><a href="/areas"><i class="fas fa-archive"></i> Areas</a></li>
                        <li><a href="/inventariotech"><i class="fas fa-laptop"></i> Inventario Tecnologia</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fas fa-scroll"></i> <span>Capacitaciones</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/capacitacion"><i class='fas fa-list-alt'></i> Listar</a></li>
                        <li><a href="/capacitacion-personal"><i class="fas fa-user-check"></i> Capacitaciones del personal</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-list'></i> <span><?php echo e(trans('adminlte_lang::message.declarationmenu')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/declaraciones"><i class='fa fa-search'></i><?php echo e(trans('adminlte_lang::message.declarread')); ?></a></li>

                        <li><a href="/declaraciones/create"><i class='fa fa-file-text'></i><?php echo e(trans('adminlte_lang::message.declarregister')); ?></a></li>
                        
                        
                    </ul>
                </li>
                
                <li class="treeview">
                    <a href="#"><i class='fa fa-clipboard-list'></i> <span><?php echo e(trans('adminlte_lang::message.ordermenu')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class='fa fa-plus'></i><?php echo e(trans('adminlte_lang::message.orderregister')); ?></a></li>
                        <li><a href="#"><i class='fa fa-search'></i><?php echo e(trans('adminlte_lang::message.orderread')); ?></a></li>
                        <li><a href="#"><i class='fa fa-edit'></i><?php echo e(trans('adminlte_lang::message.orderupdate')); ?></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-archive'></i> <span><?php echo e(trans('adminlte_lang::message.certificatemenu')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class='fa fa-list-ul'></i><?php echo e(trans('adminlte_lang::message.certiregister')); ?></a></li>
                        <li><a href="#"><i class='fa fa-search'></i><?php echo e(trans('adminlte_lang::message.certiread')); ?></a></li>
                        <li><a href="#"><i class='fa fa-edit'></i><?php echo e(trans('adminlte_lang::message.certiupdate')); ?></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-archive'></i> <span><?php echo e(trans('adminlte_lang::message.manifiestmenu')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class='fa fa-user-plus'></i><?php echo e(trans('adminlte_lang::message.manifregister')); ?></a></li>
                        <li><a href="#"><i class='fa fa-search'></i><?php echo e(trans('adminlte_lang::message.manifread')); ?></a></li>
                        <li><a href="#"><i class='fa fa-edit'></i><?php echo e(trans('adminlte_lang::message.manifupdate')); ?></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-archive'></i> <span><?php echo e(trans('adminlte_lang::message.multilevel')); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                        <li><a href="#"><?php echo e(trans('adminlte_lang::message.linklevel2')); ?></a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fas fa-truck-moving"></i></i> <span> Vehiculos</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/vehicle/index"><i class="fas fa-list-alt"></i><span>   Listado</span></a></li>
                        <li><a href="/vehicle/create"><i class='fa fa-plus'></i></i>Registro</a></li>
                        <li><a href="/vehicle/programacion"><i class="fas fa-calendar-alt"></i>   Programación</a></li>
                        <li><a href="/vehicle/mantenimiento"><i class="fas fa-tools"></i>   Mantenimiento</a></li>
                        
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fas fa-money-bill-wave"></i></i> <span> Compra</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/compra/orden"><i class="fas fa-file-invoice-dollar"></i><span>   Orden</span></a></li>
                        <li><a href="/compra/cotizacion"><i class="fas fa-file-invoice"></i>   Cotizacion</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fas fa-laptop"></i><span> Activos</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/activos"><i class="fas fa-list-alt"></i><span>  Inventario</span></a></li>
                        <li><a href="/activos/create"><i class='fa fa-plus'></i><span>Añadir</span></a></li>
                    </ul>
                </li>
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
</aside>
