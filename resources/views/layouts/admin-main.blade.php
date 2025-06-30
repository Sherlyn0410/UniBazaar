<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'UniBazaar') }} Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=dashboard" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body class="font-sans antialiased bg-light">
    <main class="d-flex flex-nowrap min-vh-100">
        <!-- Sidebar -->
        <div class="flex-shrink-0 p-3 bg-white border-end d-flex flex-column" style="width: 280px; min-height: 100vh;">
            <div>
                <a href="/admin" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <img src="{{ asset('assets/img/inti-logo.png') }}" alt="Logo" class="d-inline-block align-text-top" style="height: 70px;">
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="{{ route('view.admin') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ request()->routeIs('view.admin') ? 'active' : '' }}" aria-current="page">
                            <i class="bi bi-house-door me-2 fs-4" aria-hidden="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('view.student') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ request()->routeIs('view.student') ? 'active' : '' }}">
                            <i class="bi bi-person me-2 fs-4" aria-hidden="true"></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('view.product') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ request()->routeIs('view.product') ? 'active' : '' }}">
                            <i class="bi bi-list me-2 fs-4" aria-hidden="true"></i>
                            Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('view.order') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ request()->routeIs('view.order') ? 'active' : '' }}">
                            <i class="bi bi-bag me-2 fs-4" aria-hidden="true"></i>
                            Orders
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mt-auto">
                <hr>
                <!-- User dropdown at the bottom -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>Admin</strong>
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        <li>
                            <a class="dropdown-item" href="#">Settings</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Profile</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </main>
</body>
</html>

<style>
    .nav-pills .nav-link.active {
        background-color: var(--bs-secondary) !important;
        color: #fff !important;
    }
</style>