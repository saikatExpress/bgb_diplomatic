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

                const filterSummary = buildFilterSummary(formData);

                populateFileTableData(files, filterSummary);
            }
        },
        error: function (xhr) {
            console.error(xhr);
            alert("Something went wrong while searching.");
        },
    });
}

function buildFilterSummary(formData) {
    const params = new URLSearchParams(formData);
    let summary = [];

    for (const [key, value] of params.entries()) {
        if (
            key === "_token" ||
            !value ||
            value === "Select Sector" ||
            value === "Select Company" ||
            value === "Select Battalion" ||
            value === "Select BOP" ||
            value === "Select Frontier" ||
            value === "Select Piller" ||
            value === "Select Sub Piller"
        ) {
            continue;
        }
        summary.push(`${key.replace(/_/g, " ")}: ${value}`);
    }

    return summary.join(" | ");
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

function populateFileTableData(files, filterSummary) {
    populateFileTable(files, "main", "#main_letter_table_print", filterSummary);
    populateFileTable(files, "ref", "#ref_letter_table_print", filterSummary);
    populateFileTable(
        files,
        "reply-file",
        "#reply_file_table_print",
        filterSummary
    );
}

function populateFileTable(files, prefix, tableSelector, filterSummary) {
    const filteredFiles = files.filter((f) => f.file_prefix === prefix);
    const $table = $(tableSelector);
    const $tbody = $table.find("tbody");
    const $thead = $table.find("thead");

    $tbody.empty();

    // Insert a new row in the thead after the heading row to show filters
    $table.find("caption.filter-summary").remove();
    if (filterSummary) {
        const filterCaption = $(
            `<caption class="filter-summary" style="caption-side: top; font-weight: 500; color: #444;">Search Filters: ${filterSummary}</caption>`
        );
        $table.prepend(filterCaption);
    }

    filteredFiles.forEach((file, index) => {
        const tr = $("<tr></tr>");
        const id = file.id;

        tr.append(`<td>${index + 1}</td>`);
        tr.append(`<td>${file.created_at?.split("T")[0] || ""}</td>`);

        const fileName = file.file_path.replace("/storage/letter_files/", "");

        if (file.letter_by === "BGB") {
            tr.append(`<td>${file.bgb_region_name || "N/A"}</td>`);
            tr.append(`<td>${file.bgb_sector_name || "N/A"}</td>`);
            tr.append(`<td>${file.bgb_battalion_name || "N/A"}</td>`);
            tr.append(`<td>${file.bgb_coy_name || "N/A"}</td>`);
            tr.append(`<td>${file.bgb_bop_name || "N/A"}</td>`);
        } else {
            tr.append(`<td>${file.bsf_region_name || "N/A"}</td>`);
            tr.append(`<td>${file.bsf_sector_name || "N/A"}</td>`);
            tr.append(`<td>${file.bsf_battalion_name || "N/A"}</td>`);
            tr.append(`<td>${file.bsf_coy_name || "N/A"}</td>`);
            tr.append(`<td>${file.bsf_bop_name || "N/A"}</td>`);
        }

        tr.append(`<td>${file.pillar_name || ""}</td>`);
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
