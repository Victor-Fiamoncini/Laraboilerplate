{{-- Sidebar --}}
<nav
    class="navbar navbar-vertical navbar-light fixed-left navbar-expand-md bg-white shadow"
    id="sidenav-main"
>
    <div class="container-fluid">
        <button
            class="navbar-toggler custom-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#mobile-menu"
            aria-controls="sidenav-main"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <a
            class="text-center"
            href="{{ route('dashboard.profile') }}"
            rel="noopener noreferrer"
        >
            <img
                class="img-fluid"
                src="{{ asset('assets/images/logo-laraboilerplate.png') }}"
                alt="Laraboilerplate"
                title="Laraboilerplate"
            >
        </a>
        <div class="collapse navbar-collapse" id="mobile-menu">
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                       Laraboilerplate
                    </div>
                    <div class="col-6 collapse-close">
                        <button
                            type="button"
                            class="navbar-toggler"
                            data-toggle="collapse"
                            data-target="#mobile-menu"
                            aria-controls="mobile-menu"
                            aria-expanded="false"
                            aria-label="Toggle sidenav"
                        >
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            {{-- Menu --}}
            <ul class="navbar-nav">
                <li class="nav-item {{ isActive('dashboard.profile') }}">
                    <a
                        class="nav-link {{ isActive('dashboard.profile') }}"
                        href="{{ route('dashboard.profile') }}"
                        rel="noopener noreferrer"
                    >
                        <i class="ni ni-single-02 text-yellow"></i> Profile
                    </a>
                </li>
                <li class="nav-item {{ isActive('dashboard.companies') }}">
                    <a
                        class="nav-link {{ isActive('dashboard.companies') }}"
                        href="{{ route('dashboard.companies') }}"
                        rel="noopener noreferrer"
                    >
                        <i class="fas fa-building text-info"></i> Companies
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href=""
                        rel="noopener noreferrer"
                    >
                        <i class="fas fa-rocket text-primary"></i> About
                    </a>
                </li>
            </ul>
            <hr class="mb-0 my-3">
            <h6 class="navbar-heading text-muted">Useful Links</h6>
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="https://github.com/Victor-Fiamoncini"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <i class="fab fa-github-alt"></i> Github
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
