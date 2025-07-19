<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Input Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Leaflet CSS & JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/map.css') }}" />

    <style>
        #bgb_form {
            height: 90vh;
            width: 100%;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="top-header">
        <div class="container heading-content-parent">
            <div class="logo-area">
                <a href="#">
                    <img src="{{ asset('assets/img/logo.png') }}" class="" width="160px" alt="BGB logo">
                </a>
            </div>
            <div class="header-content">
                <h2 class="top-title-header">Diplomatic LTR Bank</h2>
                <p>North East Region, Sarail</p>
                <nav class="navbar">
                    <ul>
                        <li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('dashboard') }}">Entry</a></li>
                        <li><a href="{{ url('/search') }}">Search</a></li>
                        <li class="active"><a href="{{ url('/map/view') }}">Map View</a></li>
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
            <div>
                <div class="white-space"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="map-container">
            <div class="main-content-wrapper">
                <div class="bgb-protest">
                    <div class="bgb-heading-title-img">
                        <h5 class="bgb-heading-title">Map View</h5>
                        <img src="{{ asset('assets/img/logo.png') }}" width="60" height="auto" alt="logo">
                    </div>

                    <div id="bgb_form" class="bgb_form">

                    </div>
                </div>
                <div class="sidebar-dropdown-options">
                    <h3 class="title-top-search-heading">Search Box</h3>
                    <!-- <hr> -->
                    <!-- from and to data -->
                    <div class="from-to-date">
                        <div class="search-by-date-input">
                            <div>
                                <label for="#">From Date: </label>
                                <input type="date" placeholder="From Date">
                            </div>
                            <div>
                                <label for="#">To Date: </label>
                                <input type="date" placeholder="To Date">
                            </div>
                        </div>
                        <!-- select options Region -->
                        <div class="child-select-from-to-date">
                            <div>
                                <label for="#">Region: </label>
                            </div>
                            <div class="map-searc-date-select">
                                <select>
                                    <option>Select Region</option>
                                    <option>Rigion HQ, Sarail</option>
                                    <option>Option B</option>
                                </select>
                            </div>
                        </div>
                        <!-- select options Sector -->
                        <div class="child-select-from-to-date">
                            <div>
                                <label for="#">Sector: </label>
                            </div>
                            <div class="map-searc-date-select">
                                <select>
                                    <option>Select Sector</option>
                                    <option>Sec HQ, Cumilla</option>
                                    <option>Sec HQ, Mymensingh</option>
                                </select>
                            </div>
                        </div>
                        <!-- select options Battalion -->
                        <div class="child-select-from-to-date">
                            <div>
                                <label for="#">Battalion: </label>
                            </div>
                            <div class="map-searc-date-select">
                                <select>
                                    <option>Select Battalion</option>
                                    <option>Sarail Battalion (25 BGB)</option>
                                    <option>Mymensingh Battalion (39 BGB)</option>
                                </select>
                            </div>
                        </div>
                        <!-- select options Company -->
                        <div class="child-select-from-to-date">
                            <div>
                                <label for="#">Company: </label>
                            </div>
                            <div class="map-searc-date-select">
                                <select>
                                    <option>Select Company</option>
                                    <option>Bijoypur Company HQ</option>
                                    <option>Kamalpur Company HQ</option>
                                </select>
                            </div>
                        </div>
                        <!-- select options BOP -->
                        <div class="child-select-from-to-date">
                            <div>
                                <label for="#">BOP: </label>
                            </div>
                            <div class="map-searc-date-select">
                                <select>
                                    <option>Select BOP</option>
                                    <option>Kamalpur Bop</option>
                                    <option>Nondir Gram Bop</option>
                                </select>
                            </div>
                        </div>
                        <!-- select options Incident -->
                        <div class="child-select-from-to-date">
                            <div>
                                <label for="#">Incident: </label>
                            </div>
                            <div class="map-searc-date-select">
                                <select>
                                    <option>Select Incident</option>
                                    <option>Killing</option>
                                    <option>Injuring</option>
                                </select>
                            </div>
                        </div>

                        <!-- select options Pillar No. -->
                        <div class="child-select-from-to-date">
                            <div>
                                <label for="#">Pillar No: </label>
                            </div>
                            <div class="pillar-select-from-to-date">
                                <div class="form-group3-select-items">
                                    <!-- Subject Select -->
                                    <div class="input-wrapper">
                                        <select>
                                            <option>Select Pillar No</option>
                                            <option>1010</option>
                                            <option>1015</option>
                                        </select>
                                    </div>

                                    <!-- Slash -->
                                    <span class="slash">/</span>

                                    <!-- Text Input -->
                                    <div class="input-wrapper">
                                        <input type="text" placeholder="Sub Pillar">
                                    </div>

                                    <!-- Dropdown Select (S, R, T) -->
                                    <div class="dropdown-wrapper">
                                        <select>
                                            <option value="s">S</option>
                                            <option value="r">R</option>
                                            <option value="t">T</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="search-button">
                            <button>Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    $(document).ready(function () {
        // Set default coordinates (e.g., Bangladesh center)
        const lat = 23.6850;
        const lon = 90.3563;

        // Initialize the map inside #bgb_form
        const map = L.map('bgb_form').setView([lat, lon], 7);

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker
        L.marker([lat, lon]).addTo(map)
            .bindPopup("Center of Bangladesh")
            .openPopup();
    });
</script>


<script>
    document
        .querySelectorAll('.custom-file-input input[type="file"]')
        .forEach((input) => {
            const label = input.previousElementSibling;

            input.addEventListener("change", () => {
                const fileName = input.files.length
                    ? input.files[0].name
                    : "Add Files......";
                label.textContent = fileName;
            });
        });
</script>

</html>