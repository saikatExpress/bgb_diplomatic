$(document).ready(function () {
    $("#dashboardformBtn").on("click", function () {
        let form = $("#dashboardForm");
        let url = form.attr("action");
        let method = form.attr("method");
        let formData = form.serialize();

        updateDashboard(url, method, formData);
    });
});

function updateDashboard(url, method, formData) {
    $.ajax({
        type: method,
        url: url,
        data: formData,
        success: function (response) {
            const data = response.mapData;

            const replyInfo = response.replyInfo;

            const filesInfo = response.filesInfo;

            showCasualData(data);

            updateFileInfo(filesInfo);

            updateNoreplyInfo(replyInfo);
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function updateNoreplyInfo(replyInfo) {
    $("#bgb_no_reply").text(replyInfo.BGB?.no_reply ?? 0);
    $("#bsf_no_reply").text(replyInfo.BSF?.no_reply ?? 0);
}

function updateFileInfo(filesInfo) {
    $("#bgb_main").text(filesInfo.BGB?.main ?? 0);
    $("#bgb_ref").text(filesInfo.BGB?.ref ?? 0);
    $("#bgb_reply").text(filesInfo.BGB?.ref ?? 0);

    $("#bsf_main").text(filesInfo.BSF?.main ?? 0);
    $("#bsf_ref").text(filesInfo.BSF?.ref ?? 0);
    $("#bsf_reply").text(filesInfo.BSF?.reply ?? 0);
}

function showCasualData(data) {
    let totalBgbKilling = 0;
    let totalBgbBeating = 0;
    let totalBgbFiring = 0;
    let totalBgbCrossing = 0;
    let totalBgbInjuring = 0;

    let totalBsfKilling = 0;
    let totalBsfBeating = 0;
    let totalBsfFiring = 0;
    let totalBsfCrossing = 0;
    let totalBsfInjuring = 0;

    // Accumulate totals
    $.each(data, function (index, item) {
        if (item.letter_by === "BGB") {
            totalBgbKilling += item.killing;
            totalBgbBeating += item.beating;
            totalBgbFiring += item.firing;
            totalBgbCrossing += item.crossing;
            totalBgbInjuring += item.injuring;
        }

        if (item.letter_by === "BSF") {
            totalBsfKilling += item.killing;
            totalBsfBeating += item.beating;
            totalBsfFiring += item.firing;
            totalBsfCrossing += item.crossing;
            totalBsfInjuring += item.injuring;
        }
    });

    $("#killing_number_bgb").text(totalBgbKilling);
    $("#beating_number_bgb").text(totalBgbBeating);
    $("#firing_number_bgb").text(totalBgbFiring);
    $("#crossing_number_bgb").text(totalBgbCrossing);
    $("#injuiring_number_bgb").text(totalBgbInjuring);

    $("#killing_number_bsf").text(totalBsfKilling);
    $("#beating_number_bsf").text(totalBsfBeating);
    $("#firing_number_bsf").text(totalBsfFiring);
    $("#crossing_number_bsf").text(totalBsfCrossing);
    $("#injuiring_number_bsf").text(totalBsfInjuring);
}
