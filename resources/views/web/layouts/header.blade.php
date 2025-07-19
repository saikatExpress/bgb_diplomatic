<div class="header-content">
    <h2 class="top-title-header">Diplomatic LTR Bank</h2>
    <p>North East Region, Sarail</p>
    <nav class="navbar">
        <ul>
            <li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
            <li class="active"><a href="{{ route('dashboard') }}">Entry</a></li>
            <li><a href="{{ url('/search') }}">Search</a></li>
            <li><a href="{{ url('/map/view') }}">Map View</a></li>
            <li><a href="{{ url('/about') }}">About</a></li>
            @if (auth()->check())
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
        </ul>
    </nav>
</div>