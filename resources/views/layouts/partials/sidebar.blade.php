<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            @if (! Auth::guest())
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="../../../images/{{ Auth::user()->UsAvatar }}" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success" class="treeview-menu"></i> {{ trans('adminlte_lang::message.online') }}</a>
                    </div>
                </div>         
            @endif

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
                @if(Auth::user()->id==1)
                <li class="treeview">
                    <a href="#"><i {{-- class='fa fa-id-card' --}} class='fa fa-id-card'></i> <span>{{ trans('adminlte_lang::message.contacts') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/clientes"><i class='fa fa-list-ul'></i>{{ trans('adminlte_lang::message.clientindex') }}</a></li>
                        <li><a href="/clientes/create"><i class='fa fa-user-plus'></i>{{ trans('adminlte_lang::message.clientregister') }}</a></li>
                        {{-- SEDES --}}
                        <li class="treeview">
                          <a href="#"><i class="fa fa-building"></i>Sedes
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            {{-- listado de sedes --}}
                            <li><a href="/sclientes"><i class='fa fa-map'></i>{{ trans('adminlte_lang::message.csedeindex') }}</a></li>
                            {{-- registro de sedes --}}
                            <li><a href="/sclientes/create"><i class='fa fa-map-marked-alt'></i>{{ trans('adminlte_lang::message.csederegister') }}</a></li>
                          </ul>
                        </li>
                        {{-- <li><a href="#"><i class='fa fa-warehouse'></i>{{ trans('adminlte_lang::message.clientupdate') }}</a></li> --}}
                        
                    </ul>
                </li>
                @endif
                <li class="treeview">
                    <a href="#"><i class='fa fa-industry'></i> <span>{{ trans('adminlte_lang::message.genermenu') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/Generadores/"><i class='fa fa-list-ul'></i>{{ trans('adminlte_lang::message.generindex') }}</a></li>
                        <li><a href="/Generadores/create"><i class='fa fa-user-plus'></i>{{ trans('adminlte_lang::message.generregister') }}</a></li>
                        {{-- SEDES --}}
                        <li class="treeview">
                          <a href="#"><i class="fa fa-building"></i>Sede Generador
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            {{-- listado de sedes --}}
                            <li><a href="/sgeneradores"><i class='fa fa-map'></i>{{ trans('adminlte_lang::message.csedeindex') }}</a></li>
                            {{-- registro de sedes --}}
                            <li><a href="/sgeneradores/create"><i class='fa fa-map-marked-alt'></i>{{ trans('adminlte_lang::message.csederegister') }}</a></li>
                          </ul>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fas fa-biohazard'></i> <span>{{ trans('adminlte_lang::langresiduos.residuolisttitle') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/respels"><i class='fa fa-search'></i>{{ trans('adminlte_lang::langresiduos.residuolistitem1') }}</a></li>

                        <li><a href="/respels/create"><i class='fa fa-file-text'></i>{{ trans('adminlte_lang::langresiduos.residuolistitem2') }}</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fas fa-biohazard'></i> <span>Areas</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/areas"><i class='fa fa-search'></i>Listar Areas</a></li>

                        <li><a href="/areas/create"><i class='fa fa-file-text'></i>Crear Areas</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fas fa-biohazard'></i> <span>Oficinas</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/oficces"><i class='fa fa-search'></i>Listar Oficinas</a></li>

                        <li><a href="/oficces/create"><i class='fa fa-file-text'></i>Crear Oficinas</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fas fa-biohazard'></i> <span>Cargos</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/cargos"><i class='fa fa-search'></i>Listar Cargos</a></li>

                        <li><a href="/cargos/create"><i class='fa fa-file-text'></i>Crear Cargos</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-list'></i> <span>{{ trans('adminlte_lang::message.declarationmenu') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/declaraciones"><i class='fa fa-search'></i>{{ trans('adminlte_lang::message.declarread') }}</a></li>

                        <li><a href="/declaraciones/create"><i class='fa fa-file-text'></i>{{ trans('adminlte_lang::message.declarregister') }}</a></li>
                        
                        
                    </ul>
                </li>
                
                <li class="treeview">
                    <a href="#"><i class='fa fa-clipboard-list'></i> <span>{{ trans('adminlte_lang::message.ordermenu') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class='fa fa-plus'></i>{{ trans('adminlte_lang::message.orderregister') }}</a></li>
                        <li><a href="#"><i class='fa fa-search'></i>{{ trans('adminlte_lang::message.orderread') }}</a></li>
                        <li><a href="#"><i class='fa fa-edit'></i>{{ trans('adminlte_lang::message.orderupdate') }}</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-archive'></i> <span>{{ trans('adminlte_lang::message.certificatemenu') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class='fa fa-list-ul'></i>{{ trans('adminlte_lang::message.certiregister') }}</a></li>
                        <li><a href="#"><i class='fa fa-search'></i>{{ trans('adminlte_lang::message.certiread') }}</a></li>
                        <li><a href="#"><i class='fa fa-edit'></i>{{ trans('adminlte_lang::message.certiupdate') }}</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-archive'></i> <span>{{ trans('adminlte_lang::message.manifiestmenu') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class='fa fa-user-plus'></i>{{ trans('adminlte_lang::message.manifregister') }}</a></li>
                        <li><a href="#"><i class='fa fa-search'></i>{{ trans('adminlte_lang::message.manifread') }}</a></li>
                        <li><a href="#"><i class='fa fa-edit'></i>{{ trans('adminlte_lang::message.manifupdate') }}</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-archive'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                        <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    </ul>
                </li>
            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
</aside>
