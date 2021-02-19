<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link rel="icon" 
    type="image/png" 
    href="{{url('storage/logo_svira_app.png')}}"">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex text-dark" href="{{ url('/home') }}">
                    {{--<div class="image-app">
                        <img src="{{url('storage/logo_svira_app.png')}}" alt="SVIRA" >
                    </div>--}}
                    
                    <div class="title-app">
                        <strong class="text-secondary">Sistema de Vacunación Integral<br> Registro y Alertas</strong> 
                    </div>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                    </svg>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLbl" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{Auth::user()->email}} </a>
                            <div class="dropdown-menu dropdown-menu-right w-auto shadow p-0" id="navbarDropdown" aria-labelledby="navbarDropdownLbl">
                                @guest
                                    @if (Route::has('login'))
                                        <a class="dropdown-item d-flex flex-nowrap align-items-center px-0 py-3" target="new" rel="nofollow" href="{{ route('login')}}">
                                            <div class="flex-shrink-1 text-center  px-3"><i class="ion-ios-jet-outline h1"></i></div>
                                            <div class="pl-0 pr-4">
                                                <h6 class="mb-0">{{ __('Login') }}</h6>
                                            </div>
                                        </a>
                                       
                                    @endif
                                    
                                    @if (Route::has('register'))
                                        <a class="dropdown-item d-flex flex-nowrap align-items-center px-0 py-3" target="new" rel="nofollow" href="{{ route('register')}}">
                                            <div class="flex-shrink-1 text-center  px-3"><i class="ion-ios-jet-outline h1"></i></div>
                                            <div class="pl-0 pr-4">
                                                <h6 class="mb-0">{{ __('Login') }}</h6>
                                            </div>
                                        </a>
                                    @endif
                                @else
                                    <a class="dropdown-item d-flex flex-nowrap align-items-center px-0 py-3"  href="{{route('profile')}}">
                                        <div class="flex-shrink-1 text-center  px-3"><i class="ion-ios-jet-outline h1"></i></div>
                                        <div class="pl-0 pr-4">
                                            <h6 class="mb-0">Perfil</h6>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex flex-nowrap align-items-center px-0 py-3" href="{{route('vaccine')}}">
                                        <div class="flex-shrink-1 text-center  px-3"><i class="ion-ios-cube-outline h1"></i></div>
                                        <div class="pl-0 pr-4">
                                            <h6 class="mb-0">Vacunas</h6>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex flex-nowrap align-items-center px-0 py-3"  href="{{route('allergie')}}">
                                        <div class="flex-shrink-1 text-center  px-3"><i class="ion-ios-cloud-download-outline h1"></i></div>
                                        <div class="pl-0 pr-4">
                                            <h6 class="mb-0">Alergias y enfermedades</h6>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex flex-nowrap align-items-center px-0 py-3"  href="{{route('medicalappointment')}}">
                                        <div class="flex-shrink-1 text-center  px-3"><i class="ion-ios-cloud-download-outline h1"></i></div>
                                        <div class="pl-0 pr-4">
                                            <h6 class="mb-0">Citas medicas</h6>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex flex-nowrap align-items-center px-0 py-3"  href="{{route('chat')}}">
                                        <div class="flex-shrink-1 text-center  px-3"><i class="ion-ios-cloud-download-outline h1"></i></div>
                                        <div class="pl-0 pr-4">
                                            <h6 class="mb-0">Teleconsulta y chat</h6>
                                        </div>
                                    </a>

                                    <a class="dropdown-item d-flex flex-nowrap align-items-center px-0 py-3" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <div class="flex-shrink-1 text-center px-3"><i class="ion-ios-color-palette-outline h1"></i></div>
                                        <div class="pl-0 pr-4">
                                            <h6 class="mb-0">Cerrar sesión</h6>
                                        </div>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none font-weight-bold">
                                        @csrf
                                    </form>
                                @endguest
                                
                            </div>
                        </li>
                    </ul>

                  
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    
    @stack('scripts')
</body>
</html>
