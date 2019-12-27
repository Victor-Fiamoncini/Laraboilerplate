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
            <img src={boxLogo} alt="IFC - Rio do Sul" />
        </a>
        <div class="collapse navbar-collapse" id="mobile-menu">
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="/dashboard">
                            <img
                                src={boxLogo}
                                alt="Logo IFBox"
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
                        <i class="ni ni-app text-primary"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        activeclass="active"
                        class="nav-link"
                        href="/cursos"
                    >
                        <i class="ni ni-book-bookmark text-orange"></i> Cursos
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        activeclass="active"
                        class="nav-link"
                        href="/artigos"
                    >
                        <i class="ni ni-align-center text-info"></i> Artigos
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        activeclass="active"
                        class="nav-link"
                        href="/usuarios"
                    >
                        <i class="ni ni-single-02 text-green"></i> Usuários
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        activeclass="active"
                        class="nav-link"
                        href="/tags"
                    >
                        <i class="fas fa-hashtag text-yellow"></i> Tags
                    </a>
                </li>
            </ul>
            <hr class="my-3" />
            <h6 class="navbar-heading text-muted">Links Úteis</h6>
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
                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <i class="fas fa-file"></i> Site
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
