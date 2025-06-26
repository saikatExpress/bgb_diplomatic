$(document).ready(function () {
    const $fromBox = $("#fromBox");
    const $toBox = $("#toBox");

    const originalFrom = $fromBox.html();
    const originalTo = $toBox.html();

    $("#letterBy").on("change", function () {
        const value = $(this).val();

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
    });
});
