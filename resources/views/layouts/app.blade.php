<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Подключение FontAwesome через CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap 5 JS (for dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('user/assets/images/logo/favicon.png') }}" type="image/x-icon">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('user/assets/css/animate-3.7.0.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/font-awesome-4.7.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/bootstrap-4.1.3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/owl-carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
</head>
<body>
    <div id="app">
        <header class="header-area" style="margin-bottom: 200px">

            <div id="header" id="home">
                <div class="container">
                    <div class="row align-items-center justify-content-between d-flex">
                        <div id="logo">
                            <a href=""><img src="{{ asset('user/assets/images/logo/logo.png') }}" alt="" title="" /></a>
                        </div>
                        <nav id="nav-menu-container">
                            <ul class="nav-menu"  style="margin-left:500px;margin-top: 10px">
                                <li class="menu-active"><a href="/">Home</a></li>
                                <li><a href="{{ route('chat') }}">departments</a></li>
                                <li><a href="{{ route('contactt.index') }}">Contact</a></li>
                                @auth
                                    <li><a href="{{ url('/chat/' . auth()->user()->id) }}">Chats</a></li>
                                @else
                                    <!-- Здесь будет ссылка на страницу для авторизации -->
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                @endauth

                            @guest
                                    @if (Route::has('login'))
                                        <li>
                                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li>
                                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="menu-has-children">
                                        <a href="#" role="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                            </li>
                                            @if(auth()->user()->role->name === 'admin')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('users') }}">Admin Panel</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                            </li>
                                        </ul>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endguest
                            </ul>
                        </nav><!-- #nav-menu-container -->
                    </div>
                </div>
            </div>
        </header>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Javascript -->
    <script src="{{ asset('user/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/bootstrap-4.1.3.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/owl-carousel.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/superfish.min.js') }}"></script>
    <script src="{{ asset('user/assets/js/main.js') }}"></script>
</body>
</html>
