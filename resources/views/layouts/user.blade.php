<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <!-- AOS Animate On Scroll CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/progress-bar.css') }}">
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-user-gradient shadow mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tun Rice Milling</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="userNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link m-2 text-center {{ request()->routeIs('users.dashboard') ? 'active' : '' }}" href="{{ route('users.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link m-2 text-center {{ request()->routeIs('users.paddies.*') ? 'active' : '' }}" href="{{ route('users.paddies.index') }}">Paddies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link m-2 text-center {{ request()->routeIs('users.appointments.*') ? 'active' : '' }}" href="{{ route('users.appointments.index') }}">Appointments</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mb-1" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-center" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item border-0 text-center"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @hasSection('header')
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="mt-4">@yield('header')</h2>
                </div>
            </div>
        @endif
        @yield('content')
    </div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- AOS Animate On Scroll JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, 
            once: false,    // Animates only once
            offset: 150,    
            delay: 100,   
            easing: 'ease-in-out', // Smoother, less dramatic easing
            anchorPlacement: 'top-bottom'
        });
    </script>
    @yield('scripts')

    <footer class="text-center text-white py-3 mt-5 border-top navbar-user-gradient">
        &copy; {{ date('Y') }} Tun Rice Milling. All rights reserved.
    </footer>
</body>
</html> 