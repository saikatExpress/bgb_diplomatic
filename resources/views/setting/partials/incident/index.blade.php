@extends('setting.app')
@section('title', 'Incident List')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                style="background: linear-gradient(90deg, #A91D2A, #D72638);">
                <h5 class="mb-0">👥 All Incident</h5>
                <a href="{{ route('incident.create') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-plus"></i> Add Incident
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle" id="data-table">
                        <thead class="table-primary" style="color: teal !important;">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            var searchable = [];
            var selectable = [];
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });
            if (!$.fn.DataTable.isDataTable('#data-table')) {
                let dTable = $('#data-table').DataTable({
                    order: [],
                    lengthMenu: [
                        [25, 50, 100, 200, 500, -1],
                        [25, 50, 100, 200, 500, "All"]
                    ],
                    processing: true,
                    responsive: true,
                    serverSide: true,

                    language: {
                        processing: `<div class="text-center">
                                                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                    </div>
                                                    </div>`
                    },

                    scroller: {
                        loadingIndicator: false
                    },
                    pagingType: "full_numbers",
                    dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                    ajax: {
                        url: "{{ route('incident.index') }}",
                        type: "get",
                    },

                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    ],
                });

                new DataTable('#example', {
                    responsive: true
                });
            }
        });

        function showDeleteConfirm(id, deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id, deleteUrl);
                }
            });
        }

        function deleteItem(id, deleteUrl) {
            fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Deleted!',
                            'Your incident has been deleted.',
                            'success'
                        );

                        $('#data-table').DataTable().ajax.reload(null, false);
                    } else {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting the article.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'An unexpected error occurred.',
                        'error'
                    );
                });
        }
    </script>
@endpush