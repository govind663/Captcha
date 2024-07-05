<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sidebar-vertical">

                <li class="{{ $currentRoute === 'citizen.dashboard' ? 'active' : '' }}">
                    <a href="{{ route('citizen.dashboard') }}">
                        <i class="fe fe-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if(Auth::user()->user_type == '3')
                <li class="{{ ($currentRoute === 'captcha.create')  ? 'active' : '' }}">
                    <a href="{{ route('captcha.create') }}">
                        <i class="fe fe-clipboard"></i>
                        <span>Captcha</span>
                    </a>
                </li>
                <li class="{{ ($currentRoute === 'payment-request.index') || ($currentRoute === 'payment-request.create') || ($currentRoute === 'payment-request.edit') ? 'active' : '' }}">
                    <a href="{{ route('payment-request.index') }}">
                        <i class="fe fe-settings"></i>
                        <span>Payment Request</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>
