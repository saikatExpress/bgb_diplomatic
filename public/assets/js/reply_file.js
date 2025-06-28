let selectedReplyFiles = [];

$(document).ready(function () {
    $("#replyFile").on("change", function () {
        const files = this.files;

        const fileType = $("#letterBy").val();

        // Capture form selections at the moment of file selection
        const ltrDate = $('input[name="letter_date"]').val();
        const region =
            fileType == "BGB"
                ? $("#selectBsfRegion option:selected").text()
                : $("#selectBgbRegion option:selected").text();
        const sector =
            fileType == "BGB"
                ? $("#selectBsfSec option:selected").text()
                : $("#selectBgbSec option:selected").text();
        const battalion =
            fileType == "BGB"
                ? $("#selectBsfBattalion option:selected").text()
                : $("#selectBgbBattalion option:selected").text();
        const coy =
            fileType == "BGB"
                ? $("#selectBsfCoy option:selected").text()
                : $("#selectBgbCoy option:selected").text();
        const bop =
            fileType == "BGB"
                ? $("#selectBsfBop option:selected").text()
                : $("#selectBgbBop option:selected").text();
        const pillar = $("#pillarSelect option:selected").text();

        // For each selected file, create an entry
        for (let i = 0; i < files.length; i++) {
            if (files[i].type === "application/pdf") {
                selectedReplyFiles.push({
                    file: files[i],
                    ltrDate: ltrDate,
                    region: region,
                    sector: sector,
                    battalion: battalion,
                    coy: coy,
                    bop: bop,
                    pillar: pillar,
                });
            }
        }

        // Automatically preview the last added file
        if (files.length > 0) {
            const lastAdded = selectedReplyFiles[selectedReplyFiles.length - 1];
            showReplyPdf(lastAdded.file);
        }

        // Clear input
        $(this).val("");
        renderReplyTable();
    });
});

function renderReplyTable() {
    const $tbody = $("#replyFileTable tbody");
    $tbody.empty();

    $.each(selectedReplyFiles, function (index, item) {
        const tr = $("<tr></tr>");

        const $checkbox = $(
            `<input type="checkbox" class="file-select-checkbox file_reply_box" data-index="${index}">`
        );
        tr.append($("<td></td>").append($checkbox));

        tr.append($("<td></td>").text(index + 1));
        tr.append($("<td></td>").text(item.ltrDate));
        tr.append($("<td></td>").text(item.region));
        tr.append($("<td></td>").text(item.sector));
        tr.append($("<td></td>").text(item.battalion));
        tr.append($("<td></td>").text(item.coy));
        tr.append($("<td></td>").text(item.bop));
        tr.append($("<td></td>").text(item.pillar));
        tr.append($("<td></td>").text(item.file.name));

        // Actions
        const $showBtn = $(
            '<button type="button" class="show-btn">Show</button>'
        ).on("click", function () {
            showReplyPdf(item.file);
        });
        const $deleteBtn = $(
            '<button type="button" class="delete-btn">Delete</button>'
        ).on("click", function () {
            deleteReplyFile(index);
        });

        const $tdActions = $("<td></td>").append($showBtn, $deleteBtn);
        tr.append($tdActions);

        $tbody.append(tr);
    });
}

function showReplyPdf(file) {
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

function deleteReplyFile(index) {
    selectedReplyFiles.splice(index, 1);
    renderReplyTable();

    // Optional: clear preview if no files left
    if (selectedReplyFiles.length === 0) {
        $("#file-preview").find("iframe").remove();
    }
}

$(document).on("change", "#selectActionAllFiles", function () {
    const checked = $(this).is(":checked");
    $(".file_reply_box").prop("checked", checked);
});

// Print Media Code Start From here
$(document).on("click", "#printReplyBtn", function () {
    if (selectedReplyFiles.length === 0) {
        alert("No Reply Letter files to print.");
        return;
    }

    selectedReplyFiles.forEach(function (item) {
        const fileURL = URL.createObjectURL(item.file);
        const printWindow = window.open("", "_blank");

        printWindow.document.write(`
            <html>
                <head>
                    <title>${item.file.name}</title>
                    <style>
                        body, html { margin:0; padding:0; height:100%; }
                        iframe { width:100%; height:100%; border:none; }
                    </style>
                </head>
                <body>
                    <iframe src="${fileURL}" onload="this.contentWindow.focus(); this.contentWindow.print();"></iframe>
                </body>
            </html>
        `);
    });
});
// Print Media Code Start From here
