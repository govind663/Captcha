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

                @if(Auth::user()->user_type == '1')
                @elseif (Auth::user()->user_type == '2')
                @endif

            </ul>
        </div>
    </div>
</div>
