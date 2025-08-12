<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('index') }}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="has-arrow waves-effect">
                        <i class="ti-layout-tab-v"></i>
                        <span> Customers </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{--  --}}
                    </ul><li><a href="{{ route('client-logos.index') }}">Projects</a></li>
                        <li><a href="{{ route('client-logos.index') }}">Client Logos</a></li>
                </li>


                <li>
                    <a href="{{ route('settings.index') }}" class="waves-effect">
                        <i class="ti-settings"></i>
                        <span>Settings</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
