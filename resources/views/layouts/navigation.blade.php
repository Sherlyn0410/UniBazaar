<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container justify-content-between">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('main') }}">
            <img src="{{ asset('assets/img/inti-logo.png') }}" alt="Logo" class="d-inline-block align-text-top" style="height: 70px;">
        </a>

        <!-- Hamburger (for mobile view) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links and Search -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mb-2 mb-lg-0 m-auto">
                <!-- Search Bar -->
                <li class="me-4">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" name="query" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link {{ request()->routeIs('marketplace') ? 'active' : '' }}" href="{{ route('marketplace') }}">{{ __('Marketplace') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.upload') ? 'active' : '' }}" href="{{ route('products.upload') }}">{{ __('Sell') }}</a>
                </li>
            </ul>

            <!-- Shopping Cart and Message Icons -->
            <div class="d-flex align-items-center">
                <a class="me-4 text-decoration-none text-secondary">
                    <i class="bi bi-cart" style="font-size: 1.5rem;"></i>
                </a>
                <a class="me-5 text-decoration-none text-secondary">
                    <i class="bi bi-envelope" style="font-size: 1.5rem;"></i>
                </a>

                <!-- Settings Dropdown -->
                <div class="dropdown">
                    <button class="btn dropdown-toggle p-0 bg-transparent border-0 shadow-none" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end mt-3" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
