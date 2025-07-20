<div class="header-content">
    <h2 class="top-title-header">Diplomatic LTR Bank</h2>
    <p>North East Region, Sarail</p>
    <nav class="navbar">
        <ul>
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
            </li>
            <li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">Entry</a>
            </li>
            <li class="{{ Request::is('search') ? 'active' : '' }}">
                <a href="{{ url('/search') }}">Search</a>
            </li>
            <li class="{{ Request::is('map/view') ? 'active' : '' }}">
                <a href="{{ url('/map/view') }}">Map View</a>
            </li>
            <li class="{{ Request::is('about') ? 'active' : '' }}">
                <a href="{{ url('/about') }}">About</a>
            </li>

            @if (auth()->check())
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
        </ul>
    </nav>
</div>
