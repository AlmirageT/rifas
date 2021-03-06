<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="{{ url('/administrador') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{  asset('images/variantes logo rifopoly-07.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/variantes logo rifopoly-05.png') }}" alt="" height="55">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{--  <img class="rounded-circle header-profile-user" src="{{ asset('assets/img/avatar/usergeneric.png') }}"
                        alt="Header Avatar">--}}
                    <span class="d-none d-xl-inline-block ml-1">{{ Session::get('nombreUsuario') }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                     
                    <form action="{{ asset('logout') }}" method="post">
                        @csrf
                        <button class="dropdown-item text-danger" type="submit"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</button>
                    </form>
                </div>
            </div>
           {{-- <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="bx bx-cog bx-spin"></i>
                    </button>
                </div> --}}
        </div>
    </div>
</header>