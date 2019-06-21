<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="/img/LogoProsarc.ico">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Stilos Personalizados --}}
    <link href="{{ mix('/css/stilosPersonalizados.css') }}" rel="stylesheet" type="text/css" />

    <style type="text/css">
        body {
           background-image: linear-gradient(#003152,#003152,#008eda);
        }
        .navbar {
            background-color: #3c8dbc;
        }
        .nav-link, .logo-lg{
            color: #fff !important;
            font-size: 1.3em !important;
        }
        .justify-content-center{
            margin-top: 8%;
        }
        .in {
          display: block !important;
        }        
        @media screen and (max-width:640px) {
            .g-recaptcha {
                /*transform:scale(0.8);*/
                transform-origin:0 0;
            }
        }
        @media screen and (max-width:1024px) and (min-width:640px) {
            .g-recaptcha {
                /*transform:scale(0.6);*/
                transform-origin:0 0;
            }
            #Superior{
                margin-right: 0;
            }
            #Derecho{
                margin-right: 0;
            }
            #Izquierdo{
                margin-right: 0;
            }
            #Inferior1{
                margin-right: 0;
            }
            #Inferior2 {
                margin-right: 0;
            }
        }
        @media screen and (min-width:1024px) {
            .g-recaptcha {
                /*transform:scale(1.049615);*/
                transform-origin:0 0;
            }
            #Superior{
                margin-right: 0;
            }
            #Derecho{
                margin-right: 0;
            }
            #Izquierdo{
                margin-right: 0;
            }
            #Inferior1{
                margin-right: 0;
            }
            #Inferior2 {
                margin-right: 0;
            }
        }
        #contenedor_carga{
            background-image: linear-gradient(#003152,#003152,#008eda);
        }
    </style>
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
    <noscript>
        <META HTTP-EQUIV="Refresh" CONTENT="0;URL=../noscriptpage">
        {{-- @include('layouts.partials.noscript') --}}
    </noscript>
    {!! NoCaptcha::renderJs() !!}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <span class="logo-lg"><b>{{ config('app.name') }}</b><img src="/img/LogoProsarc.png" style="width: 1.8em; margin: 5px; border-radius: 50%;"></span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ trans('adminlte_lang::message.login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ trans('adminlte_lang::message.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ trans('adminlte_lang::message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @include('layouts.partials.loading')
        <main class="container" id="contenido" style="display: none;">
            @yield('content')
        </main>
    </div>
    <script>
        window.onload = function(){ 
            // $('#contenedor_carga').css('opacity', '0');
            // $('#contenido').fadeIn(2000);
            setTimeout(function(){
                // $('#contenedor_carga').remove();
            }, 2000);
            var input = document.getElementById('email');
            var ancho = input.offsetWidth;
            var scala = (ancho / (304));
            var capchita = document.getElementsByClassName('g-recaptcha')[0];
            capchita.style.transform = "scale("+scala+")";
        };
    </script>

</body>
</html>
