<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    @include('web.style')
</head>

<body>
    <div class="top-header" style="background-image: url('{{ asset('assets/img/header.jpg') }}');">
        <div class="container heading-content-parent">
            <div class="logo-area">
                <a href="#">
                    <img src="{{ asset('assets/img/logo.png') }}" width="160px" alt="BGB logo">
                </a>
            </div>
            @include('web.header')
            <div>
                <div class="white-space"></div>
            </div>
        </div>
    </div>
    <div class="container">
        @yield('content')

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

<script>
    function handleFile(input) {
        const box = input.closest('.upload-box');
        const fileInfo = box.querySelector('.file-info');
        const fileName = box.querySelector('.file-name');
        const uploadText = box.querySelector('.upload-instruction');
        const removeBtn = box.querySelector('.remove-btn');

        const file = input.files[0];
        if (file) {
            fileName.textContent = file.name;
            fileInfo.style.display = 'flex';
            uploadText.style.display = 'none';
            removeBtn.style.display = 'inline-block';

            showFilePreview(file); // ✅ Show preview on selection
        } else {
            resetUploadBox(box);
        }
    }

    function removeFile(button) {
        const box = button.closest('.upload-box');
        const input = box.querySelector('.file-input');
        input.value = '';
        resetUploadBox(box);
        clearFilePreview(); // ✅ Remove preview
    }

    function resetUploadBox(box) {
        const fileInfo = box.querySelector('.file-info');
        const fileName = box.querySelector('.file-name');
        const uploadText = box.querySelector('.upload-instruction');
        const removeBtn = box.querySelector('.remove-btn');

        fileName.textContent = '';
        fileInfo.style.display = 'none';
        uploadText.style.display = 'block';
        removeBtn.style.display = 'none';
    }

    function showFilePreview(file) {
        const previewContainer = document.getElementById('file-preview');
        const reader = new FileReader();

        reader.onload = function (e) {
            let content = '';

            if (file.type === 'application/pdf') {
                content = `<embed src="${e.target.result}" type="application/pdf" width="100%" height="600px" />`;
            } else if (file.type.startsWith('image/')) {
                content = `<img src="${e.target.result}" style="max-width: 100%; height: auto;" />`;
            } else {
                content = `<p>Cannot preview this file type: ${file.type}</p>`;
            }

            previewContainer.innerHTML = `<p>File Preview:</p>${content}`;
        };

        reader.readAsDataURL(file);
    }

    function clearFilePreview() {
        const previewContainer = document.getElementById('file-preview');
        previewContainer.innerHTML = '<p>Pdf View</p>';
    }
</script>

</html>
