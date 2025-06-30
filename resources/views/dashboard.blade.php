@extends('web.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endpush
@section('title', 'Dashboard')
@section('content')

    {{-- Page Loader --}}
    <div id="pageLoader" class="div_loader" style="display: none;">
        <!-- Logo -->
        <div style="margin-bottom: 10px;">
            <img src="{{ asset('assets/img/cover_logo.png') }}" alt="Logo" style="height: 500px; width: 500px;">
        </div>

        <!-- Loading text -->
        <div>NORTH EAST REGION</div>
    </div>
    {{-- Page Loader --}}


    <div class="form-body">
        <div class="left-form-content">
            <div class="top-title">Input Form</div>
            <div class="forms">
                <form action="{{ route('action.store') }}" method="post" id="actionForm" enctype="multipart/form-data">
                    @csrf
                    <div class="from-letter-by-select">
                        <label for="#" class="letter-by-label">Letter By</label>
                        <select name="letter_by" id="letterBy" class="letter-by-select">
                            <option value="BGB">BGB</option>
                            <option value="BSF">BSF</option>
                        </select>
                    </div>
                    <div class="form-border-area">
                        <span class="span-from-text">From</span>
                        <div class="select-form-one" id="fromBox">
                            <select id="selectBgbRegion" name="bgb_region_id" class="select3">
                                <option value="" selected disabled>Select Region</option>
                                @foreach ($bgbRegions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>

                            <select id="selectBgbSec" name="bgb_sec_id" class="select3">
                                <option>Select SEC</option>
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
                            <span class="span-to-text">To</span>
                        </div>
                        <div class="select-form-two" id="toBox">
                            <select id="selectBsfRegion" name="bsf_region_id" class="select3">
                                <option value="" selected disabled>Select Frontier</option>
                                @foreach ($bsfRegions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>

                            <select id="selectBsfSec" name="bsf_sec_id" class="select3">
                                <option>Select SEC</option>
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
                        <div class="ltr-no-date">
                            <div class="form-group">
                                <label for="#">LTR No.</label>
                                <input type="text" name="letter_no" id="letter_no" placeholder="NO." />
                                <div class="invalid-feedback" id="error_letter_no"></div>
                            </div>
                            <div class="form-group">
                                <label for="#">LTR Date.</label>
                                <input type="date" name="letter_date" class="date-input" />
                            </div>
                        </div>
                        <!-- Subject Section -->
                        <div class="ltr-subject">
                            <div class="form-group2">
                                <label for="#">LTR Sub</label>
                                <select name="ltr_subject" id="ltrSubjectSelect" class="select3">
                                    <option>Select Subject</option>
                                    @foreach ($ltrs as $ltr)
                                        <option value="{{ $ltr->id }}">{{ $ltr->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" data-toggle="modal" data-target="#ltrModal">
                                    <span style="margin-right: 10px;">+</span> Add New
                                </button>
                            </div>
                        </div>

                        <!-- Type of Incident Section -->
                        <div class="ltr-type-incident">
                            <div class="form-group3">
                                <label for="#">Type Of Incident</label>
                                <select id="incidentSelect" name="incident_id" class="select3">
                                    <option>Select Subject</option>
                                    @foreach ($incidents as $incident)
                                        <option value="{{ $incident->id }}">{{ $incident->title }}</option>
                                    @endforeach
                                </select>
                                <button type="button" data-toggle="modal" data-target="#incidentModal">
                                    <span style="margin-right: 10px;">+</span> Add New
                                </button>
                            </div>
                        </div>

                        <!-- Type of Incident Section -->
                        <div class="ltr-type-incident">
                            <div class="form-group3">
                                <label for="#">Pillar No.</label>
                                <select id="pillarSelect" name="pillar_id" class="select3">
                                    <option>Select Subject</option>
                                    @foreach ($pillars as $pillar)
                                        <option value="{{ $pillar->id }}">{{ $pillar->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addPillarModal">
                                    <span style="margin-right: 10px;">+</span> Add New
                                </button>
                            </div>
                        </div>

                        <div class="ltr-type-incident">
                            <div class="form-group3">
                                <label for="#">Sub Pillar No.</label>
                                <select id="subpillarSelect" name="subpillar_id" class="select3">
                                    <option>Select Subject</option>
                                    @foreach ($subpillars as $subpillar)
                                        <option value="{{ $subpillar->id }}">{{ $subpillar->name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addSubPillarModal">
                                    <span style="margin-right: 10px;">+</span> Add New
                                </button>
                            </div>
                        </div>

                        <div class="ltr-type-incident">
                            <div class="form-group3">
                                <label for="#">Distance From Zero Point</label>
                                <input type="text" id="distanceFromZero" class="form-control" name="distance_from_zero"
                                    placeholder="Enter Distance" />
                                <div>
                                    <select name="distance_unit" id="distanceUnit">
                                        <option value="" selected>Select Unit</option>
                                        <option value="meters">Meters</option>
                                        <option value="kilometers">Kilometers</option>
                                        <option value="miles">Miles</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- box check mark -->
                        <div class="box-checks">
                            <div class="form-group4">
                                @foreach ($tags as $tag)
                                    <label class="check-label d-flex align-items-center gap-2">
                                        <input type="checkbox" name="{{ $tag->input_name }}" value="{{ $tag->input_name }}"
                                            class="custom-checkbox" />
                                        {{ $tag->title }}
                                    </label>
                                @endforeach
                            </div>
                            <!-- form group4 second -->
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
                        </div>
                    </div>

                    <!-- =============== -->
                    <div class="upload-container">
                        <div class="upload-card" style="height: 150px !important;">
                            <label class="upload-label">
                                <div class="upload-title">Main Letter</div>
                                <div class="upload-box">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="upload-instruction">Drag / Drop file here</span>
                                    <input type="file" class="file-input" id="fileInput" multiple accept="application/pdf">
                                </div>
                            </label>
                        </div>

                        <div class="upload-card" style="height: 150px !important;">
                            <label class="upload-label">
                                <div class="upload-title upload-title-two">All Ref (Connecting LTR)</div>
                                <div class="upload-box">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="upload-instruction">Drag / Drop file here</span>
                                    <input type="file" class="file-input" id="refFileInput" multiple
                                        accept="application/pdf">
                                </div>
                            </label>
                        </div>

                        <div class="upload-card" id="uploadCard" style="height: 150px !important;">
                            <label class="upload-label">
                                <div class="upload-title upload-title-three" id="uploadTitle">Reply from BSF
                                </div>
                                <div class="upload-box">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="upload-instruction">Drag / Drop file here</span>

                                    <input type="file" class="file-input" id="replyFile" name="bgb_reply" multiple
                                        accept="application/pdf">

                                </div>
                            </label>
                        </div>

                    </div>

                    <!-- Form table data show  -->
                    <div>
                        <h3 class="table-letter-heading table-letter-heading_one">Main Letter</h3>
                        <div class="table-container">
                            <table id="fileTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectAllFiles"></th>
                                        <th>Sl No.</th>
                                        <th>Ltr Date</th>
                                        <th>Region</th>
                                        <th>Sector</th>
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
                            <table id="refFileTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectRefAllFiles"></th>
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
                        <h3 class="table-letter-heading table-letter-heading_three" id="replyHeading">
                            Reply from BSF
                        </h3>
                        <div class="table-container">
                            <table id="replyFileTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="selectActionAllFiles"></th>
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
                <button type="button" id="actionFormBtn">Upload</button>
            </div>
        </div>

        <div class="right-btns">
            <div class="all-print-btn">
                <button class="main-ltr-btn" id="printMainLtrBtn">Print Main Ltr</button>
                <button class="all-ltr-btn" id="printAllLtrBtn">Print All Ltr</button>
                <button class="all-ref-ltr-btn" id="printAllRefLtrBtn">Print All Ref Ltr</button>
                <button class="bsf-btn" id="printReplyBtn">Print BSF Reply</button>
                <button class="selected-btn" id="printSelectedBtn">Print Selected</button>
            </div>
        </div>
    </div>

    {{-- Incident Modal Start --}}
    <div class="modal fade" id="incidentModal" tabindex="-1" role="dialog" aria-labelledby="incidentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="incidentModalLabel">Add New Incident</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('incidents.store') }}" method="post" id="incidentForm">
                        @csrf
                        <div class="form-group">
                            <label for="incidentDescription">Incident Title</label>
                            <input type="text" id="incidentTitle" class="form-control" name="title"
                                placeholder="Enter Incident Title" required />
                        </div>
                        <div class="form-group">
                            <label for="incidentDescription">Incident Description</label>
                            <textarea id="incidentDescription" class="form-control" name="description" rows="3"
                                required></textarea>
                        </div>

                        <button type="button" id="submitIncident" class="btn btn-primary">Save Incident</button>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    {{-- Incident Modal End --}}

    {{-- Pillar Modal Start --}}
    <div class="modal fade" id="addPillarModal" tabindex="-1" role="dialog" aria-labelledby="addPillarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addNewModalLabel">Add New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="pillarForm" action="{{ route('pillars.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="pillarName">Pillar Name</label>
                            <input type="text" id="pillarName" class="form-control" name="pillar_name"
                                placeholder="Enter Pillar Name" required />
                        </div>
                        <button type="button" id="submitPillar" class="btn btn-primary">Save Pillar</button>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    {{-- Pillar Modal End --}}

    {{-- Sub Pillar Modal Start --}}
    <div class="modal fade" id="addSubPillarModal" tabindex="-1" role="dialog" aria-labelledby="addSubPillarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addSubPillarModal">Add Sub Pillar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="subPillarForm" action="{{ route('subpillars.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="subPillarName">Pillar Name</label>
                            <select name="pillar_id" class="form-control" required>
                                <option value="">Select Pillar</option>
                                @foreach ($pillars as $pillar)
                                    <option value="{{ $pillar->id }}">{{ $pillar->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subPillarName">Sub Pillar Name</label>
                            <input type="text" id="subPillarName" class="form-control" name="sub_pillar_name"
                                placeholder="Enter Sub Pillar Name" required />
                        </div>

                        <div class="form-group">
                            <label for="subPillarName">Type</label>
                            <select name="type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="s">S</option>
                                <option value="t">T</option>
                                <option value="r">R</option>
                                <option value="pool">Pool</option>
                            </select>
                        </div>
                        <button type="button" id="submitSubPillar" class="btn btn-primary">Save Sub Pillar</button>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    {{-- Pillar Modal End --}}

    {{-- LTR Modal Start --}}
    <div class="modal fade" id="ltrModal" tabindex="-1" role="dialog" aria-labelledby="ltrModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="ltrModalLabel">Add New LTR Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="ltrForm" action="{{ route('ltrs.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="ltrName">LTR Subject Name</label>
                            <input type="text" id="ltrName" class="form-control" name="ltr_name"
                                placeholder="Enter LTR Subject Name" required />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submitLtr">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- LTR Modal End --}}
@endsection

@push('script')
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    <script src="{{ asset('assets/js/home.js') }}"></script>
    <script src="{{ asset('assets/js/form.js') }}"></script>
    <script src="{{ asset('assets/js/main_file.js') }}"></script>
    <script src="{{ asset('assets/js/ref_file.js') }}"></script>
    <script src="{{ asset('assets/js/reply_file.js') }}"></script>
    <script src="{{ asset('assets/js/action.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.select3').select2();
        });
    </script>
@endpush
