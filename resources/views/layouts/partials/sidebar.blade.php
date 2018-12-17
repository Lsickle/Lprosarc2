<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            @if (! Auth::guest())
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
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
                <li class="treeview">
                    <a href="#"><i class='fa fa-id-card'></i> <span>{{ trans('adminlte_lang::message.clientmenu') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="../clientes"><i class='fa fa-plus-square'></i>{{ trans('adminlte_lang::message.clientindex') }}</a></li>
                        <li><a href="../clientes/create"><i class='fa fa-plus-square'></i>{{ trans('adminlte_lang::message.clientregister') }}</a></li>
                        <li><a href="#"><i class='fa fa-edit'></i>{{ trans('adminlte_lang::message.clientupdate') }}</a></li>
                        <li><a href="../sclientes/create"><i class='fa fa-map'></i>{{ trans('adminlte_lang::message.csederegister') }}</a></li>
                        <li><a href="#"><i class='fa fa-map-marker'></i>{{ trans('adminlte_lang::message.csedeupdate') }}</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-industry'></i> <span>{{ trans('adminlte_lang::message.genermenu') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="../generadores/create"><i class='fa fa-user-plus'></i>{{ trans('adminlte_lang::message.generregister') }}</a></li>
                        <li><a href="#"><i class='fa fa-edit'></i>{{ trans('adminlte_lang::message.generupdate') }}</a></li>
                        <li><a href="../sgeneradores/create"><i class='fa fa-map'></i>{{ trans('adminlte_lang::message.gsederegister') }}</a></li>
                        <li><a href="#"><i class='fa fa-map-marker'></i>{{ trans('adminlte_lang::message.gsedeupdate') }}</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-list'></i> <span>{{ trans('adminlte_lang::message.declarationmenu') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class='fa fa-file-text'></i>{{ trans('adminlte_lang::message.declarregister') }}</a></li>
                        <li><a href="#"><i class='fa fa-search'></i>{{ trans('adminlte_lang::message.declarread') }}</a></li>
                        <li><a href="#"><i class='fa fa-trash'></i>{{ trans('adminlte_lang::message.decladelete') }}</a></li>
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
