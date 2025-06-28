@extends('web.app')
@section('title', 'Search Claim')
@section('content')
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
                <form action="#">
                    <div class="from-letter-by-select search-page-letter-by">
                        <!-- <span class="span-from-text">From</span> -->
                        <div>
                            <label for="#" class="letter-by-label">Letter By</label>
                            <select name="" id="" class="letter-by-select">
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
                        <div class="select-form-one">
                            <select>
                                <option>Rigion HQ</option>
                                <option>Rigion HQ, Sarail</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select SEC</option>
                                <option>Option A</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Battalion</option>
                                <option>Battalion</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select HQ</option>
                                <option>Select HQ</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select Bop</option>
                                <option>Select Bop</option>
                                <option>Option B</option>
                            </select>
                        </div>
                        <div class="to-inputs">
                            <span class="span-to-text">To Unit</span>
                        </div>
                        <div class="select-form-two">
                            <select>
                                <option>BSF Rigion</option>
                                <option>BSF Rigion</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select SEC</option>
                                <option>Option A</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Battalion</option>
                                <option>Battalion</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select HQ</option>
                                <option>Select HQ</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select BOP</option>
                                <option>Select BOP</option>
                                <option>Option B</option>
                            </select>
                        </div>
                        <!-- another part ltr date number -->
                        <!-- Piller No. Section -->
                        <div class="ltr-type-incident">
                            <div class="form-group3 search-page-form-group3">
                                <label for="#">Piller No.</label>
                                <select name="pillar_no" id="pillar_no">
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
                                <select name="sub_pillar_no" id="sub_pillar_no">
                                    <option>Select Sub Piller</option>

                                </select>
                            </div>
                        </div>
                        <!-- Type of Incident Section -->
                        <div class="ltr-type-incident">
                            <div class="form-group3 search-page-form-group3">
                                <label for="#">Type Of Incident</label>
                                <select>
                                    <option>Select Incident</option>
                                    <option>Incident 1</option>
                                    <option>Incident 2</option>
                                </select>
                            </div>
                        </div>
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
                                    <input type="checkbox" class="custom-checkbox" name="other" value="other" />
                                    Other
                                </label>
                            </div>
                            <div class="search-button">
                                <button>Search</button>
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
                                        <th class="remarks">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2025-05-14</td>
                                        <td>North</td>
                                        <td>Sec-1</td>
                                        <td>7</td>
                                        <td>Alpha</td>
                                        <td>BOP-21</td>
                                        <td>PL-100</td>
                                        <td>ML-01</td>
                                        <td class="remarks">
                                            Observation conducted. All units reported.
                                        </td>
                                    </tr>
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
                                        <th class="remarks">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2025-05-14</td>
                                        <td>North</td>
                                        <td>Sec-1</td>
                                        <td>7</td>
                                        <td>Alpha</td>
                                        <td>BOP-21</td>
                                        <td>PL-100</td>
                                        <td>ML-01</td>
                                        <td class="remarks">
                                            Observation conducted. All units reported.
                                        </td>
                                    </tr>
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
                                        <th class="remarks">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>2025-05-14</td>
                                        <td>North</td>
                                        <td>Sec-1</td>
                                        <td>7</td>
                                        <td>Alpha</td>
                                        <td>BOP-21</td>
                                        <td>PL-100</td>
                                        <td>ML-01</td>
                                        <td class="remarks">
                                            Observation conducted. All units reported.
                                        </td>
                                    </tr>
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
                                    $("#sub_pillar_no").append('<option value="' + value.id + '">' + value.name + '</option>');
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
@endpush
