$(document).ready(function () {
    $("#letter_no").on("input", function () {
        const letterNo = $(this).val().trim();
        const letterBy = $("#letterBy").val();

        if (letterNo != "") {
            $.ajax({
                url: "/fetched/letters",
                type: "GET",
                data: {
                    letterNo: letterNo,
                    letterBy: letterBy,
                },
                success: function (response) {
                    if (response) {
                        const title = $(
                            "<h4 style='text-align:center; color:teal;'></h4>"
                        );
                        const data = response;
                        if (data.length > 0) {
                            $("#search_table_container h4").remove();
                            title.text(
                                "All Letter For : " + data[0].letter_number
                            );
                            $("#search_table_container").prepend(title);
                            $("#search_table_container").show();
                            renderTableData(data);
                        } else {
                            $("#search_table_container").hide();
                        }
                    }
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }
    });

    function renderTableData(data) {
        const $tbody = $("#searchingTable tbody").empty();

        let hasReplyFile = false; // Track whether any row has reply-file

        $.each(data, function (index, item) {
            const tr = $("<tr></tr>");

            const id = item.id;

            const $checkbox = $(
                `<input type="checkbox" class="file-select-checkbox" data-index="${index}">`
            );
            tr.append($("<td></td>").append($checkbox));

            const date = new Date(item.created_at);
            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const day = date.getDate();
            const formatDate = day + "-" + month + "-" + year;

            const fileName = item.file_path.replace(
                "/storage/letter_files/",
                ""
            );

            tr.append($("<td></td>").text(index + 1));
            tr.append($("<td></td>").text(formatDate));
            tr.append($("<td></td>").text(item.letter_by));
            tr.append($("<td></td>").text(item.letter_number));
            tr.append($("<td></td>").text(item.file_prefix));
            tr.append($("<td></td>").text(fileName));

            if (item.file_prefix === "reply-file") {
                hasReplyFile = true;
            }

            const $showBtn = $(
                '<button type="button" class="show-btn">Show</button>'
            ).on("click", function () {
                showFile(item.file_path);
            });

            const $deleteBtn = $(
                '<button type="button" class="delete-btn">Delete</button>'
            ).on("click", function () {
                deleteFileMedia(id, tr);
            });

            const $tdActions = $("<td></td>").append($showBtn, $deleteBtn);

            tr.append($tdActions);

            $tbody.append(tr);
        });

        // If no reply-file rows found, add a message row
        if (!hasReplyFile) {
            const colspan = $("#searchingTable thead tr th").length;

            // Default message
            let message = "No reply has been given yet.";

            // If data has at least one item, pick letter_by of first item
            if (data.length > 0) {
                message =
                    data[0].letter_by === "BGB"
                        ? "Haven't received a reply yet"
                        : "No reply has been given yet.";
            }

            const messageRow = $("<tr></tr>").append(
                $("<td></td>")
                    .attr("colspan", colspan)
                    .css({
                        "text-align": "center",
                        color: "red",
                        "font-size": "20px",
                    })
                    .text(message)
            );

            $tbody.append(messageRow);
        }
    }

    function showFile(filePath) {
        const $preview = $("#file-preview");
        $preview.empty();

        $preview.append('<div class="top-title-pdf">Pdf View</div>');

        const $iframe = $("<iframe>", {
            src: filePath,
            width: "100%",
            height: "500px",
            style: "border:none;",
        });

        $preview.append($iframe);
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
});
