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
        <a class="navbar-brand p-0 m-0 mt-2" href="/dashboard">
            <img
                src=""
                alt=""
            >
        </a>
        <div class="collapse navbar-collapse" id="mobile-menu">
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="/dashboard">
                            <img
                                src=""
                                alt=""
                            >
                        </a>
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
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a
                        activeclass="active"
                        class="nav-link"
                        href="/dashboard"
                    >
                        <i class="ni ni-app text-primary"></i> Clientes
                    </a>
                </li>
            </ul>
            <hr class="my-3">
        </div>
    </div>
</nav>
