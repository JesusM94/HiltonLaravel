<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>.:Hilton:.</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <div class="col-md-12 col-sm-12 col-xs-12" style="background-color:#0d47a1;">

            <div class="text-center">
                <img src="img/ph_logo_hilton.png" class="rounded" alt="thumbnail" width="200" height="100">
            </div>

            <nav class="navbar navbar-dark default-color">
                  
                <div class="d-flex justify-content-around text-white">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Hilton
                    </a>
                </div>
                <!--<div class="d-flex justify-content-around text-white">
                    @guest
                    <span class="text-center" style="color:#0d47a1;">____</span>
                    <span>GARANTIZAMOS MEJOR PRECIO EN MEXICO</span>
                    @else
                    <span class="text-center" style="color:#0d47a1;">____________</span>
                    <span>GARANTIZAMOS MEJOR PRECIO EN MEXICO</span>
                    @endguest
                </div>-->
                <div class="d-flex justify-content-around text-white">
                    
                    <span>GARANTIZAMOS MEJOR PRECIO EN MEXICO</span>
                    
                </div>
                <div class="d-flex justify-content-around text-white">

                    @guest
                    <a class="btn btn-outline-success btn-rounded waves-effect text-white" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                    <span class=""></span>&nbsp;

                    @else

                    <div class="dropdown">
                        <button class="btn btn-flat dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Salir') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>

                    @endguest
                </div>

            </nav>

        </div>

        <main class="justify-content-center">
            <menu-component></menu-component>
            @yield('content')
        </main>
        <footer-component></footer-component>
    </div>
</body>
</html>
