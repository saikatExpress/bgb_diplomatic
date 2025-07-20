<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Map View</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
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
    <div class="top-header" style="background-image: url('{{ asset('assets/img/header.jpg') }}')">
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
                    <form action="{{ route('map_form') }}" method="post" id="map_form_action">
                        @csrf
                        <div class="from-to-date">
                            <div class="search-by-date-input">
                                <div>
                                    <label for="#">From Date: </label>
                                    <input type="date" name="form_date" id="form_date" placeholder="From Date">
                                </div>
                                <div>
                                    <label for="#">To Date: </label>
                                    <input type="date" id="to_date" name="to_date" placeholder="To Date">
                                </div>
                            </div>
                            <!-- select options Region -->
                            <div class="child-select-from-to-date">
                                <div>
                                    <label for="#">Region: </label>
                                </div>
                                <div class="map-searc-date-select">
                                    <select id="region_id" name="region_id">
                                        <option value="" selected disabled>Select Region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ filter($region->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- select options Sector -->
                            <div class="child-select-from-to-date">
                                <div>
                                    <label for="#">Sector: </label>
                                </div>
                                <div class="map-searc-date-select">
                                    <select id="sector_id" name="sector_id">
                                        <option value="" selected disabled>Select Sector</option>
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
                                    <select id="battalion_id" name="battalion_id">
                                        <option value="" selected disabled>Select Battalion</option>
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
                                    <select id="company_id" name="company_id">
                                        <option value="" selected disabled>Select Company</option>
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
                                    <select id="bop_id" name="bop_id">
                                        <option value="" selected disabled>Select BOP</option>
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
                                    <select id="incident_id" name="incident_id">
                                        <option value="" selected disabled>Select Incident</option>
                                        @foreach ($incidents as $value)
                                            <option value="{{ $value->id }}">{{ filter($value->title) }}</option>
                                        @endforeach
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
                                            <select id="pillar_id" name="pillar_id">
                                                <option value="" selected disabled>Select Pillar No</option>
                                                @foreach ($pillars as $pillar)
                                                    <option value="{{ $pillar->id }}">{{ filter($pillar->name) }}</option>
                                                @endforeach
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
                                            <select id="subpillar_type" name="subpillar_type">
                                                <option value="" selected disabled>Select Type</option>
                                                <option value="s">S</option>
                                                <option value="r">R</option>
                                                <option value="t">T</option>
                                                <option value="poll">Poll</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="search-button">
                                <button type="button" id="map_form_action_btn">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="{{ asset('assets/js/map_form.js') }}"></script>
<script src="{{ asset('assets/js/map.js') }}"></script>

<script>
    const incidentInfos = @json($infos);
</script>

<script>
    $(document).ready(function () {
        const bounds = [
            [20.55, 88.00],
            [26.75, 92.70]
        ];

        const map = L.map('bgb_form', {
            minZoom: 6,
            maxZoom: 12,
            maxBounds: bounds,
            maxBoundsViscosity: 1.0
        }).setView([23.6850, 90.3563], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let totalKilling = 0;
        let totalInjuring = 0;
        let totalBeating = 0;

        incidentInfos.forEach(info => {
            if (info.pillar && info.pillar.lat && info.pillar.lon) {
                const lat = parseFloat(info.pillar.lat);
                const lon = parseFloat(info.pillar.lon);

                const killing = parseInt(info.killing || 0);
                const injuring = parseInt(info.injuring || 0);
                const beating = parseInt(info.beating || 0);

                totalKilling += killing;
                totalInjuring += injuring;
                totalBeating += beating;

                // Killing marker (red)
                if (killing > 0) {
                    const icon = L.divIcon({
                        html: `<div style="
                            background-color: red;
                            width: 24px;
                            height: 24px;
                            border-radius: 50%;
                            text-align: center;
                            line-height: 24px;
                            color: white;
                            font-weight: bold;
                            border: 1px solid black;
                            font-size: 12px;
                        ">${killing}</div>`,
                        className: '',
                        iconSize: [24, 24]
                    });

                    L.marker([lat, lon], { icon }).addTo(map);
                }

                // Injuring marker (green)
                if (injuring > 0) {
                    const icon = L.divIcon({
                        html: `<div style="
                            background-color: green;
                            width: 24px;
                            height: 24px;
                            border-radius: 50%;
                            text-align: center;
                            line-height: 24px;
                            color: white;
                            font-weight: bold;
                            border: 1px solid black;
                            font-size: 12px;
                        ">${injuring}</div>`,
                        className: '',
                        iconSize: [24, 24]
                    });

                    L.marker([lat + 0.01, lon + 0.01], { icon }).addTo(map);
                }

                // Beating marker (yellow)
                if (beating > 0) {
                    const icon = L.divIcon({
                        html: `<div style="
                            background-color: orange;
                            width: 24px;
                            height: 24px;
                            border-radius: 50%;
                            text-align: center;
                            line-height: 24px;
                            color: black;
                            font-weight: bold;
                            border: 1px solid black;
                            font-size: 12px;
                        ">${beating}</div>`,
                        className: '',
                        iconSize: [24, 24]
                    });

                    L.marker([lat - 0.01, lon - 0.01], { icon }).addTo(map);
                }
            }
        });
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
