$(document).ready(function () {
    const $fromBox = $("#fromBox");
    const $toBox = $("#toBox");

    const originalFrom = $fromBox.html();
    const originalTo = $toBox.html();

    $("#letterBy").on("change", function () {
        const value = $(this).val();

        // Show loader
        $("#pageLoader").show();

        // Swap From/To
        if (value === "BSF") {
            $fromBox.html(originalTo);
            $toBox.html(originalFrom);

            $("#uploadTitle").text("Reply from BGB");
            $("#replyFile").attr("name", "bgb_reply");
            $("#replyHeading").text("Reply from BGB");
            $("#printReplyBtn").text("Print BGB Reply");
        } else {
            $fromBox.html(originalFrom);
            $toBox.html(originalTo);

            $("#uploadTitle").text("Reply from BSF");
            $("#replyFile").attr("name", "bsf_reply");
            $("#replyHeading").text("Reply from BSF");
            $("#printReplyBtn").text("Print BSF Reply");
        }

        $(".span-from-text").text("From");
        $(".span-to-text").text("To");

        // Clear ONLY input fields (not selects)
        $("input[type='text'], input[type='date']").val("");

        // Clear file preview
        $("#file-preview").find("iframe").remove();

        // Clear tables
        $("#fileTable tbody").empty();
        $("#refFileTable tbody").empty();

        // Clear file arrays (if declared)
        if (typeof selectedFiles !== "undefined") {
            selectedFiles = [];
        }
        if (typeof selectedRefFiles !== "undefined") {
            selectedRefFiles = [];
        }

        // Keep loader visible for 3 seconds, then hide
        setTimeout(function () {
            $("#pageLoader").hide();
        }, 2000);
    });
});
