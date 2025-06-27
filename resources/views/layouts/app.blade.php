<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Manajemen Kendaraan') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts (Vite) -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (wajib sebelum Select2 JS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JS Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        body {
            background-color: #181a1b;
            color: #e0e0e0;
        }
        .navbar, .navbar-brand, .dropdown-menu {
            background-color: #23272b !important;
            color: #e0e0e0 !important;
        }
        .navbar .nav-link, .navbar .navbar-brand, .dropdown-menu .dropdown-item {
            color: #e0e0e0 !important;
        }
        .navbar .nav-link:hover, .dropdown-menu .dropdown-item:hover {
            color: #fff !important;
            background: #343a40 !important;
        }
        .sidebar {
            height: 100vh;
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #23272b;
            padding-top: 70px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        }
        .sidebar a {
            padding: 10px 20px;
            display: block;
            color: #e0e0e0;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar a:hover {
            background-color: #343a40;
            color: #fff;
        }
        .main-content {
            margin-left: 220px;
            padding: 20px;
            background-color: #181a1b;
            min-height: 100vh;
        }
        .form-control, .select2-container--default .select2-selection--single {
            background-color: #23272b !important;
            color: #e0e0e0 !important;
            border-color: #343a40 !important;
        }
        .form-control:focus, .select2-container--default .select2-selection--single:focus {
            background-color: #181a1b !important;
            color: #fff !important;
            border-color: #495057 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #e0e0e0 !important;
        }
        .select2-container--default .select2-selection--single {
            background-color: #23272b !important;
            border-color: #343a40 !important;
        }
        .select2-dropdown {
            background-color: #23272b !important;
            color: #e0e0e0 !important;
        }
        .select2-results__option--highlighted {
            background-color: #343a40 !important;
            color: #fff !important;
        }
        /* Scrollbar styling for dark theme */
        ::-webkit-scrollbar {
            width: 8px;
            background: #23272b;
        }
        ::-webkit-scrollbar-thumb {
            background: #343a40;
            border-radius: 4px;
        }
        /* Table dark theme */
        .table-dark, .table-dark th, .table-dark td {
            background-color: #23272b;
            color: #e0e0e0;
        }
        .table-dark th {
            border-color: #343a40;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Sistem Manajemen Kendaraan
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name ?? Auth::user()->username }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth
        <div class="sidebar">
            <a href="{{ url('/home') }}">Dashboard</a>
            @role('admin')
                <a href="{{ route('users.index') }}">Manajemen User</a>
                <a href="{{ route('regions.index') }}">Data Lokasi/Region</a>
                <a href="{{ route('kendaraans.index') }}">Data Kendaraan</a>
                <a href="{{ route('drivers.index') }}">Data Driver</a>
                <a href="{{ route('bookings.index') }}">Pemesanan Kendaraan</a>
            @endrole

            @hasanyrole('approval')
                <a href="{{ route('approvals.index') }}">Persetujuan Pemesanan</a>
            @endhasanyrole

            <a href="{{ route('vehicle_usage.index') }}">Riwayat Pemakaian</a>
            <a href="{{ route('laporan.index') }}">Laporan Pemakaian</a>
            <a href="{{ route('log') }}">Log Aktivitas</a>
        </div>
        @endauth

        <main class="py-4 @auth main-content @endauth" style="margin-top: 50px;">
            @yield('content')
        </main>
        @yield('scripts')
    </div>
</body>
</html>
