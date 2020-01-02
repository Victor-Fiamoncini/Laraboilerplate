{{-- Dashboard Header --}}
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        {{-- Brand --}}
        <a
            class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
            href="{{ route('dashboard.index') }}"
        >
            {{ $title }}
        </a>
        {{-- User --}}
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a
                    class="nav-link pr-0"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            @if (!empty(auth()->user()->url_cover_thumb))
                                <img
                                    class="shadow fit-image"
                                    src="{{ auth()->user()->url_cover_thumb  }}"
                                    alt="{{ auth()->user()->name }}"
                                    title="{{ auth()->user()->name }}"
                                >
                            @else
                                <img
                                    class="shadow fit-image"
                                    src="{{ asset('assets/images/avatar.jpg') }}"
                                    alt="Avatar"
                                    title="Avatar"
                                >
                            @endif
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">
                                {{ auth()->user()->name }}
                            </span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>
                    <a
                        class="dropdown-item"
                        href="{{ route('dashboard.user.edit', auth()->user()->id) }}"
                    >
                        <i class="ni ni-single-02"></i>
                        <span>Profile</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a
                        class="dropdown-item"
                        href="{{ route('logout') }}"
                    >
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
