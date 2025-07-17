<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/super/images/favicon.png') }}" />

    @include('super.layout.style')

</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_horizontal-navbar.html -->
        <div class="horizontal-menu">
            @include('super.layout.top_header')
            @include('super.layout.header')
        </div>

        @yield('content')
    </div>

    @include('super.layout.script')
</body>

</html>
