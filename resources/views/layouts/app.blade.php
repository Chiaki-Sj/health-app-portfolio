<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm"
     style="background: linear-gradient(90deg, #667eea, #764ba2);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" height="30">
            <span class="ms-2 fw-bold text-white">HealthApp</span>
        </a>

        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('food-records.index') }}">
                    <i class="fas fa-utensils me-1"></i> Food
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('exercise-records.index') }}">
                    <i class="fas fa-dumbbell me-1"></i> Exercise
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">
                        <i class="fas fa-user-plus me-1"></i> Register
                    </a>
                </li>
            @else
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('profile.show', Auth::user()->id) }}">
                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                </a>
            </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>




        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
