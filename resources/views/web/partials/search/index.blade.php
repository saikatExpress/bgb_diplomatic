@extends('web.app')
@section('title', 'Search Claim')
@section('content')

    {{-- Page Loader --}}
    <div id="pageLoader" class="div_loader" style="display: none;">
        <!-- Logo -->
        <div style="margin-bottom: 10px;">
            <img src="{{ asset('assets/img/cover_logo.png') }}" alt="Logo" style="height: 200px; width: 200px;">
        </div>

        <!-- Loading text -->
        <div>Loading...</div>
    </div>
    {{-- Page Loader --}}

    <div class="form-body">
        <div class="left-form-content">
            <!-- <div class="top-title">Input Form</div> -->
            <div class="search-form">
                <div class="search-container">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" placeholder="Search..." class="search-input" />
                </div>
            </div>

            <div class="forms">
                <form action="{{ route('search.action') }}" method="POST" id="search-form">
                    @csrf
                    <div class="from-letter-by-select search-page-letter-by">
                        <!-- <span class="span-from-text">From</span> -->
                        <div>
                            <label for="#" class="letter-by-label">Letter By</label>
                            <select name="letter_by" id="letterBy" class="letter-by-select">
                                <option value="BGB">BGB</option>
                                <option value="BSF">BSF</option>
                            </select>
                        </div>
                        <div class="search-by-date-input">
                            <div>
                                <label for="#">From date: </label>
                                <input type="date" name="from_date" placeholder="From Date">
                            </div>
                            <div>
                                <label for="#">To date: </label>
                                <input type="date" name="to_date" placeholder="To Date">
                            </div>
                        </div>
                    </div>
                    <div class="form-border-area">
                        <span class="span-from-text">From Unit</span>
                        <div class="select-form-one" id="fromBox">
                            <select id="selectBgbRegion" name="bgb_region_id" class="select3">
                                <option value="" selected disabled>Select Region</option>
                                @foreach ($bgbregions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>

                            <select id="selectBgbSec" name="bgb_sec_id" class="select3">
                                <option value="" selected disabled>Select Sector</option>
                            </select>

                            <select id="selectBgbBattalion" name="bgb_battalion_id" class="select3">
                                <option value="" selected disabled>Select Battalion</option>
                            </select>

                            <select id="selectBgbCoy" name="bgb_coy_id" class="select3">
                                <option value="" selected disabled>Select Company</option>
                            </select>

                            <select id="selectBgbBop" name="bgb_bop_id" class="select3">
                                <option value="" selected disabled>Select BOP</option>
                            </select>
                        </div>

                        <div class="to-inputs">
                            <span class="span-to-text">To Unit</span>
                        </div>

                        <div class="select-form-two" id="toBox">
                            <select id="selectBsfRegion" name="bsf_region_id" class="select3">
                                <option value="" selected disabled>Select Frontier</option>
                                @foreach ($bsfregions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>

                            <select id="selectBsfSec" name="bsf_sec_id" class="select3">
                                <option value="" selected disabled>Select Sector</option>
                            </select>

                            <select id="selectBsfBattalion" name="bsf_battalion_id" class="select3">
                                <option value="" selected disabled>Select Battalion</option>
                            </select>

                            <select id="selectBsfCoy" name="bsf_coy_id" class="select3">
                                <option value="" selected disabled>Select Company</option>
                            </select>

                            <select id="selectBsfBop" name="bsf_bop_id" class="select3">
                                <option value="" selected disabled>Select BOP</option>
                            </select>
                        </div>

                        <div class="ltr-no-date">
                            <div class="form-group">
                                <label for="#">LTR No.</label>
                                <input type="text" name="letter_no" placeholder="NO." />
                            </div>
                            <div class="form-group">
                                <label for="#">LTR Date.</label>
                                <input type="date" name="letter_date" class="date-input" />
                            </div>
                        </div>

                        <!-- another part ltr date number -->
                        <div class="ltr-type-incident">
                            <div class="form-group3 search-page-form-group3">
                                <label for="#">Type Of Incident</label>
                                <select name="ltr_incident" class="select3">
                                    <option value="" selected disabled>Select Incident</option>
                                    @foreach ($incidents as $incident)
                                        <option value="{{ $incident->id }}">{{ $incident->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Piller No. Section -->
                        <div class="ltr-type-incident">
                            <div class="form-group3 search-page-form-group3">
                                <label for="#">Piller No.</label>
                                <select name="pillar_no" id="pillar_no" class="select3">
                                    <option value="" selected disabled>Select Piller</option>
                                    @foreach ($pillars as $pillar)
                                        <option value="{{ $pillar->id }}">{{ $pillar->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="ltr-type-incident">
                            <div class="form-group3 search-page-form-group3">
                                <label for="#">Sub Piller No.</label>
                                <select name="sub_pillar_no" id="sub_pillar_no" class="select3">
                                    <option value="" selected disabled>Select Sub Piller</option>
                                </select>
                            </div>
                        </div>

                        <div class="ltr-type-incident">
                            <div class="form-group3">
                                <label for="#">Distance From Zero Point</label>
                                <input type="text" id="distanceFromZero" class="form-control" name="distance_from_zero"
                                    placeholder="Enter Distance" />
                                <div>
                                    <select name="distance_unit" id="distanceUnit" class="select3">
                                        <option value="" selected disabled>Select Unit</option>
                                        <option value="meters">Meters</option>
                                        <option value="kilometers">Kilometers</option>
                                        <option value="miles">Miles</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Type of Incident Section -->

                        <!-- box check mark -->
                        <div class="box-checks">
                            <div class="form-group4">
                                @foreach ($tags as $tag)
                                    <label class="check-label d-flex align-items-center gap-2">
                                        <input type="checkbox" name="{{ $tag->input_name }}" value="150"
                                            class="custom-checkbox" />
                                        {{ filter($tag->title) }}
                                    </label>
                                @endforeach

                                <label class="check-label">
                                    <input type="checkbox" class="custom-checkbox" name="status" value="no_reply" />
                                    No Reply
                                </label>
                            </div>
                            <div class="form-group4">

                                <div class="border-label-group">
                                    <label for="killing">
                                        Killing
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-skull-crossbones input-icon"></i>
                                        <input type="text" id="killing" name="killing" placeholder="No. of Killing..." />
                                    </div>
                                </div>

                                <div class="border-label-group">
                                    <label for="injuring">
                                        Injuring
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-notes-medical input-icon"></i>
                                        <input type="text" id="injuring" name="injuring" placeholder="No. Of Injuring..." />
                                    </div>
                                </div>

                                <div class="border-label-group">
                                    <label for="beating"> Beating
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-hand-fist input-icon"></i>
                                        <input type="text" id="beating" name="beating" placeholder="No. Of Beating..." />
                                    </div>
                                </div>

                                <div class="border-label-group">
                                    <label for="firing"> Firing
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-fire input-icon"></i>
                                        <input type="text" id="firing" name="firing" placeholder="No. Of Firing..." />
                                    </div>
                                </div>

                                <div class="border-label-group">
                                    <label for="crossing"> Illegal Crossing
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-road input-icon"></i>
                                        <input type="text" id="crossing" name="crossing"
                                            placeholder="No. Of Illegal Crossing..." />
                                    </div>
                                </div>
                            </div>
                            {{-- Summary --}}
                            <div class="search-summary-table-result" id="summary_response_div" style="display: none;">
                                <h3 class="search-summary-result table-letter-heading_summary ">Summary</h3>
                                <div class="table-container">
                                    <table id="summary_res_table">
                                        <thead>
                                            <tr>
                                                <th>Main Letter</th>
                                                <th>Reference Letter</th>
                                                <th>Reply Letter</th>
                                                <th>No Reply Letter</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="summary_box"></div>
                            </div>
                            <div class="search-button">
                                <button type="button" id="searchBtn">Search</button>
                            </div>
                        </div>
                    </div>

                    <!-- Form table data show  -->
                    <div>
                        <h3 class="table-letter-heading table-letter-heading_one">Main Letter</h3>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Ltr Date</th>
                                        <th>Region</th>
                                        <th>Section</th>
                                        <th>Battalion</th>
                                        <th>Coy</th>
                                        <th>BOP</th>
                                        <th>Pillar No.</th>
                                        <th>Main Ltr</th>
                                        <th class="remarks">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        <h3 class="table-letter-heading table-letter-heading_two">All Ref (Connecting LTR)</h3>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Ltr Date</th>
                                        <th>Region</th>
                                        <th>Section</th>
                                        <th>Battalion</th>
                                        <th>Coy</th>
                                        <th>BOP</th>
                                        <th>Pillar No.</th>
                                        <th>Main Ltr</th>
                                        <th class="remarks">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        <h3 class="table-letter-heading table-letter-heading_three">Reply from BSF</h3>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Ltr Date</th>
                                        <th>Region</th>
                                        <th>Section</th>
                                        <th>Battalion</th>
                                        <th>Coy</th>
                                        <th>BOP</th>
                                        <th>Pillar No.</th>
                                        <th>Main Ltr</th>
                                        <th class="remarks">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="right-form-pdf" id="file-preview">
            <div class="top-title-pdf">Pdf View</div>
        </div>

        <div class="upload-print-button-bottom">
            <div class="left-btn">
                <div class="upload-btn">
                    <button type="button">Upload</button>
                </div>
            </div>
            <div class="right-btns">
                <div class="all-print-btn">
                    <button class="main-ltr-btn">Print Main Ltr</button>
                    <button class="all-ltr-btn">Print All Ltr</button>
                    <button class="all-ref-ltr-btn">Print All Ref Ltr</button>
                    <button class="bsf-btn">Print BSF Reply</button>
                    <button class="selected-btn">Print Selected</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select3').select2();
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#pillar_no').change(function () {
                var pillarId = $(this).val();
                if (pillarId) {
                    $.ajax({
                        type: "GET",
                        url: "/get/subpillars",
                        data: { pillar_id: pillarId },
                        success: function (res) {
                            if (res && res.subpillars) {
                                $("#sub_pillar_no").empty();
                                $("#sub_pillar_no").append('<option disabled>Select Sub Pillar</option>');
                                $.each(res.subpillars, function (key, value) {
                                    $("#sub_pillar_no").append('<option value="' + value.id + '">' + value.name + " (" + value.type.toUpperCase() + ")" + '</option>');
                                });
                            } else {
                                $("#sub_pillar_no").empty();
                            }
                        },
                        error: function () {
                            alert("Error loading sub pillars.");
                        }
                    });
                } else {
                    $("#sub_pillar_no").empty();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#searchBtn').on('click', function () {
                let form = $("#search-form");
                let url = form.attr("action");
                let formData = form.serialize();

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    success: function (response) {
                        const data = response.results;

                        var mainFile = 0;
                        var referenceFile = 0;
                        var replyFile = 0;
                        var noreplyFile = 0;

                        if (response && response.status == 'success') {
                            $('#summary_response_div').toggle();

                            mainFile = response.main;
                            referenceFile = response.reference;
                            replyFile = response.replyFile;
                            noreplyFile = response.noreplyFile;

                            const $tbody = $('#summary_res_table tbody');
                            $tbody.empty();

                            const tr = $("<tr></tr>");

                            tr.append($("<td></td>").text(mainFile));
                            tr.append($("<td></td>").text(referenceFile));
                            tr.append($("<td></td>").text(replyFile));
                            tr.append($("<td></td>").text(noreplyFile));

                            $tbody.append(tr);

                            const files = response.files;

                            populateFileTable(files, 'main', '.table-letter-heading_one + .table-container table tbody');
                            populateFileTable(files, 'ref', '.table-letter-heading_two + .table-container table tbody');
                            populateFileTable(files, 'reply-file', '.table-letter-heading_three + .table-container table tbody');

                        }

                        let totalKilling = 0;
                        let totalBeating = 0;
                        let totalFiring = 0;
                        let totalInjuring = 0;
                        let totalCrossing = 0;

                        let statusCount = {};

                        data.forEach(item => {
                            totalKilling += parseInt(item.killing) || 0;
                            totalBeating += parseInt(item.beating) || 0;
                            totalFiring += parseInt(item.firing) || 0;
                            totalInjuring += parseInt(item.injuring) || 0;
                            totalCrossing += parseInt(item.crossing) || 0;

                            let status = item.status || 'unknown';
                            statusCount[status] = (statusCount[status] || 0) + 1;
                        });

                        // Build paragraph summary text
                        let statusText = Object.entries(statusCount)
                            .map(([status, count]) => `${count} with status "${status}"`)
                            .join(", ");

                        let summaryText = `In total, there were ${totalKilling} killings, ${totalBeating} beatings, ${totalFiring} firings, ${totalInjuring} injuries, and ${totalCrossing} crossings reported. The records include ${statusText}.`;

                        // Show in summary_box div
                        $('#summary_box').html(`<p style="font-size:20px;color:teal;">${summaryText}</p>`);
                    },
                    error: function (xhr) {
                        console.error(xhr);
                        alert("Something went wrong while searching.");
                    },
                });
            });

            function populateFileTable(files, prefix, tbodySelector) {
                const filteredFiles = files.filter(f => f.file_prefix === prefix);
                const $tbody = $(tbodySelector);
                $tbody.empty();

                filteredFiles.forEach((file, index) => {
                    const tr = $('<tr></tr>');

                    const id = file.id;

                    tr.append(`<td>${index + 1}</td>`);
                    tr.append(`<td>${file.created_at?.split('T')[0] || ''}</td>`);

                    const fileName = file.file_path.replace(
                        "/storage/letter_files/",
                        ""
                    );

                    if (file.letter_by === 'BGB') {
                        tr.append(`<td>${file.bgb_region_name ? file.bgb_region_name : 'N/A'}</td>`);
                        tr.append(`<td>${file.bgb_sector_name ? file.bgb_sector_name : 'N/A'}</td>`);
                        tr.append(`<td>${file.bgb_battalion_name ? file.bgb_battalion_name : 'N/A'}</td>`);
                        tr.append(`<td>${file.bgb_coy_name ? file.bgb_coy_name : 'N/A'}</td>`);
                        tr.append(`<td>${file.bgb_bop_name ? file.bgb_bop_name : 'N/A'}</td>`);
                    } else {
                        tr.append(`<td>${file.bsf_region_name ? file.bsf_region_name : 'N/A'}</td>`);
                        tr.append(`<td>${file.bsf_sector_name ? file.bsf_sector_name : 'N/A'}</td>`);
                        tr.append(`<td>${file.bsf_battalion_name ? file.bsf_battalion_name : 'N/A'}</td>`);
                        tr.append(`<td>${file.bsf_coy_name ? file.bsf_coy_name : 'N/A'}</td>`);
                        tr.append(`<td>${file.bsf_bop_name ? file.bsf_bop_name : 'N/A'}</td>`);
                    }

                    tr.append(`<td>${file.pillar_name ? file.pillar_name : ''}</td>`);
                    tr.append($("<td></td>").text(fileName));

                    const $showBtn = $(
                        '<button type="button" class="btn btn-sm btn-primary">Show</button>'
                    ).on("click", function () {
                        showFile(file.file_path);
                    });

                    const $deleteBtn = $(
                        '<button type="button" class="btn btn-sm btn-danger">Delete</button>'
                    ).on("click", function () {
                        deleteFileMedia(id, tr);
                    });

                    const $tdActions = $("<td></td>").append($showBtn, $deleteBtn);

                    tr.append($tdActions);

                    $tbody.append(tr);
                });
            }


            function deleteFileMedia(id, rowElement) {
                if (id > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "/delete/file/" + id,
                                type: "GET",
                                success: function (response) {
                                    if (response && response.status == "success") {
                                        toastr.success("Removed successfully!");
                                        if (rowElement) {
                                            rowElement.remove();
                                        }
                                    } else {
                                        toastr.error("Failed to delete the file.");
                                    }
                                },
                                error: function () {
                                    toastr.error("Something went wrong!");
                                },
                            });
                        }
                    });
                }
            }


            function showFile(filePath) {
                const $preview = $("#file-preview");
                $preview.empty();

                $preview.append('<div class="top-title-pdf">Pdf View</div>');

                const $iframe = $("<iframe>", {
                    src: filePath
                }).css({
                    width: "100%",
                    height: "119rem",
                    border: "none"
                });

                $preview.append($iframe);
            }
        });
    </script>
@endpush
