<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <title>BGB - About</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/map.css') }}" />
</head>
<style></style>

<body>
    <div class="top-header" style="background-image: url('{{ asset('assets/img/header.jpg') }}')">
        <div class="container heading-content-parent">
            <div class="logo-area">
                <a href="#">
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
        <div class="form-body">
            <div class="left-form-content about-left-profile-details">
                <div class="profile-image-details">
                    <img src="{{ asset('assets/img/boys.png') }}" alt="">
                    <div class="details-content">
                        <h2>Design and Concept</h2>
                        <hr>
                        <div class="details-content-para">
                            <p>Lt Col Shafiul Azam Siddiqui, PBGM, ASC</p>
                            <p>Director Operation, NER</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-form-pdf" id="file-preview">
                <div class="top-title-pdf">Supporting Document</div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function () {
        const fileUrl = "{{ asset('assets/files/Letter RKB 2.pdf') }}";
        $("#file-preview").append(`<iframe src="${fileUrl}" width="100%" height="900px"></iframe>`);
    });
</script>


</html>
