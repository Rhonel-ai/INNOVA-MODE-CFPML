<!-- NAVIGATION -->
<nav id="mainNavbar" class="navbar navbar-vertical navbar-expand-lg scrollbar bg-dark navbar-dark">

    <!-- Theme configuration (navbar) -->
    <script>
    let navigationColor = localStorage.getItem('navigationColor'),
        navbar = document.getElementById('mainNavbar');

    if (navigationColor != null && navbar != null) {
        if (navigationColor == 'inverted') {
            navbar.classList.add('bg-dark', 'navbar-dark');
            navbar.classList.remove('bg-white', 'navbar-light');
        } else {
            navbar.classList.add('bg-white', 'navbar-light');
            navbar.classList.remove('bg-dark', 'navbar-dark');
        }
    }
    </script>
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand" href="{{route('dashboard')}}">
            <img src="{{ asset('admin/assets/images/logo-small.svg') }}" class="navbar-brand-img logo-light logo-small"
                alt="..." width="19" height="25">
            <img src="{{ asset('admin/assets/images/logo.svg') }}" class="navbar-brand-img logo-light logo-large"
                alt="..." width="125" height="25">

            <img src="{{ asset('admin/assets/images/logo-dark-small.svg') }}"
                class="navbar-brand-img logo-dark logo-small" alt="..." width="19" height="25">
            <img src="{{ asset('admin/assets/images/logo-dark.svg') }}" class="navbar-brand-img logo-dark logo-large"
                alt="..." width="125" height="25">
        </a>

        <!-- Navbar toggler -->
        <a href="javascript: void(0);" class="navbar-toggler" data-bs-toggle="collapse"
            data-bs-target="#sidenavCollapse" aria-controls="sidenavCollapse" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenavCollapse">

            <!-- Navigation -->
            <ul class="navbar-nav mb-lg-7">
                <li class="nav-item dropdown">
                    <a class="nav-link active" href="/" data-bs-toggle="collapse" role="button" aria-expanded="true"
                        aria-controls="dashboardsCollapse">
                        <svg viewbox="0 0 24 24" class="nav-link-icon" height="18" width="18"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.753,13.944v8.25h6v-6a1.5,1.5,0,0,1,1.5-1.5h1.5a1.5,1.5,0,0,1,1.5,1.5v6h6v-8.25"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="1.5"></path>
                            <path d="M.753,12.444,10.942,2.255a1.5,1.5,0,0,1,2.122,0L23.253,12.444" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                            </path>
                        </svg>
                        <span>Home</span>
                    </a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#pagesCollapse" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="pagesCollapse">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" class="nav-link-icon" height="18"
                            width="18">
                            <defs>
                                <style>
                                .a {
                                    fill: none;
                                    stroke: currentColor;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                    stroke-width: 1.5px;
                                }
                                </style>
                            </defs>
                            <title>common-file-double-1</title>
                            <path class="a" d="M17.25,23.25H3.75a1.5,1.5,0,0,1-1.5-1.5V5.25"></path>
                            <rect class="a" x="5.25" y="0.75" width="16.5" height="19.5" rx="1" ry="1"></rect>
                        </svg>
                        <!-- <i class="fa fa-user-shiel"></i> -->
                        <span>Administrateur</span>
                    </a>
                    <div class="collapse " id="pagesCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link ">
                                    <span>Roles</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link ">
                                    <span>Utilisateur</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link ">
                                    Parametre </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pages.activities.index') }}" class="nav-link ">
                                    <span>Journalisations</span>
                                </a>
                            </li>
                            <li class="nav-item">

                            </li>
                            <li class="nav-item">
                                <a href="{{ route('header.index')}}" class="nav-link ">
                                    <span>header</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('candidates.create') }}" class="nav-link ">
                                    <span>Créer un candidat</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <!-- End of Navigation -->

                <!-- Info box -->
                <div class="help-box rounded-3 py-5 px-4 text-center mt-auto">
                    <img src="assets/images/illustrations/upgrade-illustration.svg" alt="..." class="img-fluid mb-4"
                        width="160" height="160">
                    <h6>Upgrade to explore<br> <span class="emphasize">premium</span> features</h6>

                    <!-- Button -->
                    <a class="btn w-100 btn-sm btn-primary" href="javascript: void(0);">Upgrade to Business</a>
                </div>
        </div>
        <!-- End of Collapse -->
    </div>
</nav>
<!-- MAIN CONTENT -->