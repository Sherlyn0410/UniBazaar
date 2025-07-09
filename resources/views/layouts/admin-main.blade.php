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
    <div class="d-lg-flex flex-nowrap min-vh-100">
        <!-- Sidebar -->
         <div class="d-none d-lg-block">
            <div class="p-3 bg-white border-end d-flex flex-column" style="width: 280px; min-height: 100vh;">
                <div>
                    <a href="/admin" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                        <img src="{{ asset('assets/img/inti-logo.png') }}" alt="Logo" class="d-inline-block align-text-top" style="height: 70px;">
                    </a>
                    <hr>
                    <!-- User dropdown at the bottom -->
                    <div class="d-flex align-items-center px-3">
                        <span class="border bg-light text-secondary rounded-circle d-flex justify-content-center align-items-center me-2" style="width:32px; height:32px;">
                            <i class="bi bi-person-fill fs-5"></i>
                        </span>
                        <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
                    </div>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{ route('view.admin') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ request()->routeIs('view.admin') ? 'active' : '' }}" aria-current="page">
                                <i class="bi bi-house-door me-2 fs-4" aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view.student') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ (request()->routeIs('view.student') || request()->routeIs('admin.edit.student')) ? 'active' : '' }}">
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
                        <li class="nav-item">
                            <a href="{{ route('admin.reports') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                                <i class="bi bi-flag me-2 fs-4" aria-hidden="true"></i>
                                Report
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mt-auto">
                    <hr>
                    <div class="px-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link link-danger d-flex align-items-center fw-semibold">
                                <i class="bi bi-box-arrow-right me-2 fs-4" aria-hidden="true"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
         </div>
                
        <!-- Sidebar for Mobile-->
        <nav class="navbar navbar-light bg-white border-bottom d-lg-none">
            <div class="container-fluid">
                <a href="/admin" class="navbar-brand d-flex align-items-center">
                    <img src="{{ asset('assets/img/inti-logo.png') }}" alt="Logo" class="d-inline-block align-text-top" style="height: 50px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSidebarNav" aria-controls="mobileSidebarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse w-100" id="mobileSidebarNav">
                <div class="bg-white border-bottom px-3">
                    <div class="d-flex align-items-center px-3 py-2">
                        <span class="border bg-light text-secondary rounded-circle d-flex justify-content-center align-items-center me-2" style="width:32px; height:32px;">
                            <i class="bi bi-person-fill fs-5"></i>
                        </span>
                        <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
                    </div>
                    <hr class="my-1">
                    <ul class="nav nav-pills flex-column mb-2">
                        <li class="nav-item">
                            <a href="{{ route('view.admin') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ request()->routeIs('view.admin') ? 'active' : '' }}" aria-current="page">
                                <i class="bi bi-house-door me-2 fs-4" aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view.student') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ (request()->routeIs('view.student') || request()->routeIs('admin.edit.student')) ? 'active' : '' }}">
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
                        <li class="nav-item">
                            <a href="{{ route('admin.reports') }}" class="nav-link link-body-emphasis d-flex align-items-center {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                                <i class="bi bi-flag me-2 fs-4" aria-hidden="true"></i>
                                Report
                            </a>
                        </li>
                    </ul>
                    <div class="px-3 pb-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link link-danger d-flex align-items-center fw-semibold">
                                <i class="bi bi-box-arrow-right me-2 fs-4" aria-hidden="true"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
</div>
</body>
</html>

<style>
    .nav-pills .nav-link.active {
        background-color: var(--bs-secondary) !important;
        color: #fff !important;
    }
</style>