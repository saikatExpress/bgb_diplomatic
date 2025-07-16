<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BGB - Input Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @include('web.layouts.style')
</head>
<style></style>

<body>
    <div class="top-header">
        <div class="container heading-content-parent">
            <div class="logo-area">
                <a href="#">
                    <img src="img/logo.png" width="160px" alt="BGB logo">
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
                    <img src="img/boys.png" alt="">
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
