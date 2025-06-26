$(document).ready(function () {
    $(document).on("change", "#selectBgbRegion", function () {
        const selectedRegion = $(this).val();

        if (selectedRegion !== "") {
            $.ajax({
                url: "fetchsector",
                method: "GET",
                data: { region_id: selectedRegion },
                dataType: "json",
                success: function (response) {
                    let options = '<option value="">Select SEC</option>';

                    if (response.length > 0) {
                        response.forEach(function (sector) {
                            options += `<option value="${sector.id}">${sector.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No sector found</option>';
                    }

                    $("#selectBgbSec").html(options);
                },
                error: function () {
                    alert("Failed to fetch sector data.");
                },
            });
        } else {
            $("#selectBgbSec").html('<option value="">Select SEC</option>');
        }
    });

    $(document).on("change", "#selectBsfRegion", function () {
        const selectedRegion = $(this).val();

        if (selectedRegion !== "") {
            $.ajax({
                url: "fetchsector",
                method: "GET",
                data: { region_id: selectedRegion },
                dataType: "json",
                success: function (response) {
                    let options = '<option value="">Select SEC</option>';

                    if (response.length > 0) {
                        response.forEach(function (sector) {
                            options += `<option value="${sector.id}">${sector.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No sector found</option>';
                    }

                    $("#selectBsfSec").html(options);
                },
                error: function () {
                    alert("Failed to fetch sector data.");
                },
            });
        } else {
            $("#selectBsfSec").html('<option value="">Select SEC</option>');
        }
    });

    $(document).on("change", "#selectBgbSec", function () {
        const selectedSec = $(this).val();

        if (selectedSec !== "") {
            $.ajax({
                url: "fetchbattalion",
                method: "GET",
                data: { sector_id: selectedSec },
                dataType: "json",
                success: function (response) {
                    let options = '<option value="">Select Battalion</option>';

                    if (response.length > 0) {
                        response.forEach(function (battalion) {
                            options += `<option value="${battalion.id}">${battalion.name}</option>`;
                        });
                    } else {
                        options +=
                            '<option value="">No battalion found</option>';
                    }

                    $("#selectBgbBattalion").html(options);
                },
                error: function () {
                    alert("Failed to fetch battalion data.");
                },
            });
        } else {
            $("#selectBgbBattalion").html(
                '<option value="">Select Battalion</option>'
            );
        }
    });

    $(document).on("change", "#selectBgbBattalion", function () {
        const selectedBattalion = $(this).val();

        if (selectedBattalion !== "") {
            $.ajax({
                url: "fetchcompany",
                method: "GET",
                data: { battalion_id: selectedBattalion },
                dataType: "json",
                success: function (response) {
                    let options = '<option value="">Select Company</option>';

                    if (response.length > 0) {
                        response.forEach(function (company) {
                            options += `<option value="${company.id}">${company.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No company found</option>';
                    }

                    $("#selectBgbCoy").html(options);
                },
                error: function () {
                    alert("Failed to fetch company data.");
                },
            });
        } else {
            $("#selectBgbCoy").html('<option value="">Select Company</option>');
        }
    });

    $(document).on("change", "#selectBgbCoy", function () {
        const selectedCompany = $(this).val();

        if (selectedCompany !== "") {
            $.ajax({
                url: "fetchbop",
                method: "GET",
                data: { company_id: selectedCompany },
                dataType: "json",
                success: function (response) {
                    let options = '<option value="">Select BOP</option>';

                    if (response.length > 0) {
                        response.forEach(function (bop) {
                            options += `<option value="${bop.id}">${bop.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No BOP found</option>';
                    }

                    $("#selectBgbBop").html(options);
                },
                error: function () {
                    alert("Failed to fetch BOP data.");
                },
            });
        } else {
            $("#selectBgbBop").html('<option value="">Select BOP</option>');
        }
    });

    $(document).on("change", "#selectBsfSec", function () {
        const selectedSec = $(this).val();

        if (selectedSec !== "") {
            $.ajax({
                url: "fetchbattalion",
                method: "GET",
                data: { sector_id: selectedSec },
                dataType: "json",
                success: function (response) {
                    let options = '<option value="">Select Battalion</option>';

                    if (response.length > 0) {
                        response.forEach(function (battalion) {
                            options += `<option value="${battalion.id}">${battalion.name}</option>`;
                        });
                    } else {
                        options +=
                            '<option value="">No battalion found</option>';
                    }

                    $("#selectBsfBattalion").html(options);
                },
                error: function () {
                    alert("Failed to fetch battalion data.");
                },
            });
        } else {
            $("#selectBsfBattalion").html(
                '<option value="">Select Battalion</option>'
            );
        }
    });

    $(document).on("change", "#selectBsfBattalion", function () {
        const selectedBattalion = $(this).val();

        if (selectedBattalion !== "") {
            $.ajax({
                url: "fetchcompany",
                method: "GET",
                data: { battalion_id: selectedBattalion },
                dataType: "json",
                success: function (response) {
                    let options = '<option value="">Select Company</option>';

                    if (response.length > 0) {
                        response.forEach(function (company) {
                            options += `<option value="${company.id}">${company.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No company found</option>';
                    }

                    $("#selectBsfCoy").html(options);
                },
                error: function () {
                    alert("Failed to fetch company data.");
                },
            });
        } else {
            $("#selectBsfCoy").html('<option value="">Select Company</option>');
        }
    });

    $(document).on("change", "#selectBsfCoy", function () {
        const selectedCompany = $(this).val();

        if (selectedCompany !== "") {
            $.ajax({
                url: "fetchbop",
                method: "GET",
                data: { company_id: selectedCompany },
                dataType: "json",
                success: function (response) {
                    let options = '<option value="">Select BOP</option>';

                    if (response.length > 0) {
                        response.forEach(function (bop) {
                            options += `<option value="${bop.id}">${bop.name}</option>`;
                        });
                    } else {
                        options += '<option value="">No BOP found</option>';
                    }

                    $("#selectBsfBop").html(options);
                },
                error: function () {
                    alert("Failed to fetch BOP data.");
                },
            });
        } else {
            $("#selectBsfBop").html('<option value="">Select BOP</option>');
        }
    });
});
