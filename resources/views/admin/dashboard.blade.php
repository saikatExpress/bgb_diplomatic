<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>

<body>
    <div class="top-header" style="background-image: url('{{ asset('assets/img/header.jpg') }}');">
        <div class="container">
            <div class="heading-content-parent">
                <div class="logo-area">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/img/logo.png') }}" class="" width="160px" alt="BGB logo">
                    </a>
                </div>

                @include('web.layouts.header')

                <div>
                    <div class="white-space"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="my-container">

            <form action="{{ route('dashboard.search') }}" method="POST" id="dashboardForm">
                @csrf
                <div class="container py-4">
                    <div class="row justify-content-end align-items-center g-3">
                        <!-- From Date -->
                        <div class="col-12 col-md-3">
                            <div class="d-flex align-items-center">
                                <label for="from" class="form-label mb-0 text-white flex-shrink-0"
                                    style="width: 50px;">From</label>
                                <input type="date" id="from" name="form_date" class="form-control form-control-sm ms-2">
                            </div>
                        </div>

                        <!-- To Date -->
                        <div class="col-12 col-md-3">
                            <div class="d-flex align-items-center">
                                <label for="to" class="form-label mb-0 text-white flex-shrink-0"
                                    style="width: 50px;">To</label>
                                <input type="date" id="to" name="to_date" class="form-control form-control-sm ms-2">
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="col-12 col-md-2 d-flex justify-content-start">
                            <button class="btn btn-primary btn-sm w-100" type="button" id="dashboardformBtn">
                                Search
                            </button>
                        </div>
                    </div>
                </div>

            </form>

            <div class="bgb-protest" id="bgb-protest-data">
                <div class="bgb-heading-title-img">
                    <h5 class="bgb-heading-title">BGB Protest</h5>
                    <img src="{{ asset('assets/img/logo.png') }}" width="60" height="auto" alt="logo">
                </div>
                <!-- form group4 second -->
                <div class="bgb-protest-box">
                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="killing_number_bgb">{{ ($bgbInfo->totalKilling > 0) ? $bgbInfo->totalKilling : 0 }}</span>
                        <span>Killing</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="firing_number_bgb">{{ ($bgbInfo->totalfiring > 0) ? $bgbInfo->totalfiring : 0 }}</span>
                        <span>Firing</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="injuiring_number_bgb">{{ ($bgbInfo->totalinjuring > 0) ? $bgbInfo->totalinjuring : 0 }}</span>
                        <span>Injuring</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="crossing_number_bgb">{{ ($bgbInfo->totalcrossing > 0) ? $bgbInfo->totalcrossing : 0 }}</span>
                        <span>Crossing</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="beating_number_bgb">{{ ($bgbInfo->totalbeating > 0) ? $bgbInfo->totalbeating : 0 }}</span>
                        <span>Beating</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number" id="bgb_main">{{ $filesInfo->BGB->main }}</span>
                        <span>Main Letter</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number" id="bgb_ref">{{ $filesInfo->BGB->ref }}</span>
                        <span>Reference Letter</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">
                            <span style="color: red !important;"
                                id="bgb_no_reply">{{ $replyInfo->BGB->no_reply }}</span> / <span
                                style="color: green !important"
                                id="bgb_reply">{{ $filesInfo->BGB->reply }}</span></span>
                        <span>Reply Letter</span>
                    </p>
                </div>
            </div>
            <div class="bsf-protest">
                <div class="bgb-heading-title-img">
                    <h5 class="bgb-heading-title">BSF Protest</h5>
                    <img src="{{ asset('assets/img/logo.png') }}" width="60" height="auto" alt="logo">
                </div>
                <!-- form group4 second -->
                <div class="bgb-protest-box">
                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="killing_number_bsf">{{ ($bsfInfo->totalKilling > 0) ?: 0 }}</span>
                        <span>Killing</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="firing_number_bsf">{{ ($bsfInfo->totalfiring > 0) ? $bsfInfo->totalfiring : 0 }}</span>
                        <span>Firing</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="injuiring_number_bsf">{{ ($bsfInfo->totalinjuring > 0) ? $bsfInfo->totalinjuring : 0 }}</span>
                        <span>Injuring</span>
                    </p>

                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="beating_number_bsf">{{ ($bsfInfo->totalbeating > 0) ? $bsfInfo->totalbeating : 0 }}</span>
                        <span>Beating</span>
                    </p>

                    <p class="killing-bsf-box">
                        <span class="killing-number"
                            id="crossing_number_bsf">{{ ($bsfInfo->totalcrossing > 0) ? $bsfInfo->totalcrossing : 0 }}</span>
                        <span>Crossing</span>
                    </p>

                    <p class="killing-bsf-box">
                        <span class="killing-number" id="bsf_main">{{ $filesInfo->BSF->main }}</span>
                        <span>Main Letter</span>
                    </p>

                    <p class="killing-bsf-box">
                        <span class="killing-number" id="bsf_ref">{{ $filesInfo->BSF->ref }}</span>
                        <span>Reference Letter</span>
                    </p>
                    <p class="killing-bsf-box">
                        <span class="killing-number">
                            <span style="color: red !important;"
                                id="bsf_no_reply">{{ $replyInfo->BSF->no_reply }}</span> /
                            <span style="color: green !important;" id="bsf_reply">{{ $filesInfo->BSF->reply  }}</span>
                        </span>
                        <span>Reply Letter</span>
                    </p>
                </div>
            </div>

            {{-- Add input Fields Start--}}
            <form action="{{ route('chart.form') }}" method="post" id="chartForm">
                @csrf
                <div class="container py-4">
                    <div class="row g-3 align-items-center justify-content-start flex-wrap">

                        <!-- Letter by -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="d-flex align-items-center">
                                <label for="letterBy" class="form-label mb-0 text-white flex-shrink-0 me-2">Letter
                                    by</label>
                                <select id="letterBy" name="letter_by" class="form-select form-select-sm">
                                    <option value="" selected disabled>Select</option>
                                    <option value="BGB">BGB</option>
                                    <option value="BSF">BSF</option>
                                </select>
                            </div>
                        </div>

                        <!-- Select Year -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="d-flex align-items-center">
                                <label for="selectYear"
                                    class="form-label mb-0 text-white flex-shrink-0 me-2">Year</label>
                                <select id="selectYear" name="year" class="form-select form-select-sm">
                                    <option value="" selected disabled>Select</option>
                                    @for ($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Select Month -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="d-flex align-items-center">
                                <label for="selectMonth"
                                    class="form-label mb-0 text-white flex-shrink-0 me-2">Month</label>
                                <select id="selectMonth" name="month" class="form-select form-select-sm">
                                    <option value="" selected disabled>Select</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </div>

                        <!-- From Date -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="d-flex align-items-center">
                                <label for="fromDate" class="form-label mb-0 text-white flex-shrink-0 me-2">From</label>
                                <input type="date" id="fromDate" name="from_date" class="form-control form-control-sm">
                            </div>
                        </div>

                        <!-- To Date -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="d-flex align-items-center">
                                <label for="toDate" class="form-label mb-0 text-white flex-shrink-0 me-2">To</label>
                                <input type="date" id="toDate" name="to_date" class="form-control form-control-sm">
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <button class="btn btn-primary btn-sm w-100" type="button" id="chartformBtn">
                                Search
                            </button>
                        </div>

                    </div>
                </div>
            </form>

            {{-- Add input Fields End --}}
            <div class="row" style="background-color: #fff;">

                <div class="col-md-3 text-center">
                    <canvas id="killingChart" style="width:600px; height:600px;"></canvas>
                </div>
                <div class="col-md-3 text-center">
                    <canvas id="injuringChart" style="width:600px; height:600px;"></canvas>
                </div>
                <div class="col-md-3 text-center">
                    <canvas id="beatingChart" style="width:600px; height:600px;"></canvas>
                </div>
                <div class="col-md-3 text-center">
                    <canvas id="firingChart" style="width:600px; height:600px;"></canvas>
                </div>
                <div class="col-md-3 text-center">
                    <canvas id="crossingChart" style="width:600px; height:600px;"></canvas>
                </div>
            </div>

        </div>
    </div>
</body>

<script src="{{ asset('assets/css/dashboard.css') }}"></script>

<script>
    $(document).ready(function () {
        $('#chartformBtn').on('click', function () {
            let chartform = $('#chartForm');
            let url = chartform.attr('action');
            let type = chartform.attr('method');
            let chartformData = chartform.serialize();

            $.ajax({
                type: type,
                url: url,
                data: chartformData,
                success: function (response) {
                    const monthlyData = response.totals;

                    createMonthlyIncidentChart('killingChart', 'Killing', 'killing', monthlyData);
                    createMonthlyIncidentChart('injuringChart', 'Injuring', 'injuring', monthlyData);
                    createMonthlyIncidentChart('beatingChart', 'Beating', 'beating', monthlyData);
                    createMonthlyIncidentChart('firingChart', 'Firing', 'firing', monthlyData);
                    createMonthlyIncidentChart('crossingChart', 'Crossing', 'crossing', monthlyData);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script>
    const monthlyData = @json($totals);

    function prepareChartData(incidentType) {
        const labels = [];
        const bgbData = [];
        const bsfData = [];

        Object.keys(monthlyData).forEach(month => {
            labels.push(month);
            const monthEntries = monthlyData[month];

            const bgbRow = monthEntries.find(e => e.letter_by === "BGB");
            const bsfRow = monthEntries.find(e => e.letter_by === "BSF");

            bgbData.push(bgbRow ? bgbRow[incidentType] : 0);
            bsfData.push(bsfRow ? bsfRow[incidentType] : 0);
        });

        return { labels, bgbData, bsfData };
    }

    function createMonthlyIncidentChart(canvasId, label, incidentType) {
        const ctx = document.getElementById(canvasId)?.getContext('2d');
        if (!ctx) {
            console.error('Canvas element not found: ' + canvasId);
            return;
        }
        const { labels, bgbData, bsfData } = prepareChartData(incidentType);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'BGB',
                        data: bgbData,
                        backgroundColor: '#36A2EB'
                    },
                    {
                        label: 'BSF',
                        data: bsfData,
                        backgroundColor: '#FF6384'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: label + ' (Month Wise)',
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        createMonthlyIncidentChart('killingChart', 'Killing', 'killing');
        createMonthlyIncidentChart('injuringChart', 'Injuring', 'injuring');
        createMonthlyIncidentChart('beatingChart', 'Beating', 'beating');
        createMonthlyIncidentChart('firingChart', 'Firing', 'firing');
        createMonthlyIncidentChart('crossingChart', 'Crossing', 'crossing');
    });
</script>

<script>
    document
        .querySelectorAll('.custom-file-input input[type="file"]')
        .forEach((input) => {
            const label = input.previousElementSibling;

            input.addEventListener("change", () => {
                const fileName = input.files.length
                    ? input.files[0].name
                    : "Add Files......";
                label.textContent = fileName;
            });
        });
</script>

</html>
