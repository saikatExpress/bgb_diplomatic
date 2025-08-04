<div class="sidebar">
    <h5>Admin Menu</h5>
    <a href="{{ route('setting') }}" class="{{ request()->is('setting') ? 'active' : '' }}">📊 Dashboard</a>

    <!-- Users Menu -->
    <div class="dropdown">
        <button class="dropdown-btn">👥 Users ▾</button>
        <div class="dropdown-content {{ request()->is('user/*') ? 'show' : '' }}">
            <a href="{{ route('user.index') }}" class="{{ request()->is('user/index') ? 'active' : '' }}">
                All Users
            </a>
            <a href="{{ route('user.create') }}" class="{{ request()->is('user/create') ? 'active' : '' }}">
                Add New User
            </a>
            <a href="{{ url('roles.index') }}" class="{{ request()->is('roles*') ? 'active' : '' }}">
                Roles & Permissions
            </a>
        </div>
    </div>


    <!-- Orders Menu -->
    <div class="dropdown">
        <button class="dropdown-btn">🛒 Regions ▾</button>
        <div class="dropdown-content {{ request()->is('region/*') ? 'show' : '' }}">
            <a href="{{ route('region.index') }}" class="{{ request()->is('region/index') ? 'active' : '' }}">
                All Regions
            </a>
            <a href="{{ route('region.create') }}" class="{{ request()->is('region/create') ? 'active' : '' }}">
                Add Region
            </a>
        </div>
    </div>

    <a href="{{ url('reports.index') }}" class="{{ request()->is('reports*') ? 'show' : '' }}">📈 Reports</a>

    <!-- Settings -->
    <div class="dropdown">
        <button class="dropdown-btn">⚙️ Settings ▾</button>
        <div class="dropdown-content">
            <a href="{{ url('settings.index') }}">General Settings</a>
            <a href="{{ url('settings.profile') }}">Profile Settings</a>
            <a href="{{ url('settings.security') }}">Security</a>
        </div>
    </div>
</div>
