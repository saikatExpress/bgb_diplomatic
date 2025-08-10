@extends('setting.app')
@section('title', 'Tag List')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                style="background: linear-gradient(90deg, #A91D2A, #D72638);">
                <h5 class="mb-0">🏭 All Tag</h5>
                <a href="{{ route('tag.create') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-plus"></i> Add Tag
                </a>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3 success-success" role="alert">
                        <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3 success-error" role="alert">
                        <i class="fa fa-check-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Filter Form -->
                @include('setting.partials.tag.components.filter-form')

                <!-- DataTable -->
                <div class="table-responsive">
                    <table id="tagTable" class="table table-bordered table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Input Name</th>
                                <th>Updated At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            let table = $('#tagTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('tag.index') }}",
                    data: function (d) {
                        d.tag_id = $('#tag_id').val();
                        d.title = $('#title').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'title', name: 'title' },
                    { data: 'input_name', name: 'input_name' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#btnFilter').click(() => table.draw());
            $('#btnReset').click(() => {
                $('#filterForm')[0].reset();
                table.draw();
            });
        });
    </script>
@endpush
