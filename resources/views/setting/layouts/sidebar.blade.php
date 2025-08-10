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

    <div class="dropdown">
        <button class="dropdown-btn">🛒 Sector ▾</button>
        <div class="dropdown-content {{ request()->is('sector/*') ? 'show' : '' }}">
            <a href="{{ route('sector.index') }}" class="{{ request()->is('sector/index') ? 'active' : '' }}">
                All Sector
            </a>
            <a href="{{ route('sector.create') }}" class="{{ request()->is('sector/create') ? 'active' : '' }}">
                Add Sector
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 Battalion ▾</button>
        <div class="dropdown-content {{ request()->is('battalion/*') ? 'show' : '' }}">
            <a href="{{ route('battalion.index') }}" class="{{ request()->is('battalion/index') ? 'active' : '' }}">
                All Battalion
            </a>
            <a href="{{ route('battalion.create') }}" class="{{ request()->is('battalion/create') ? 'active' : '' }}">
                Add Battalion
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 BOP ▾</button>
        <div class="dropdown-content {{ request()->is('bop/*') ? 'show' : '' }}">
            <a href="{{ route('bop.index') }}" class="{{ request()->is('bop/index') ? 'active' : '' }}">
                All BOP
            </a>
            <a href="{{ route('bop.create') }}" class="{{ request()->is('bop/create') ? 'active' : '' }}">
                Add BOP
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 Incident ▾</button>
        <div class="dropdown-content {{ request()->is('incident/*') ? 'show' : '' }}">
            <a href="{{ route('incident.index') }}" class="{{ request()->is('incident/index') ? 'active' : '' }}">
                All Incident
            </a>
            <a href="{{ route('incident.create') }}" class="{{ request()->is('incident/create') ? 'active' : '' }}">
                Add Incident
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 LTR ▾</button>
        <div class="dropdown-content {{ request()->is('ltr/*') ? 'show' : '' }}">
            <a href="{{ route('ltr.index') }}" class="{{ request()->is('ltr/index') ? 'active' : '' }}">
                All LTR
            </a>
            <a href="{{ route('ltr.create') }}" class="{{ request()->is('ltr/create') ? 'active' : '' }}">
                Add LTR
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 Pillar ▾</button>
        <div class="dropdown-content {{ request()->is('pillar/*') ? 'show' : '' }}">
            <a href="{{ route('pillar.index') }}" class="{{ request()->is('pillar/index') ? 'active' : '' }}">
                All Pillar
            </a>
            <a href="{{ route('pillar.create') }}" class="{{ request()->is('pillar/create') ? 'active' : '' }}">
                Add Pillar
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 TAG ▾</button>
        <div class="dropdown-content {{ request()->is('tag/*') ? 'show' : '' }}">
            <a href="{{ route('tag.index') }}" class="{{ request()->is('tag/index') ? 'active' : '' }}">
                All Tag
            </a>
            <a href="{{ route('tag.create') }}" class="{{ request()->is('tag/create') ? 'active' : '' }}">
                Add Tag
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 GRD ▾</button>
        <div class="dropdown-content {{ request()->is('grd/*') ? 'show' : '' }}">
            <a href="{{ route('grd.index') }}" class="{{ request()->is('grd/index') ? 'active' : '' }}">
                All GRD
            </a>
            <a href="{{ route('grd.create') }}" class="{{ request()->is('grd/create') ? 'active' : '' }}">
                Add GRD
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 GR No ▾</button>
        <div class="dropdown-content {{ request()->is('gr/*') ? 'show' : '' }}">
            <a href="{{ route('gr.index') }}" class="{{ request()->is('gr/index') ? 'active' : '' }}">
                All GR No
            </a>
            <a href="{{ route('gr.create') }}" class="{{ request()->is('gr/create') ? 'active' : '' }}">
                Add GR No
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 Map Sheet No ▾</button>
        <div class="dropdown-content {{ request()->is('mapsheet/*') ? 'show' : '' }}">
            <a href="{{ route('mapsheet.index') }}" class="{{ request()->is('mapsheet/index') ? 'active' : '' }}">
                All Map Sheet No
            </a>
            <a href="{{ route('mapsheet.create') }}" class="{{ request()->is('mapsheet/create') ? 'active' : '' }}">
                Add Map Sheet No
            </a>
        </div>
    </div>

    <div class="dropdown">
        <button class="dropdown-btn">🛒 Unit ▾</button>
        <div class="dropdown-content {{ request()->is('unit/*') ? 'show' : '' }}">
            <a href="{{ route('unit.index') }}" class="{{ request()->is('unit/index') ? 'active' : '' }}">
                All Unit
            </a>
            <a href="{{ route('unit.create') }}" class="{{ request()->is('unit/create') ? 'active' : '' }}">
                Add Unit
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
