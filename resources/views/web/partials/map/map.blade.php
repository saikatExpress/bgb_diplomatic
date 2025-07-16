<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Input Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @include('web.layouts.style')
</head>
<style></style>

<body>
    <div class="top-header">
        <div class="container heading-content-parent">
            <div class="logo-area">
                <a href="#">
                    <img src="img/logo.png" class="" width="160px" alt="BGB logo">
                </a>
            </div>
            @include('web.layouts.header')
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
                    <img src="img/logo.png" width="60" height="auto" alt="logo">
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
