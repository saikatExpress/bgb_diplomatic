<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BGB - Map View</title>
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
            /* 90% of the visible screen height */
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
                        <li><a href="{{ route('dashboard') }}">Home</a></li>
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
        <div class="my-container">
            <div class="bgb-protest">
                <div class="bgb-heading-title-img">
                    <h5 class="bgb-heading-title">Map View</h5>
                    <img src="{{ asset('assets/img/logo.png') }}" width="60" height="auto" alt="logo">
                </div>

                <div id="bgb_form" class="bgb_form">

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
