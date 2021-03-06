<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="skin-blue fixed sidebar-mini sidebar-collapse">
    <div id="app" v-cloak>
        <div class="wrapper">

        @include('layouts.partials.mainheader')

        @include('layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @include('layouts.partials.contentheader')

            <!-- Main content -->
            @include('layouts.partials.loading')
            <section class="content" id="contenido" style="display: none;">
                <!-- Your Page Content Here -->
                @yield('main-content')
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('layouts.partials.controlsidebar')

        @include('layouts.partials.footer')

    </div><!-- ./wrapper -->
</div>  
    @include('layouts.partials.scripts')
    @section('scripts')
    @show
</body>
</html>
