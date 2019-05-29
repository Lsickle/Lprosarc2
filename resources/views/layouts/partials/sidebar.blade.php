<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            @if (! Auth::guest())
                <div class="user-panel">
                    <div class="pull-left image">
                        @if(file_exists(public_path().'/img/ImagesProfile/'.Auth::user()->UsAvatar) && Auth::user()->UsAvatar <> null)
                            <img class="img-circle" src="../../../img/ImagesProfile/{{Auth::user()->UsAvatar }}" alt="User Image">
                        @else
                            <img class="img-circle" src="../../../img/default.png" alt="User Image">
                        @endif
                    </div>
                    <div class="pull-left info">
                        <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success" class="treeview-menu"></i> {{ trans('adminlte_lang::message.online') }} ({{ Auth::user()->UsRol }})</a>
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
            {{-- SideBar --}}
            {{-- @if (Auth::user()->UsRol == "Cliente" || Auth::user()->UsRol == "admin") --}}
                
                {!! Menu::sidebar() !!}
            {{-- @endif --}}
            {{-- /SideBar --}}

        </section>
        <!-- /.sidebar -->
</aside>
