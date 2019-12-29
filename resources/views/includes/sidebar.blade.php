{{-- Sidebar --}}
<nav
    class="navbar navbar-vertical navbar-light fixed-left navbar-expand-md bg-white"
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
        <a class="text-center" href="{{ route('dashboard.index') }}">
            LaraBoilerPlate
        </a>
        <hr class="mb-0 mt-3">
        <div class="collapse navbar-collapse" id="mobile-menu">
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                       LaraBoilerPlate
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
                <li class="nav-item">
                    <a class="nav-link pt-0 mb-2" href="{{ route('dashboard.index') }}">
                        <i class="ni ni-app text-primary"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="nav-link pt-0 mb-2"
                        href="{{ route('dashboard.user.edit', auth()->user()->id) }}"
                    >
                        <i class="ni ni-single-02 text-yellow"></i> Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
