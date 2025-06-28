<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    @include('web.layouts.style')
</head>

<body>
    <div class="top-header" style="background-image: url('{{ asset('assets/img/header.jpg') }}');">
        <div class="container heading-content-parent">
            <div class="logo-area">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" width="160px" alt="BGB logo">
                </a>
            </div>
            @include('web.layouts.header')
            <div>
                <div class="white-space"></div>
            </div>
        </div>
    </div>
    <div class="container">
        @yield('content')

    </div>

    @include('web.layouts.scripts')
</body>
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
