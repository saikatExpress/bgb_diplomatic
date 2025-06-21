@extends('web.app')
@section('title', 'Dashboard')
@section('content')
    <div class="form-body">
        <div class="left-form-content">
            <div class="top-title">Input Form</div>
            <div class="forms">
                <form action="#">
                    <div class="from-letter-by-select">
                        <label for="#" class="letter-by-label">Letter By</label>
                        <select name="" id="" class="letter-by-select">
                            <option value="BGB">BGB</option>
                            <option value="BSF">BSF</option>
                        </select>
                    </div>
                    <div class="form-border-area">
                        <span class="span-from-text">From</span>
                        <div class="select-form-one">
                            <select>
                                <option>Select 1</option>
                                <option>Rigion HQ, Sarail</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select SEC</option>
                                <option>Option A</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select 3</option>
                                <option>Battalion</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select 4</option>
                                <option>Select Coy</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select 5</option>
                                <option>Select Bop</option>
                                <option>Option B</option>
                            </select>
                        </div>
                        <div class="to-inputs">
                            <span class="span-to-text">To</span>
                        </div>
                        <div class="select-form-two">
                            <select>
                                <option>Select 1</option>
                                <option>BSF Rigion</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select SEC</option>
                                <option>Option A</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select 3</option>
                                <option>Battalion</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select 4</option>
                                <option>Select Coy</option>
                                <option>Option B</option>
                            </select>
                            <select>
                                <option>Select 5</option>
                                <option>Select BOP</option>
                                <option>Option B</option>
                            </select>
                        </div>
                        <!-- another part ltr date number -->
                        <div class="ltr-no-date">
                            <div class="form-group">
                                <label for="#">LTR No.</label>
                                <input type="text" placeholder="NO." />
                            </div>
                            <div class="form-group">
                                <label for="#">LTR Date.</label>
                                <input type="date" class="date-input" />
                            </div>
                        </div>
                        <!-- Subject Section -->
                        <div class="ltr-subject">
                            <div class="form-group2">
                                <label for="#">LTR Sub</label>
                                <select>
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

                        {{-- LTR Modal Start --}}
                        <div class="modal fade" id="ltrModal" tabindex="-1" role="dialog" aria-labelledby="ltrModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ltrModalLabel">Add New LTR Subject</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Your form/input content goes here -->
                                        <p>This is a modal body content.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- LTR Modal End --}}

                        <!-- Type of Incident Section -->
                        <div class="ltr-type-incident">
                            <div class="form-group3">
                                <label for="#">Type Of Incident</label>
                                <select>
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

                        {{-- Incident Modal Start --}}
                        <div class="modal fade" id="incidentModal" tabindex="-1" role="dialog"
                            aria-labelledby="incidentModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="incidentModalLabel">Add New Incident</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Your form/input content goes here -->
                                        <p>This is a modal body content.</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- Incident Modal End --}}

                        <!-- Type of Incident Section -->
                        <div class="ltr-type-incident">
                            <div class="form-group3">
                                <label for="#">Pillar No.</label>
                                <select>
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

                        {{-- Pillar Modal Start --}}
                        <div class="modal fade" id="addPillarModal" tabindex="-1" role="dialog"
                            aria-labelledby="addPillarModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addNewModalLabel">Add New Item</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <!-- Your form/input content goes here -->
                                        <p>This is a modal body content.</p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- Pillar Modal End --}}

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
                            <!-- form group4 second -->
                            <div class="form-group4">

                                <div class="border-label-group">
                                    <label for="killing">
                                        Killing
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-skull-crossbones input-icon"></i>
                                        <input type="text" id="killing" placeholder="No. of Killing..." />
                                    </div>
                                </div>

                                <div class="border-label-group">
                                    <label for="injuring"> Injuring
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-notes-medical input-icon"></i>
                                        <input type="text" id="injuring" placeholder="No. Of Injuring..." />
                                    </div>
                                </div>

                                <div class="border-label-group">
                                    <label for="beating"> Beating
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-hand-fist input-icon"></i>
                                        <input type="text" id="beating" placeholder="No. Of Beating..." />
                                    </div>
                                </div>

                                <div class="border-label-group">
                                    <label for="firing"> Firing
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-fire input-icon"></i>
                                        <input type="text" id="firing" placeholder="No. Of Firing..." />
                                    </div>
                                </div>

                                <div class="border-label-group">
                                    <label for="crossing"> Illegal Crossing
                                    </label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-road input-icon"></i>
                                        <input type="text" id="crossing" placeholder="No. Of Illegal Crossing..." />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- =============== -->
                    <div class="upload-container">
                        <div class="upload-card">
                            <label class="upload-label">
                                <div class="upload-title">Main Letter</div>
                                <div class="upload-box">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="upload-instruction">Drag / Drop file here</span>
                                    <input type="file" class="file-input" onchange="handleFile(this)">
                                    <div class="file-info">
                                        <span class="file-name"></span>
                                        <button class="remove-btn" onclick="removeFile(this)">✖</button>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="upload-card">
                            <label class="upload-label">
                                <div class="upload-title upload-title-two">All Ref (Connecting LTR)</div>
                                <div class="upload-box">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="upload-instruction">Add file here</span>
                                    <input type="file" class="file-input" onchange="handleFile(this)">
                                    <div class="file-info">
                                        <span class="file-name"></span>
                                        <button class="remove-btn" onclick="removeFile(this)">✖</button>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="upload-card">
                            <label class="upload-label">
                                <div class="upload-title upload-title-three">Reply from BSF</div>
                                <div class="upload-box">
                                    <i class="fa-solid fa-file-circle-plus"></i>
                                    <span class="upload-instruction">Drag / Drop file here</span>
                                    <input type="file" class="file-input" onchange="handleFile(this)">
                                    <div class="file-info">
                                        <span class="file-name"></span>
                                        <button class="remove-btn" onclick="removeFile(this)">✖</button>
                                    </div>
                                </div>
                            </label>
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