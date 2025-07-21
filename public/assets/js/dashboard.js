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

            $.each(data, function (index, item) {
                if (item.letter_by === "BGB") {
                    totalBgbKilling += item.casualties.killing;
                    totalBgbBeating += item.casualties.beating;
                    totalBgbFiring += item.casualties.firing;
                    totalBgbCrossing += item.casualties.crossing;
                    totalBgbInjuring += item.casualties.injuring;
                }

                if (item.letter_by === "BSF") {
                    totalBsfKilling += item.casualties.killing;
                    totalBsfBeating += item.casualties.beating;
                    totalBsfFiring += item.casualties.firing;
                    totalBsfCrossing += item.casualties.crossing;
                    totalBsfInjuring += item.casualties.injuring;
                }

                $("#killing_number_bgb").text(totalBgbKilling);
                $("#beating_number_bgb").text(totalBgbBeating);
                $("#firing_number_bgb").text(totalBgbFiring);
                $("#crossing_number_bgb").text(totalBgbCrossing);
                $("#injuiring_number_bgb").text(totalBgbInjuring);
                $("#bgb_no_reply").text(replyInfo.BGB.no_reply);
                $("#bgb_main").text(filesInfo.BGB.main);
                $("#bgb_ref").text(filesInfo.BGB.ref);
                $("#bgb_reply").text(filesInfo.BGB.reply);

                $("#killing_number_bsf").text(totalBsfKilling);
                $("#beating_number_bsf").text(totalBsfBeating);
                $("#firing_number_bsf").text(totalBsfFiring);
                $("#crossing_number_bsf").text(totalBsfCrossing);
                $("#injuiring_number_bsf").text(totalBsfInjuring);
                $("#bsf_no_reply").text(replyInfo.BSF.no_reply);
                $("#bsf_main").text(filesInfo.BSF.main);
                $("#bsf_ref").text(filesInfo.BSF.ref);
                $("#bsf_reply").text(filesInfo.BSF.reply);
            });
        },
        error: function (error) {
            console.log(error);
        },
    });
}
