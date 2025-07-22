$(document).ready(function () {
    $("#backupBtn").click(function () {
        $("#backupBtn").prop("disabled", true).text("Backing up...");
        $("#backupMsg").html("");

        $.ajax({
            url: "/backup/database",
            method: "GET",
            success: function (response) {
                $("#backupBtn").prop("disabled", false).text("Create Backup");

                if (response.success) {
                    $("#backupMsg").html(
                        '<div class="alert alert-success">' +
                            response.message +
                            "</div>"
                    );

                    const row = `
                        <tr>
                            <td>${response.filename}</td>
                            <td>${response.size}</td>
                            <td>${response.time}</td>
                            <td><a href="${response.url}" class="btn btn-sm btn-success" download>Download</a></td>
                        </tr>
                    `;
                    $("#backupTable").prepend(row);
                } else {
                    $("#backupMsg").html(
                        '<div class="alert alert-danger">' +
                            response.message +
                            "</div>"
                    );
                }
            },
            error: function () {
                $("#backupBtn").prop("disabled", false).text("Create Backup");
                $("#backupMsg").html(
                    '<div class="alert alert-danger">Something went wrong!</div>'
                );
            },
        });
    });
});
