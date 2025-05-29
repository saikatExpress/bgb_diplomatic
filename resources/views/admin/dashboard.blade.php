<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>
<style></style>

<body>
    <div class="top-header" style="background-image: url('{{ asset('assets/img/header.jpg') }}');">
        <div class="container heading-content-parent">
            <div class="logo-area">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('assets/img/logo.png') }}" class="" width="160px" alt="BGB logo">
                </a>
            </div>
            <div class="header-content">
                <h2 class="top-title-header">Diplomatic LTR Bank</h2>
                <p>North East Region, Sarail</p>
                <nav class="navbar">
                    <ul>
                        <li><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="active"><a href="{{ route('dashboard') }}">Entry</a></li>
                        <li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ url('/search') }}">Search</a></li>
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
                    <h5 class="bgb-heading-title">BGB Protest</h5>
                    <img src="{{ asset('assets/img/logo.png') }}" width="60" height="auto" alt="logo">
                </div>
                <!-- form group4 second -->
                <div class="bgb-protest-box">
                    <p class="killing-bsf-box">
                        <span class="killing-number">150</span>
                        <span>Killing By BSF 05</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">20</span>
                        <span>Killing By IND ntl 03</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">50</span>
                        <span>Injuring By BSF 02</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">30</span>
                        <span>Injuring By IND ntl 10</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">120</span>
                        <span>Beating By BSF 12</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">180</span>
                        <span>Beating By IND ntl 2</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">120</span>
                        <span>Beating By BSF 12</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">180</span>
                        <span>Beating By IND ntl 2</span>
                    </p>
                </div>
            </div>
            <div class="bsf-protest">
                <div class="bgb-heading-title-img">
                    <h5 class="bgb-heading-title">BSF Protest</h5>
                    <img src="{{ asset('assets/img/logo.png') }}" width="60" height="auto" alt="logo">
                </div>
                <!-- form group4 second -->
                <div class="bgb-protest-box">
                    <p class="killing-bsf-box">
                        <span class="killing-number">150</span>
                        <span>Killing By BSF 05</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">20</span>
                        <span>Killing By IND ntl 03</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">50</span>
                        <span>Injuring By BSF 02</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">30</span>
                        <span>Injuring By IND ntl 10</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">120</span>
                        <span>Beating By BSF 12</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">180</span>
                        <span>Beating By IND ntl 2</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">120</span>
                        <span>Beating By BSF 12</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">180</span>
                        <span>Beating By IND ntl 2</span>
                    </p>
                </div>
            </div>

            <div class="bgb-protest-bar-icon">
                <div>
                    <img src="{{ asset('assets/img/bar.jpg') }}" class="img-fluid" alt="">
                    <p>Killing</p>
                </div>
                <div>
                    <img src="{{ asset('assets/img/bar.jpg') }}" class="img-fluid" alt="">
                    <p>Injuring</p>
                </div>
                <div>
                    <img src="{{ asset('assets/img/bar.jpg') }}" class="img-fluid" alt="">
                    <p>Beating</p>
                </div>
                <div>
                    <img src="{{ asset('assets/img/bar.jpg') }}" class="img-fluid" alt="">
                    <p>Firing</p>
                </div>
            </div>
        </div>
    </div>
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
