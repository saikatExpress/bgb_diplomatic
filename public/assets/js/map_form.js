$(document).ready(function () {
    $("#region_id").on("change", function () {
        const selectedRegion = $(this).val();

        if (selectedRegion !== "") {
            $.ajax({
                url: "/fetchsector",
                method: "GET",
                data: { region_id: selectedRegion },
                dataType: "json",
                success: function (response) {
                    let options =
                        '<option value="" selected disabled>Select Sector</option>';

                    if (response.length > 0) {
                        response.forEach(function (sector) {
                            options += `<option value="${sector.id}">${sector.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No sector found</option>';
                    }

                    $("#sector_id").html(options);
                },
                error: function () {
                    alert("Failed to fetch sector data.");
                },
            });
        } else {
            $("#sector_id").html(
                '<option value="" selected disabled>Select SEC</option>'
            );
        }
    });

    $("#sector_id").on("change", function () {
        const selectedSec = $(this).val();

        if (selectedSec !== "") {
            $.ajax({
                url: "/fetchbattalion",
                method: "GET",
                data: { sector_id: selectedSec },
                dataType: "json",
                success: function (response) {
                    let options =
                        '<option value="" selected disabled>Select Battalion</option>';

                    if (response.length > 0) {
                        response.forEach(function (battalion) {
                            options += `<option value="${battalion.id}">${battalion.name}</option>`;
                        });
                    } else {
                        options +=
                            '<option value="">No battalion found</option>';
                    }

                    $("#battalion_id").html(options);
                },
                error: function () {
                    alert("Failed to fetch battalion data.");
                },
            });
        } else {
            $("#battalion_id").html(
                '<option value="" selected disabled>Select Battalion</option>'
            );
        }
    });

    $("#battalion_id").on("change", function () {
        const selectedBattalion = $(this).val();

        if (selectedBattalion !== "") {
            $.ajax({
                url: "/fetchcompany",
                method: "GET",
                data: { battalion_id: selectedBattalion },
                dataType: "json",
                success: function (response) {
                    let options =
                        '<option value="" selected disabled>Select Company</option>';

                    if (response.length > 0) {
                        response.forEach(function (company) {
                            options += `<option value="${company.id}">${company.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No company found</option>';
                    }

                    $("#company_id").html(options);
                },
                error: function () {
                    alert("Failed to fetch company data.");
                },
            });
        } else {
            $("#company_id").html(
                '<option value="" selected disabled>Select Company</option>'
            );
        }
    });

    $("#company_id").on("change", function () {
        const selectedCompany = $(this).val();

        if (selectedCompany !== "") {
            $.ajax({
                url: "/fetchbop",
                method: "GET",
                data: { company_id: selectedCompany },
                dataType: "json",
                success: function (response) {
                    let options =
                        '<option value="" selected disabled>Select BOP</option>';

                    if (response.length > 0) {
                        response.forEach(function (bop) {
                            options += `<option value="${bop.id}">${bop.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No BOP found</option>';
                    }

                    $("#bop_id").html(options);
                },
                error: function () {
                    alert("Failed to fetch BOP data.");
                },
            });
        } else {
            $("#bop_id").html(
                '<option value="" selected disabled>Select BOP</option>'
            );
        }
    });
});
