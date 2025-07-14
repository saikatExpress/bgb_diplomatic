<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('super_admin.dashboard') }}">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-cube-outline menu-icon"></i>
                    <span class="menu-title">Incidents</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.incidents.create') }}">
                                Add Incident
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.incidents') }}">
                                All Incidents
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-cube-outline menu-icon"></i>
                    <span class="menu-title">Pillar</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.pillars.create') }}">
                                Add Pillar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.pillars') }}">
                                All Pillars
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-cube-outline menu-icon"></i>
                    <span class="menu-title">LTR</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.ltr.create') }}">
                                Add LTR
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.ltr') }}">
                                All LTR
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-cube-outline menu-icon"></i>
                    <span class="menu-title">TAG</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.tags.create') }}">
                                Add TAG
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.tags') }}">
                                All TAG
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.tags.create') }}">
                                Add Input TAG
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.tags') }}">
                                All Input TAG
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="mdi mdi-finance menu-icon"></i>
                    <span class="menu-title">Charts</span>
                    <i class="menu-arrow"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/tables/basic-table.html" class="nav-link">
                    <i class="mdi mdi-grid menu-icon"></i>
                    <span class="menu-title">Tables</span>
                    <i class="menu-arrow"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/icons/mdi.html" class="nav-link">
                    <i class="mdi mdi-emoticon menu-icon"></i>
                    <span class="menu-title">Icons</span>
                    <i class="menu-arrow"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-codepen menu-icon"></i>
                    <span class="menu-title">Region</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.regions.create') }}">
                                Region
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.regions') }}">
                                All Region
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.sectors.create') }}">
                                Add Sector
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.sectors') }}">
                                All Sector
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.battalions.create') }}">
                                Add Battalion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.battalions') }}">
                                All Battalion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.companies.create') }}">
                                Add Company
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.companies') }}">
                                All Company
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.bops.create') }}">
                                Add BOP
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('super_admin.bops') }}">
                                All BOP
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="docs/documentation.html" class="nav-link">
                    <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                    <span class="menu-title">Documentation</span></a>
            </li>
        </ul>
    </div>
</nav>