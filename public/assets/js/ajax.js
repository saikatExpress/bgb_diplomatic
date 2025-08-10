let triggerAddress = false;
$(document).ready(function () {
    const dropdownMap = {
        "#selectBgbRegion": {
            url: "fetchsector",
            target: "#selectBgbSec",
            param: "region_id",
            placeholder: "Select SEC",
            emptyMsg: "No sector found",
        },

        "#selectBsfRegion": {
            url: "fetchsector",
            target: "#selectBsfSec",
            param: "region_id",
            placeholder: "Select SEC",
            emptyMsg: "No sector found",
        },

        "#selectBgbSec": {
            url: "fetchbattalion",
            target: "#selectBgbBattalion",
            param: "sector_id",
            placeholder: "Select Battalion",
            emptyMsg: "No battalion found",
        },

        "#selectBsfSec": {
            url: "fetchbattalion",
            target: "#selectBsfBattalion",
            param: "sector_id",
            placeholder: "Select Battalion",
            emptyMsg: "No battalion found",
        },

        "#selectBgbBattalion": {
            url: "fetchbop",
            target: "#selectBgbBop",
            param: "battalion_id",
            placeholder: "Select BOP",
            emptyMsg: "No BOP found",
        },

        "#selectBsfBattalion": {
            url: "fetchbop",
            target: "#selectBsfBop",
            param: "battalion_id",
            placeholder: "Select BOP",
            emptyMsg: "No BOP found",
        },
    };

    function loadOptions(trigger, selectedValue) {
        const config = dropdownMap[trigger];
        if (!config) return;

        const $target = $(config.target);
        if (selectedValue === "") {
            $target.html(
                `<option value="" selected disabled>${config.placeholder}</option>`
            );
            return;
        }

        $.ajax({
            url: config.url,
            method: "GET",
            data: { [config.param]: selectedValue },
            dataType: "json",
            success: function (response) {
                let options = `<option value="" selected disabled>${config.placeholder}</option>`;
                if (response.length > 0) {
                    response.forEach((item) => {
                        options += `<option value="${item.id}">${item.name}</option>`;
                    });
                } else {
                    options += `<option value="" selected disabled>${config.emptyMsg}</option>`;
                }
                $target.html(options);
            },
            error: function () {
                alert(`Failed to fetch data for ${config.placeholder}.`);
            },
        });
    }

    $(document).on("change", Object.keys(dropdownMap).join(","), function () {
        triggerAddress = true;
        loadOptions(`#${this.id}`, $(this).val());
    });
});
