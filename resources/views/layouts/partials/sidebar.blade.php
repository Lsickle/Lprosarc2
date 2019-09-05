<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            @if (! Auth::guest())
                <div class="user-panel container">
                    <div class="pull-left image" style="max-width: 3.2em; max-height: 3.2em;">
                        @if(file_exists(public_path().'/img/ImagesProfile/'.Auth::user()->UsAvatar) && Auth::user()->UsAvatar <> null)
                            <img class="img-circle" src="../../../img/ImagesProfile/{{Auth::user()->UsAvatar }}" alt="User Image">
                        @else
                            <img class="img-circle" src="../../../img/defaultuser.png" alt="User Image">
                        @endif
                    </div>
                    <div class="pull-left info" style="overflow:hidden; max-width: 10em; max-height: 3.1em; height: auto; width: auto; position: absolute; top: 0.5em;">
                        <p style=" overflow:hidden; text-overflow: ellipsis;" data-toggle="tooltip" title="{{ Auth::user()->name }}"><span>{{ Auth::user()->name }}</span></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success" class="treeview-menu"></i><span> {{ Auth::user()->UsRol }}</span></a>
                    </div>
                </div>         
            @endif

            <!-- search form (Optional) -->
            {{-- <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                </div>
            </form> --}}
            <!-- /.search form -->
            {{-- SideBar --}}
            {{-- @if (Auth::user()->UsRol == "Cliente" || Auth::user()->UsRol == "admin") --}}
                
                {!! Menu::sidebar() !!}
            {{-- @endif --}}
            {{-- /SideBar --}}

        </section>
        <!-- /.sidebar -->
</aside>
