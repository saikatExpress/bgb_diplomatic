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

                        <div class="form-group3">
                            <label for="#">Pillar No.</label>
                            <div class="form-group3-select-items">
                                <div class="input-wrapper">
                                    <select name="pillar_no" id="pillar_no" class="select3">
                                        <option value="" selected disabled>Select Pillar</option>
                                        @foreach ($pillars as $pillar)
                                            <option value="{{ $pillar->id }}">
                                                {{ $pillar->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="error_pillar_id" class="text-danger"></span>
                                </div>

                                <span class="slash">/</span>

                                <div class="input-wrapper">
                                    <input type="text" id="subpillar_id" name="subpillar_id" placeholder="Put Sub Pillar">
                                </div>

                                <div class="dropdown-wrapper">
                                    <select name="subpillar_type" id="subpillar_type" class="select3">
                                        <option value="" selected>Select Type</option>
                                        <option value="s">S</option>
                                        <option value="t">T</option>
                                        <option value="r">R</option>
                                        <option value="pool">Pool</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPillarModal">
                                <span style="margin-right: 10px;">+</span> Add New
                            </button>
                        </div>

                        <div class="ltr-type-incident">
                            <div class="form-group3">
                                <label for="#">Distance From Zero Point</label>
                                <input type="text" id="distanceFromZero" class="form-control" name="distance_from_zero"
                                    placeholder="Enter Distance" />
                                <div>
                                    <select name="distance_unit" id="distanceUnit" class="select3">
                                        <option value="" selected disabled>Select Unit</option>
                                        @foreach ($units as $unit)
                                            <option value="{{ $unit->slug }}">{{ $unit->name }}</option>
                                        @endforeach
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
                                        <input type="checkbox" name="tags[]" value="{{ $tag->input_name }}"
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
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="table-letter-heading table-letter-heading_one">Main Letter</h3>
                            <a href="" id="printMainTableBtn">Print</a>
                        </div>
                        <div class="table-container">
                            <table id="main_letter_table_print">
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
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="table-letter-heading table-letter-heading_two">All Ref (Connecting LTR)</h3>
                            <a href="" id="printRefTableBtn">Print</a>
                        </div>
                        <div class="table-container">
                            <table id="ref_letter_table_print">
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
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="table-letter-heading table-letter-heading_three">Reply Letter</h3>
                            <a href="" id="printReplyTableBtn">Print</a>
                        </div>
                        <div class="table-container">
                            <table id="reply_file_table_print">
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
                    <button type="button" class="main-ltr-btn" id="printMainLtrBtn">Print Main Ltr</button>
                    <button type="button" class="all-ltr-btn" id="printAllLtrBtn">Print All Ltr</button>
                    <button type="button" class="all-ref-ltr-btn" id="printAllRefLtrBtn">Print All Ref Ltr</button>
                    <button type="button" class="bsf-btn" id="printReplyBtn">Print Reply Letter</button>
                    <button type="button" class="selected-btn" id="printSelectedBtn">Print Selected</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>

    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script src="{{ asset('assets/js/search_form.js') }}"></script>
    <script src="{{ asset('assets/js/print_table.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select3').select2();
        });
    </script>
@endpush
