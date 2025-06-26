$(document).ready(function () {
    $("#submitPillar").on("click", function () {
        let form = $("#pillarForm");
        let url = form.attr("action");
        let formData = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (response) {
                if (response.status === "success") {
                    let newOption = `<option value="${response.pillar.id}" selected>${response.pillar.name}</option>`;
                    $("#pillarSelect").append(newOption);

                    form[0].reset();

                    $("#addPillarModal").modal("hide");
                }
            },
            error: function (xhr) {
                console.error(xhr);
                alert("Something went wrong while saving the pillar.");
            },
        });
    });

    $("#submitSubPillar").on("click", function () {
        let form = $("#subPillarForm");
        let url = form.attr("action");
        let formData = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (response) {
                if (response.status === "success") {
                    let newOption = `<option value="${response.subpillar.id}" selected>${response.subpillar.name}</option>`;
                    $("#subpillarSelect").append(newOption);

                    form[0].reset();

                    $("#addSubPillarModal").modal("hide");
                }
            },
            error: function (xhr) {
                console.error(xhr);
                alert("Something went wrong while saving the pillar.");
            },
        });
    });

    $("#submitLtr").on("click", function () {
        let form = $("#ltrForm");
        let url = form.attr("action");
        let formData = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (response) {
                if (response.status === "success") {
                    let newOption = `<option value="${response.ltr.id}" selected>${response.ltr.name}</option>`;
                    $("#ltrSubjectSelect").append(newOption);

                    form[0].reset();

                    $("#ltrModal").modal("hide");
                }
            },
            error: function (xhr) {
                console.error(xhr);
                alert("Something went wrong while saving the pillar.");
            },
        });
    });

    $("#submitIncident").on("click", function () {
        let form = $("#incidentForm");
        let url = form.attr("action");
        let formData = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (response) {
                if (response.status === "success") {
                    let newOption = `<option value="${response.incident.id}" selected>${response.incident.title}</option>`;
                    $("#incidentSelect").append(newOption);

                    form[0].reset();

                    $("#incidentModal").modal("hide");
                }
            },
            error: function (xhr) {
                console.error(xhr);
                alert("Something went wrong while saving the incident.");
            },
        });
    });
});
