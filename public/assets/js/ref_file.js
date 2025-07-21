let selectedReffiles = [];

$(document).ready(function () {
    $("#refFileInput").on("change", function () {
        const files = this.files;

        const fileType = $("#letterBy").val();

        const letterNumber = $("#letter_no").val();

        if (letterNumber == "") {
            toastr.error("Please enter a letter number.");
            return;
        }

        // Capture form selections at the moment of file selection
        const ltrDate = $('input[name="letter_date"]').val();
        const region =
            fileType == "BGB"
                ? $("#selectBgbRegion option:selected").text()
                : $("#selectBsfRegion option:selected").text();
        const sector =
            fileType == "BGB"
                ? $("#selectBgbSec option:selected").text()
                : $("#selectBsfSec option:selected").text();
        const battalion =
            fileType == "BGB"
                ? $("#selectBgbBattalion option:selected").text()
                : $("#selectBsfBattalion option:selected").text();
        const coy =
            fileType == "BGB"
                ? $("#selectBgbCoy option:selected").text()
                : $("#selectBsfCoy option:selected").text();
        const bop =
            fileType == "BGB"
                ? $("#selectBgbBop option:selected").text()
                : $("#selectBsfBop option:selected").text();
        const pillar = $("#pillarSelect option:selected").text();
        const subpillar = $("#subpillar_id").val();
        const subpillarType = $("#subpillar_type option:selected").text();

        // For each selected file, create an entry
        for (let i = 0; i < files.length; i++) {
            if (files[i].type === "application/pdf") {
                selectedReffiles.push({
                    file: files[i],
                    ltrDate: ltrDate,
                    fileType: fileType,
                    letterNumber: letterNumber,
                    region: region,
                    sector: sector,
                    battalion: battalion,
                    coy: coy,
                    bop: bop,
                    pillar: pillar,
                    subpillar: subpillar,
                    subpillarType: subpillarType,
                });

                const formData = new FormData();
                const csrfToken = $('meta[name="csrf-token"]').attr("content");
                formData.append("_token", csrfToken);
                formData.append("file", files[i]);
                formData.append("file_type", fileType);
                formData.append("letter_number", letterNumber);
                formData.append("file_prefix", "ref");

                $.ajax({
                    url: "/upload-letter-file",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log("File uploaded successfully:", response);

                        selectedReffiles[
                            selectedReffiles.length - 1
                        ].serverPath = response.file_path;

                        selectedReffiles[selectedReffiles.length - 1].id =
                            response.last_id;
                    },
                    error: function (xhr, status, error) {
                        console.error("Upload failed:", error);
                    },
                });
            }
        }

        // Automatically preview the last added file
        if (files.length > 0) {
            const lastAdded = selectedReffiles[selectedReffiles.length - 1];
            showRefPdf(lastAdded.file);
        }

        // Clear input
        $(this).val("");
        renderRefTable();
    });
});

function renderRefTable() {
    const $tbody = $("#refFileTable tbody");
    $tbody.empty();

    $.each(selectedReffiles, function (index, item) {
        const tr = $("<tr></tr>");

        const $checkbox = $(
            `<input type="checkbox" class="file-select-checkbox file_ref_box" data-index="${index}">`
        );
        tr.append($("<td></td>").append($checkbox));

        tr.append($("<td></td>").text(index + 1));
        tr.append($("<td></td>").text(item.ltrDate));
        tr.append($("<td></td>").text(item.region));
        tr.append($("<td></td>").text(item.sector));
        tr.append($("<td></td>").text(item.battalion));
        tr.append($("<td></td>").text(item.coy));
        tr.append($("<td></td>").text(item.bop));
        tr.append(
            $("<td></td>").text(
                item.pillar + "/" + item.subpillar + "-" + item.subpillarType
            )
        );
        tr.append($("<td></td>").text(item.file.name));

        // Actions
        const $showBtn = $(
            '<button type="button" class="show-btn">Show</button>'
        ).on("click", function () {
            showRefPdf(item.file);
        });
        const $deleteBtn = $(
            '<button type="button" class="delete-btn">Delete</button>'
        ).on("click", function () {
            deleteReffile(index);
        });

        const $tdActions = $("<td></td>").append($showBtn, $deleteBtn);
        tr.append($tdActions);

        $tbody.append(tr);
    });
}

function showRefPdf(file) {
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

function deleteReffile(index) {
    const file = selectedReffiles[index];

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
            selectedReffiles.splice(index, 1);
            renderRefTable();

            if (selectedReffiles.length === 0) {
                $("#file-preview").find("iframe").remove();
            }
        },
        error: function (xhr, status, error) {
            toastr.error("Delete failed:", error);
        },
    });
}

$(document).on("change", "#selectRefAllFiles", function () {
    const checked = $(this).is(":checked");
    $(".file_ref_box").prop("checked", checked);
});

// Print Media Code Start From here
$(document).on("click", "#printAllRefLtrBtn", async function () {
    const pdfFiles = [];

    const $selectedRefCheckboxes = $(".file-select-checkbox:checked");

    if ($selectedRefCheckboxes.length > 0) {
        $selectedRefCheckboxes.each(function () {
            const index = $(this).data("index");
            const file = selectedReffiles[index]?.file;
            if (file && file.type === "application/pdf") {
                pdfFiles.push(file);
            }
        });
    } else {
        $.each(selectedReffiles, function (index, item) {
            if (item.file && item.file.type === "application/pdf") {
                pdfFiles.push(item.file);
            }
        });
    }

    if (pdfFiles.length > 0) {
        await mergeAndPrintPDFsRefFromFiles(pdfFiles);
    } else {
        alert("No PDF files found.");
    }
});

async function mergeAndPrintPDFsRefFromFiles(files) {
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
