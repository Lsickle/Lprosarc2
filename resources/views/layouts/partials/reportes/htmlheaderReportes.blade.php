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

    {{-- Stilos Personalizados --}}
    <link href="{{ mix('/css/stilosPersonalizados.css') }}" rel="stylesheet" type="text/css" />
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/af-2.3.5/b-1.7.0/b-colvis-1.7.0/b-html5-1.7.0/b-print-1.7.0/cr-1.5.3/date-1.0.3/kt-2.6.1/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.3/datatables.min.css" />
</head>
