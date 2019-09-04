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
            #contenedor_carga>center{
                transform: scale(1);
            }
        }
        @media screen and (max-width:1024px) and (min-width:640px) {
            .g-recaptcha {
                /*transform:scale(0.6);*/
                transform-origin:0 0;
            }
            #contenedor_carga>center{
                transform: scale(1.5);
                margin-right: 0;
            }
        }
        @media screen and (min-width:1024px) {
            .g-recaptcha {
                /*transform:scale(1.049615);*/
                transform-origin:0 0;
            }
            #contenedor_carga>center{
                transform: scale(2);
                margin-top: 15%;
                margin-right: 0;
            }
        }
        #contenedor_carga{
            background-image: linear-gradient(#003152,#003152,#008eda);
        }

        
        .loader {
          /*position: absolute;*/
          margin-left: 1em;
          float: right;
          top: calc(50% - 12px);
          left: calc(50% - 12px);
          width: 24px;
          height: 24px;
          border-radius: 50%;
          perspective: 800px;
        }

        .inner {
          position: absolute;
          box-sizing: border-box;
          width: 100%;
          height: 100%;
          border-radius: 50%;  
        }

        .one {
          left: 0%;
          top: 0%;
          animation: rotate-one 1s linear infinite;
          border-bottom: 3px solid #EAECFF;
        }

        .two {
          right: 0%;
          top: 0%;
          animation: rotate-two 1s linear infinite;
          border-right: 3px solid #85FF93;
        }

        .three {
          right: 0%;
          bottom: 0%;
          animation: rotate-three 1s linear infinite;
          border-top: 3px solid #0505FF;
        }

        @keyframes rotate-one {
          0% {
            transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
          }
          100% {
            transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
          }
        }

        @keyframes rotate-two {
          0% {
            transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
          }
          100% {
            transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
          }
        }

        @keyframes rotate-three {
          0% {
            transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
          }
          100% {
            transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
          }
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
    {!! NoCaptcha::renderJs('es') !!}
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
            var loginButton = document.getElementById('mySubmitButton');
            $('#contenedor_carga').css('opacity', '0');
            $('#contenido').fadeIn(2000);
            setTimeout(function(){
                $('#contenedor_carga').remove();
            }, 2000);
            var input = document.getElementById('email');
            var ancho = input.offsetWidth;
            var scala = (ancho / (304));
            var capchita = document.getElementsByClassName('g-recaptcha')[0];
            capchita.style.transform = "scale("+scala+")";
            loginButton.removeAttribute("disabled");
        };
    </script>
    {{-- script para deshabilitar el boton submit cuando se envia el formaulario --}}
    <script type="text/javascript">
      var wasSubmitted = false;    
        function checkBeforeSubmit(){
          if(!wasSubmitted) {
            wasSubmitted = true;
            return wasSubmitted;
          }
          return false;
        }
        function disabledLoginButton() {
            var loginButton = document.getElementById('mySubmitButton');
            var a = document.forms["LoginForm"]["email"].value;
            var b = document.forms["LoginForm"]["password"].value;
            if (a !== null && a !== "", b !== null && b !== "") {
                if (validateEmail(a)) {
                    document.getElementById("mySubmitButton").innerHTML = "<div class='loader'><div class='inner one'></div><div class='inner two'></div><div class='inner three'></div></div> Iniciando";
                    loginButton.setAttribute("disabled", true);
                    /*se envia el formulario con js para que la funcion sirve en google chrome*/
                    document.forms["LoginForm"].submit();
                }
            }
        } 
        function validateEmail(email) {
          var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return re.test(email);
        }
    </script>
</body>
</html>
