$(document).ready(function () {
    $("#backupBtn").click(function () {
        $("#backupBtn").prop("disabled", true).text("Backing up...");
        $("#backupMsg").html("");

        $.ajax({
            url: "/backup/database",
            method: "GET",

            success: function (response) {
                $("#backupBtn").prop("disabled", false).text("Create Backup");
                $("#backupMsg").html(
                    '<div class="alert alert-success">' +
                        response.message +
                        "</div>"
                );
            },
            error: function (xhr) {
                $("#backupBtn").prop("disabled", false).text("Create Backup");
                $("#backupMsg").html(
                    '<div class="alert alert-danger">Something went wrong!</div>'
                );
            },
        });
    });
});
