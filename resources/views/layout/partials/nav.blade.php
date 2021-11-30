<nav class="navbar navbar-expand-md navbar-dark bg-dark container-fluid">
    <a class="navbar-brand" href="/">PiStore</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNavbar">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('login') }}">Login</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-circle fa-lg"></i></a>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
            @if(Auth::user())
                <li><span class="dropdown-item">{{ Auth::user()->name }}</span></li>
                @if(Session::has('customer') && Session::get('customer')->is_admin)
                    <li><a class="dropdown-item" href="/admin/dashboard">Dashboard</a></li>
                @endif
                <li><form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form></li>
            @else
                <li><a class="dropdown-item"  href="{{ URL::to('register') }}">Register</a></li>
            @endif
        </ul>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/shopping_cart">Shopping cart</a>
        </li>
    </ul>
    <form class="d-flex" action='/search'>
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn purple-btn" type="submit" id="searchButton">Search</button>
    </form>
    </div>
</nav>