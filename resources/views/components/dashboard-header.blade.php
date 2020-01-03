{{-- Dashboard Header --}}
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        {{-- Brand --}}
        <a
            class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
            href="{{ route('dashboard.profile') }}"
            rel="noopener noreferrer"
        >
            {{ $title }}
        </a>
        {{-- User Menu --}}
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a
                    class="nav-link pr-0"
                    href=""
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                    rel="noopener noreferrer"
                >
                    <div class="media align-items-center">
                        <span class="avatar avatar-md rounded-circle">
                            <img
                                class="shadow fit-image"
                                src="{{ Auth::user()->url_cover }}"
                                alt="{{ Auth::user()->name }}"
                                title="{{ Auth::user()->name }}"
                            >
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">
                                {{ Auth::user()->name }}
                            </span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a
                        class="dropdown-item"
                        href="{{ route('dashboard.profile', Auth::user()->id) }}"
                        rel="noopener noreferrer"
                    >
                        <i class="ni ni-single-02 text-yellow"></i>
                        <span>Profile</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a
                        class="dropdown-item"
                        href="{{ route('logout') }}"
                        rel="noopener noreferrer"
                    >
                        <i class="ni ni-user-run text-dark"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
