let mainFile = 0;
let referenceFile = 0;
let replyFile = 0;
let noreplyFile = 0;

$(document).ready(function () {
    $("#searchBtn").on("click", function () {
        let form = $("#search-form");
        let url = form.attr("action");
        let formData = form.serialize();

        submitSearchForm(url, formData);
    });
});

function submitSearchForm(url, formData) {
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        success: function (response) {
            if (response && response.status == "success") {
                const data = response.results;

                const files = response.files;

                populateSummaryInfo(data);

                populateSummaryBox(response);

                populateFileTableData(files);
            }
        },
        error: function (xhr) {
            console.error(xhr);
            alert("Something went wrong while searching.");
        },
    });
}

// For summary Description
function populateSummaryInfo(data) {
    let totalKilling = 0;
    let totalBeating = 0;
    let totalFiring = 0;
    let totalInjuring = 0;
    let totalCrossing = 0;

    let statusCount = {};

    data.forEach((item) => {
        totalKilling += parseInt(item.killing) || 0;
        totalBeating += parseInt(item.beating) || 0;
        totalFiring += parseInt(item.firing) || 0;
        totalInjuring += parseInt(item.injuring) || 0;
        totalCrossing += parseInt(item.crossing) || 0;

        let status = item.status || "unknown";
        statusCount[status] = (statusCount[status] || 0) + 1;
    });

    let statusText = Object.entries(statusCount)
        .map(([status, count]) => `${count} with status "${status}"`)
        .join(", ");

    let summaryText = `In total, there were ${totalKilling} killings, ${totalBeating} beatings, ${totalFiring} firings, ${totalInjuring} injuries, and ${totalCrossing} crossings reported. The records include ${statusText}.`;

    $("#summary_box").html(
        `<p style="font-size:20px;color:teal;">${summaryText}</p>`
    );
}

function populateSummaryBox(response) {
    $("#summary_response_div").toggle();

    mainFile = response.main;
    referenceFile = response.reference;
    replyFile = response.replyFile;
    noreplyFile = response.noreplyFile;

    const $tbody = $("#summary_res_table tbody");
    $tbody.empty();

    const tr = $("<tr></tr>");

    tr.append($("<td></td>").text(mainFile));
    tr.append($("<td></td>").text(referenceFile));
    tr.append($("<td></td>").text(replyFile));
    tr.append($("<td></td>").text(noreplyFile));

    $tbody.append(tr);
}

function populateFileTableData(files) {
    populateFileTable(
        files,
        "main",
        ".table-letter-heading_one + .table-container table tbody"
    );
    populateFileTable(
        files,
        "ref",
        ".table-letter-heading_two + .table-container table tbody"
    );
    populateFileTable(
        files,
        "reply-file",
        ".table-letter-heading_three + .table-container table tbody"
    );
}

function populateFileTable(files, prefix, tbodySelector) {
    const filteredFiles = files.filter((f) => f.file_prefix === prefix);
    const $tbody = $(tbodySelector);
    $tbody.empty();

    filteredFiles.forEach((file, index) => {
        const tr = $("<tr></tr>");

        const id = file.id;

        tr.append(`<td>${index + 1}</td>`);
        tr.append(`<td>${file.created_at?.split("T")[0] || ""}</td>`);

        const fileName = file.file_path.replace("/storage/letter_files/", "");

        if (file.letter_by === "BGB") {
            tr.append(
                `<td>${
                    file.bgb_region_name ? file.bgb_region_name : "N/A"
                }</td>`
            );
            tr.append(
                `<td>${
                    file.bgb_sector_name ? file.bgb_sector_name : "N/A"
                }</td>`
            );
            tr.append(
                `<td>${
                    file.bgb_battalion_name ? file.bgb_battalion_name : "N/A"
                }</td>`
            );
            tr.append(
                `<td>${file.bgb_coy_name ? file.bgb_coy_name : "N/A"}</td>`
            );
            tr.append(
                `<td>${file.bgb_bop_name ? file.bgb_bop_name : "N/A"}</td>`
            );
        } else {
            tr.append(
                `<td>${
                    file.bsf_region_name ? file.bsf_region_name : "N/A"
                }</td>`
            );
            tr.append(
                `<td>${
                    file.bsf_sector_name ? file.bsf_sector_name : "N/A"
                }</td>`
            );
            tr.append(
                `<td>${
                    file.bsf_battalion_name ? file.bsf_battalion_name : "N/A"
                }</td>`
            );
            tr.append(
                `<td>${file.bsf_coy_name ? file.bsf_coy_name : "N/A"}</td>`
            );
            tr.append(
                `<td>${file.bsf_bop_name ? file.bsf_bop_name : "N/A"}</td>`
            );
        }

        tr.append(`<td>${file.pillar_name ? file.pillar_name : ""}</td>`);
        tr.append($("<td></td>").text(fileName));

        const $showBtn = $(
            '<button type="button" class="btn btn-sm btn-primary">Show</button>'
        ).on("click", function () {
            showFile(file.file_path);
        });

        const $deleteBtn = $(
            '<button type="button" class="btn btn-sm btn-danger">Delete</button>'
        ).on("click", function () {
            deleteFileMedia(id, tr);
        });

        const $tdActions = $("<td></td>").append($showBtn, $deleteBtn);

        tr.append($tdActions);

        $tbody.append(tr);
    });
}

function deleteFileMedia(id, rowElement) {
    if (id > 0) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/delete/file/" + id,
                    type: "GET",
                    success: function (response) {
                        if (response && response.status == "success") {
                            toastr.success("Removed successfully!");
                            if (rowElement) {
                                rowElement.remove();
                            }
                        } else {
                            toastr.error("Failed to delete the file.");
                        }
                    },
                    error: function () {
                        toastr.error("Something went wrong!");
                    },
                });
            }
        });
    }
}

function showFile(filePath) {
    const $preview = $("#file-preview");
    $preview.empty();

    $preview.append('<div class="top-title-pdf">Pdf View</div>');

    const $iframe = $("<iframe>", {
        src: filePath,
    }).css({
        width: "100%",
        height: "119rem",
        border: "none",
    });

    $preview.append($iframe);
}
