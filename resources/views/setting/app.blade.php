<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    @include('setting.layouts.style')
    <style>
        .dashboard-container {
            display: flex;
            min-height: calc(100vh - 150px);
            margin-top: 20px;
        }

        .sidebar {
            width: 250px;
            background-color: #A91D2A;
            color: white;
            padding: 20px;
            border-radius: 8px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: teal;
        }

        .content {
            flex: 1;
            background: #fff;
            margin-left: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown {
            margin-bottom: 5px;
        }

        .dropdown-btn {
            width: 100%;
            background: none;
            border: none;
            color: white;
            text-align: left;
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
        }

        .dropdown-btn:hover {
            background-color: #495057;
        }

        .dropdown-content {
            display: none;
            background-color: #8B1823;
            padding-left: 15px;
            border-radius: 5px;
        }

        .dropdown-content a {
            display: block;
            padding: 8px;
            color: #fff;
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background-color: #6c757d;
        }

        /* Active expanded state */
        .dropdown-content.show {
            display: block;
        }
    </style>
</head>

<body>
    <div class="top-header" style="background-image: url('{{ asset('assets/img/header.jpg') }}');">
        <div class="container heading-content-parent">
            <div class="logo-area">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" width="160px" alt="BGB logo">
                </a>
            </div>
            @include('setting.layouts.header')
            <div>
                <div class="white-space"></div>
            </div>
        </div>
    </div>

    <div class="container dashboard-container">
        <!-- Sidebar -->
        @include('setting.layouts.sidebar')
        <!-- Sidebar -->
        <!-- Main Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    @include('setting.layouts.scripts')
</body>

<script>
    document.querySelectorAll('.custom-file-input input[type="file"]').forEach((input) => {
        const label = input.previousElementSibling;

        input.addEventListener("change", () => {
            const fileName = input.files.length
                ? input.files[0].name
                : "Add Files......";
            label.textContent = fileName;
        });
    });
</script>

<script>
    document.querySelectorAll('.dropdown-btn').forEach(button => {
        button.addEventListener('click', function () {
            const dropdownContent = this.nextElementSibling;

            // Close all other dropdowns
            document.querySelectorAll('.dropdown-content').forEach(content => {
                if (content !== dropdownContent) {
                    content.classList.remove('show');
                }
            });

            // Toggle current dropdown
            dropdownContent.classList.toggle('show');
        });
    });
</script>


</html>
