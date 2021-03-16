<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            @if (! Auth::guest())

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
