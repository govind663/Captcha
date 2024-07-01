<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">

                <li class="{{ $currentRoute === 'admin.dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fe fe-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2)
                <li class="{{ ($currentRoute === 'admin.index') || ($currentRoute === 'admin.create') || ($currentRoute === 'admin.edit') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}">
                        <i class="fe fe-user"></i>
                        <span>Manage Admin</span>
                    </a>
                </li>

                <li class="{{ ($currentRoute === 'captcha-type.index') || ($currentRoute === 'captcha-type.create') || ($currentRoute === 'captcha-type.edit') ? 'active' : '' }}">
                    <a href="{{ route('captcha-type.index') }}">
                        <i class="fe fe-clipboard"></i>
                        <span>Captcha Type</span>
                    </a>
                </li>

                <li class="{{ ($currentRoute === 'package-type.index') || ($currentRoute === 'package-type.create') || ($currentRoute === 'package-type.edit') ? 'active' : '' }}">
                    <a href="{{ route('package-type.index') }}">
                        <i class="fe fe-grid"></i>
                        <span>Package Type</span>
                    </a>
                </li>

                <li class="{{ ($currentRoute === 'package.index') || ($currentRoute === 'package.create') || ($currentRoute === 'package.edit') ? 'active' : '' }}">
                    <a href="{{ route('package.index') }}">
                        <i class="fe fe-settings"></i>
                        <span>Manage Package</span>
                    </a>
                </li>

                <li class="{{ ($currentRoute === 'citizen.index') || ($currentRoute === 'citizen.create') || ($currentRoute === 'citizen.edit') ? 'active' : '' }}">
                    <a href="{{ route('citizen.index') }}">
                        <i class="fe fe-users"></i>
                        <span>Manage Citizen</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>
