let map;
let markerLayer;

$(document).ready(function () {
    const bounds = [
        [20.55, 88.0],
        [26.75, 92.7],
    ];

    // Remove existing map if already initialized
    if (map !== undefined) {
        map.remove();
    }

    map = L.map("bgb_form", {
        minZoom: 6,
        maxZoom: 12,
        maxBounds: bounds,
        maxBoundsViscosity: 1.0,
    }).setView([23.685, 90.3563], 7);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 18,
        attribution: "© OpenStreetMap contributors",
    }).addTo(map);

    markerLayer = L.layerGroup().addTo(map);

    renderIncidentMarkers(incidentInfos);

    $("#map_form_action_btn").on("click", function () {
        let form = $("#map_form_action");
        let url = form.attr("action");
        let formData = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (response) {
                if (response.infos) {
                    renderIncidentMarkers(response.infos);
                }
            },
            error: function (error) {
                console.log(error);
            },
        });
    });
});

function renderIncidentMarkers(data) {
    if (!markerLayer) return;

    markerLayer.clearLayers();

    data.forEach((info) => {
        if (info.pillar && info.pillar.lat && info.pillar.lon) {
            const lat = parseFloat(info.pillar.lat);
            const lon = parseFloat(info.pillar.lon);

            const killing = parseInt(info.killing || 0);
            const injuring = parseInt(info.injuring || 0);
            const beating = parseInt(info.beating || 0);

            if (killing > 0) {
                const icon = L.divIcon({
                    html: `<div style="background-color: red; width: 24px; height: 24px; border-radius: 50%; text-align: center; line-height: 24px; color: white; font-weight: bold; border: 1px solid black; font-size: 12px;">${killing}</div>`,
                    className: "",
                    iconSize: [24, 24],
                });
                L.marker([lat, lon], { icon }).addTo(markerLayer);
            }

            if (injuring > 0) {
                const icon = L.divIcon({
                    html: `<div style="background-color: green; width: 24px; height: 24px; border-radius: 50%; text-align: center; line-height: 24px; color: white; font-weight: bold; border: 1px solid black; font-size: 12px;">${injuring}</div>`,
                    className: "",
                    iconSize: [24, 24],
                });
                L.marker([lat + 0.01, lon + 0.01], { icon }).addTo(markerLayer);
            }

            if (beating > 0) {
                const icon = L.divIcon({
                    html: `<div style="background-color: orange; width: 24px; height: 24px; border-radius: 50%; text-align: center; line-height: 24px; color: black; font-weight: bold; border: 1px solid black; font-size: 12px;">${beating}</div>`,
                    className: "",
                    iconSize: [24, 24],
                });
                L.marker([lat - 0.01, lon - 0.01], { icon }).addTo(markerLayer);
            }
        }
    });
}
