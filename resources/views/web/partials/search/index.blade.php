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
                                <input type="date" placeholder="From Date">
                            </div>
                            <div>
                                <label for="#">To date: </label>
                                <input type="date" placeholder="To Date">
                            </div>
                        </div>
                    </div>
                    <div class="form-border-area">
                        <span class="span-from-text">From Unit</span>
                        <div class="select-form-one" id="fromBox">
                            <select id="selectBgbRegion" name="bgb_region_id" class="select3">
                                <option>Select Region</option>
                                @foreach ($bgbregions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>

                            <select id="selectBgbSec" name="bgb_sec_id" class="select3">
                                <option>Select Sector</option>
                            </select>

                            <select id="selectBgbBattalion" name="bgb_battalion_id" class="select3">
                                <option>Select Battalion</option>
                            </select>

                            <select id="selectBgbCoy" name="bgb_coy_id" class="select3">
                                <option>Select Company</option>
                            </select>

                            <select id="selectBgbBop" name="bgb_bop_id" class="select3">
                                <option>Select BOP</option>
                            </select>
                        </div>

                        <div class="to-inputs">
                            <span class="span-to-text">To Unit</span>
                        </div>

                        <div class="select-form-two" id="toBox">
                            <select id="selectBsfRegion" name="bsf_region_id" class="select3">
                                <option>Select Frontier</option>
                                @foreach ($bsfregions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>

                            <select id="selectBsfSec" name="bsf_sec_id" class="select3">
                                <option>Select Sector</option>
                            </select>

                            <select id="selectBsfBattalion" name="bsf_battalion_id" class="select3">
                                <option>Select Battalion</option>
                            </select>

                            <select id="selectBsfCoy" name="bsf_coy_id" class="select3">
                                <option>Select Company</option>
                            </select>

                            <select id="selectBsfBop" name="bsf_bop_id" class="select3">
                                <option>Select BOP</option>
                            </select>
                        </div>
                        <!-- another part ltr date number -->
                        <div class="ltr-type-incident">
                            <div class="form-group3 search-page-form-group3">
                                <label for="#">Type Of Incident</label>
                                <select class="select3">
                                    <option>Select Incident</option>
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
                                    <option>Select Piller</option>
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
                                    <option>Select Sub Piller</option>
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
                                        <option value="" selected>Select Unit</option>
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
                                <label class="check-label d-flex align-items-center gap-2">
                                    <input type="checkbox" name="distance" value="150" class="custom-checkbox" />
                                    Within 150km
                                </label>

                                <label class="check-label">
                                    <input type="checkbox" class="custom-checkbox" name="distance" value="outside-150km" />
                                    OutSide 150km
                                </label>

                                <label class="check-label">
                                    <input type="checkbox" class="custom-checkbox" name="location" value="inside-bd" />
                                    Inside BD
                                </label>

                                <label class="check-label">
                                    <input type="checkbox" class="custom-checkbox" name="location" value="inside-india" />
                                    Inside India
                                </label>

                                <label class="check-label">
                                    <input type="checkbox" class="custom-checkbox" name="no_reply" value="other" />
                                    No Reply
                                </label>

                                <label class="check-label">
                                    <input type="checkbox" class="custom-checkbox" name="other" value="other" />
                                    Other
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
@endsection

@push('script')
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
                                $("#sub_pillar_no").append('<option>Select Sub Pillar</option>');
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
                        if (response.success) {
                            console.log(response);

                            const data = response.data;

                            // Clear previous rows
                            $(".table-container tbody").empty();

                            // Group by letter_no
                            const grouped = {};
                            data.forEach(item => {
                                if (!grouped[item.letter_no]) {
                                    grouped[item.letter_no] = [];
                                }
                                grouped[item.letter_no].push(item);
                            });

                            // Track serial number
                            let slMain = 1, slRef = 1, slReply = 1;

                            // Loop each letter
                            for (const letterNo in grouped) {
                                const files = grouped[letterNo];

                                // Since all files share the same letter data, pick first as "base"
                                const base = files[0];

                                // Find files by prefix
                                const mainFile = files.find(f => f.file_prefix === "main");
                                const refFiles = files.filter(f => f.file_prefix === "ref");
                                const replyFiles = files.filter(f => f.file_prefix === "reply-file");

                                // Region etc names
                                const region = base.bgb_region_name ?? '';
                                const sector = base.bgb_sector_name ?? '';
                                const battalion = base.bgb_battalion_name ?? '';
                                const coy = base.bgb_coy_name ?? '';
                                const bop = base.bgb_bop_name ?? '';
                                const pillar = base.pillar_id ?? '';

                                // Build row HTML
                                function makeRow(sl, file, killing, firing) {
                                    return `
        <tr>
            <td>${sl}</td>
            <td>${base.letter_date}</td>
            <td>${region}</td>
            <td>${sector}</td>
            <td>${battalion}</td>
            <td>${coy}</td>
            <td>${bop}</td>
            <td>${pillar}</td>
            <td><a href="${file.file_path}" target="_blank">View File</a></td>
            <td>
                Killing: ${killing ?? 0}, Firing: ${firing ?? 0}
            </td>
        </tr>
                                    `;
                                }

                                // Add main file row
                                if (mainFile) {
                                    $("div.table-container:eq(0) tbody").append(
                                        makeRow(slMain++, mainFile, base.killing, base.firing)
                                    );
                                }

                                // Add ref files rows
                                refFiles.forEach(file => {
                                    $("div.table-container:eq(1) tbody").append(
                                        makeRow(slRef++, file, base.killing, base.firing)
                                    );
                                });

                                // Add reply files rows
                                replyFiles.forEach(file => {
                                    $("div.table-container:eq(2) tbody").append(
                                        makeRow(slReply++, file, base.killing, base.firing)
                                    );
                                });
                            }
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr);
                        alert("Something went wrong while searching.");
                    },
                });
            });
        });
    </script>
@endpush
