let selectedGrdFiles = [];

$(document).ready(function () {
    $("#grdFileInput").on("change", function () {
        const files = this.files;

        const fileType = $("#letterBy").val();

        const letterNumber = $("#letter_no").val();
        const incidentType = $("#incidentSelect").val();
        const distance = $("#distance_from_zero").val();
        const description = $("#short_desc").val();
        const tags = $("#tags").val();

        if (letterNumber == "") {
            toastr.error("Please enter a letter number.");
            return;
        }

        // Capture form selections at the moment of file selection
        const ltrDate = $('input[name="letter_date"]').val();
        const ltrSub = $("#ltrSubjectSelect").val();

        const region =
            fileType === "BGB"
                ? $("#selectBgbRegion option:selected").text()
                : $("#selectBsfRegion option:selected").text();
        const sector =
            fileType === "BGB"
                ? $("#selectBgbSec option:selected").text()
                : $("#selectBsfSec option:selected").text();
        const battalion =
            fileType === "BGB"
                ? $("#selectBgbBattalion option:selected").text()
                : $("#selectBsfBattalion option:selected").text();
        const bop =
            fileType === "BGB"
                ? $("#selectBgbBop option:selected").text()
                : $("#selectBsfBop option:selected").text();
        const pillar = $("#pillarSelect option:selected").text();
        const subpillar = $("#subpillar_id").val();
        const subpillarType = $("#subpillar_type option:selected").text();

        // For each selected file, create an entry
        for (let i = 0; i < files.length; i++) {
            if (files[i].type === "application/pdf") {
                const fileObject = {
                    file: files[i],
                    ltrDate: ltrDate,
                    fileType: fileType,
                    letterNumber: letterNumber,
                    region: region,
                    sector: sector,
                    battalion: battalion,
                    ltrSub: ltrSub,
                    incidentType: incidentType,
                    bop: bop,
                    distance: distance,
                    description: description,
                    tags: tags,
                    pillar: pillar,
                    subpillar: subpillar,
                    subpillarType: subpillarType,
                };

                // Push into array so index is fixed
                selectedGrdFiles.push(fileObject);

                const formData = new FormData();
                const csrfToken = $('meta[name="csrf-token"]').attr("content");
                formData.append("_token", csrfToken);
                formData.append("file", files[i]);
                formData.append("file_type", fileType);
                formData.append("letter_number", letterNumber);
                formData.append("file_prefix", "main");

                // Lock reference to this object
                const currentIndex = selectedGrdFiles.length - 1;

                $.ajax({
                    url: "/upload-letter-file",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(
                            "File uploaded successfully:",
                            response.last_id
                        );

                        selectedGrdFiles[currentIndex].serverPath =
                            response.file_path;
                        selectedGrdFiles[currentIndex].id = response.last_id;
                    },
                    error: function (xhr, status, error) {
                        console.error("Upload failed:", error);
                    },
                });
            }
        }

        // Automatically preview the last added file
        if (files.length > 0) {
            const lastAdded = selectedGrdFiles[selectedGrdFiles.length - 1];
            showPDF(lastAdded.file);
        }

        // Clear input
        $(this).val("");
        renderGrdTable();
    });
});

function renderGrdTable() {
    const $tbody = $("#grdFileTable tbody");
    $tbody.empty();

    $.each(selectedGrdFiles, function (index, item) {
        const tr = $("<tr></tr>");

        const $checkbox = $(
            `<input type="checkbox" class="file-select-checkbox file_main_box" data-index="${index}">`
        );
        tr.append($("<td></td>").append($checkbox));

        tr.append($("<td></td>").text(index + 1));
        tr.append($("<td></td>").text(item.ltrDate));
        tr.append($("<td></td>").text(item.region));
        tr.append($("<td></td>").text(item.sector));
        tr.append($("<td></td>").text(item.battalion));
        tr.append($("<td></td>").text(item.bop));
        tr.append($("<td></td>").text(item.ltrSub));
        tr.append($("<td></td>").text(item.incidentType));
        tr.append(
            $("<td></td>").text(
                item.pillar + "/" + item.subpillar + "-" + item.subpillarType
            )
        );
        tr.append($("<td></td>").text(item.distance));
        tr.append($("<td></td>").text(item.tags));
        tr.append($("<td></td>").text(item.file.name));
        tr.append($("<td></td>").text(item.description));

        // Actions
        const $showBtn = $(
            '<button type="button" class="show-btn">Show</button>'
        ).on("click", function () {
            showPDF(item.file);
        });
        const $deleteBtn = $(
            '<button type="button" class="delete-btn">Delete</button>'
        ).on("click", function () {
            deleteGrdFile(index);
        });

        const $tdActions = $("<td></td>").append($showBtn, $deleteBtn);
        tr.append($tdActions);

        $tbody.append(tr);
    });
}

function showPDF(file) {
    const fileURL = URL.createObjectURL(file);

    // Clear any existing preview
    $("#file-preview").find("iframe").remove();

    // Create iframe
    const $iframe = $("<iframe>", {
        src: fileURL,
        width: "100%",
        height: "100%",
        style: "border: none;",
    });

    // Append iframe below title
    $("#file-preview").append($iframe);
}

function deleteGrdFile(index) {
    const file = selectedGrdFiles[index];

    if (!confirm("Are you sure you want to delete this file?")) {
        return;
    }

    $.ajax({
        url: "/delete-letter-file",
        type: "POST",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content"),
            last_id: file.id,
            file_type: file.fileType,
            letter_number: file.letterNumber,
        },
        success: function (response) {
            // Remove from array
            selectedFiles.splice(index, 1);
            renderGrdTable();

            // Clear preview if no files left
            if (selectedFiles.length === 0) {
                $("#file-preview").find("iframe").remove();
            }
        },
        error: function (xhr, status, error) {
            console.error("Delete failed:", error);
        },
    });
}

// Handle Select All checkbox
$(document).on("change", "#selectGrdAllFiles", function () {
    const checked = $(this).is(":checked");
    $(".file_main_box").prop("checked", checked);
});

$(document).on("click", "#printAllGrdLtrBtn", async function () {
    const pdfFiles = [];

    const $selectedCheckboxes = $(".file-select-checkbox:checked");

    if ($selectedCheckboxes.length > 0) {
        $selectedCheckboxes.each(function () {
            const index = $(this).data("index");
            const file = selectedGrdFiles[index]?.file;
            if (file && file.type === "application/pdf") {
                pdfFiles.push(file);
            }
        });
    } else {
        $.each(selectedGrdFiles, function (index, item) {
            if (item.file && item.file.type === "application/pdf") {
                pdfFiles.push(item.file);
            }
        });
    }

    if (pdfFiles.length > 0) {
        await mergeAndPrintPDFsFromFiles(pdfFiles);
    } else {
        alert("No PDF files found.");
    }
});

async function mergeAndPrintPDFsFromFiles(files) {
    const mergedPdf = await PDFLib.PDFDocument.create();

    for (const file of files) {
        const arrayBuffer = await file.arrayBuffer();
        const pdf = await PDFLib.PDFDocument.load(arrayBuffer);
        const copiedPages = await mergedPdf.copyPages(
            pdf,
            pdf.getPageIndices()
        );
        copiedPages.forEach((page) => {
            mergedPdf.addPage(page);
        });
    }

    const mergedPdfBytes = await mergedPdf.save();
    const blob = new Blob([mergedPdfBytes], { type: "application/pdf" });
    const blobUrl = URL.createObjectURL(blob);

    // Create invisible iframe to print
    const iframe = document.createElement("iframe");
    iframe.style.display = "none";
    iframe.src = blobUrl;
    document.body.appendChild(iframe);

    iframe.onload = function () {
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    };
}
