<head>
    <meta charset="UTF-8">
    <title>@yield('htmlheader_title', 'Your title here')</title>
    <link rel="shortcut icon" href="/img/LogoProsarc.ico">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    
    <link href="{{ mix('/css/all.css') }}" rel="stylesheet" type="text/css" />
     <!-- Dependencias -->
    <link href="{{ mix('/css/dependencias.css') }}" rel="stylesheet" type="text/css">

    @if(Route::currentRouteName()=='vehicle-programacion.create'||Route::currentRouteName()=='programacion-express.create')
        {{-- Full Calendar --}}
         <link href="{{ mix('/css/fullcalendar.css') }}" rel="stylesheet" type="text/css">
    @endif

     {{-- Chart --}}
     <link href="{{ mix('/css/chart.css') }}" rel="stylesheet" type="text/css">

     {{-- Moment --}}
     {{-- <link href="{{ mix('/css/moment.css') }}" rel="stylesheet" type="text/css"> --}}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/datatable-depen.css') }}">

    {{-- plugins de datatables --}}
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/datatable-plugins.css') }}">

    {{-- Stilos Personalizados --}}
    <link href="{{ mix('/css/stilosPersonalizados.css') }}" rel="stylesheet" type="text/css" />
    @if(Route::currentRouteName()=='programacion-express.create')
    {{-- Full Calendar VERDE --}}
    <link href="{{ mix('/css/calendarioPersonalizado.css') }}" rel="stylesheet" type="text/css" />
    @endif

    {{-- fuentes de google --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
    {{-- script de idioma --}}
    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
            // echo $trans;
        @endphp
    </script>
    
    {{-- script para validar si javascript esta desactivado en el navegador --}}
    <noscript>
        <META HTTP-EQUIV="Refresh" CONTENT="0;URL=../noscriptpage">
        {{-- @include('layouts.partials.noscript') --}}
    </noscript>
</head>
