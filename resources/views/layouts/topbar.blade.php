<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                @php
                    $baseUrl = url('/index');
                @endphp
                <a href="{{ $baseUrl }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <x-mobile-logo />
                    </span>
                    <span class="logo-lg">
                        <x-desktop-logo />
                    </span>
                </a>

                <a href="{{ $baseUrl; }}" class="logo logo-light">
                    <span class="logo-sm">
                        <x-mobile-logo />
                    </span>
                    <span class="logo-lg">
                        <x-desktop-logo />
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn" aria-label="Vertical Menu Button">
                <i class="mdi mdi-menu"></i>
            </button>


        </div>

        <div class="d-flex">


            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen" aria-label="fullscreen button">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="user dropdown">
                    {!! get_user_profile_image(Auth::user()->id) !!}
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="mdi mdi-account-circle font-size-17 align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('settings.index') }}"><i class="mdi mdi-cog font-size-17 align-middle me-1"></i> Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-17 align-middle me-1 text-danger"></i>
                        {{ __('Logout') }} </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>


        </div>
    </div>
</header>
