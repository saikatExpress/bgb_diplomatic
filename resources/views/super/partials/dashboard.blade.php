@extends('super.app')
@section('title', 'BGB Diplomatic Super Admin Panel')
@section('content')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-6 mb-4 mb-xl-0">
                        <div class="d-lg-flex align-items-center">
                            <div>
                                <h3 class="text-dark font-weight-bold mb-2">Hi, welcome back!</h3>
                                <h6 class="font-weight-normal mb-2">Last login was 23 hours ago. View details</h6>
                            </div>
                            <div class="ms-lg-5 d-lg-flex d-none">
                                <button type="button" class="btn bg-white btn-icon">
                                    <i class="mdi mdi-view-grid text-success"></i>
                                </button>
                                <button type="button" class="btn bg-white btn-icon ms-2">
                                    <i class="mdi mdi-format-list-bulleted font-weight-bold text-primary"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center justify-content-md-end">
                            <div class="pe-1 mb-3 mb-xl-0">
                                <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                    Feedback
                                    <i class="mdi mdi-message-outline btn-icon-append"></i>
                                </button>
                            </div>
                            <div class="pe-1 mb-3 mb-xl-0">
                                <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                    Help
                                    <i class="mdi mdi-help-circle-outline btn-icon-append"></i>
                                </button>
                            </div>
                            <div class="pe-1 mb-3 mb-xl-0">
                                <button type="button" class="btn btn-outline-inverse-info btn-icon-text">
                                    Print
                                    <i class="mdi mdi-printer btn-icon-append"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <h4>Database Backup</h4>
                                </div>
                                <div class="row mb-3">
                                    <button id="backupBtn" class="btn btn-primary">Create Backup</button>
                                    <div id="backupMsg" class="mt-3 ms-3"></div>
                                </div>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Filename</th>
                                            <th>Size</th>
                                            <th>Created At</th>
                                            <th>Download</th>
                                        </tr>
                                    </thead>
                                    <tbody id="backupTable">
                                        @foreach ($files as $file)
                                            <tr>
                                                <td>{{ $file['name'] }}</td>
                                                <td>{{ $file['size'] }}</td>
                                                <td>{{ $file['time'] }}</td>
                                                <td>
                                                    <a href="{{ $file['url'] }}" class="btn btn-sm btn-success" download>
                                                        Download
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 mb-3 mb-lg-0">
                        <div class="card congratulation-bg text-center">
                            <div class="card-body pb-0">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                                <h2 class="mt-3 text-white mb-3 font-weight-bold">
                                    Welcome {{ auth()->user()->name }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="footer-wrap">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a
                                href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com
                            </a>2021</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a
                                href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a>
                            templates</span>
                    </div>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
@endsection

@push('script')
    <script src="{{ asset('assets/js/database.js') }}"></script>
@endpush
