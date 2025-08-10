@extends('setting.app')
@section('title', 'Create Unit')
@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                style="background: linear-gradient(90deg, #A91D2A, #D72638);">
                <h5 class="mb-0">🏭 All Units</h5>
                <a href="{{ route('unit.create') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-plus"></i> Add Unit
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

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Updated At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($units as $index => $unit)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ formatDate($unit->updated_at, 'custom') }}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#unitModal"
                                            data-id="{{ $unit->id }}" data-name="{{ $unit->name }}"
                                            class="btn btn-sm btn-primary editBtn">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" data-id="{{ $unit->id }}" class="btn btn-sm btn-danger deleteBtn">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Unit Edit Modal --}}
    <div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unitModalLabel">Edit Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="unitEditForm">
                        <input type="hidden" id="unit_id" name="id">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            <span class="invalid_check"></span>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary btn-submit">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Unit Edit Modal --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            // Open modal with data
            $(document).on('click', '.editBtn', function () {
                const id = $(this).data('id');
                const name = $(this).data('name');

                $('#unit_id').val(id);
                $('#name').val(name);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle update form
            $('#unitEditForm').on('submit', function (e) {
                e.preventDefault();

                $('.form-control').removeClass('is-invalid');
                $('.invalid_check').text('');

                let id = $('#unit_id').val();
                let formData = $(this).serialize();

                $.ajax({
                    url: "/unit/update/" + id,
                    type: "POST",
                    data: formData,
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Updating...');
                    },
                    success: function (response) {
                        if (response && response.status === 'success') {
                            toastr.success(response.message + ' ' + response.data.name);
                            $('#unitModal').modal('hide');

                            setTimeout(() => {
                                location.reload();
                            }, 800);
                        }
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                let input = $('[name="' + key + '"]');
                                input.addClass('is-invalid');
                                input.closest('.mb-3').find('.invalid_check').text(value[0]);
                            });
                        } else {
                            toastr.error('Something went wrong. Try again.');
                        }
                    },
                    complete: function () {
                        $('.btn-submit').prop('disabled', false).text('Save changes');
                    }
                });
            });

            $(document).on('click', '.deleteBtn', function () {
                let button = $(this);
                let unitId = button.data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will permanently delete the unit!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/unit/destroy/' + unitId,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.status === 'success') {
                                    toastr.success(response.message);

                                    button.closest('tr').remove();
                                } else {
                                    toastr.error('Failed to delete the unit.');
                                }
                            },
                            error: function () {
                                toastr.error('Something went wrong. Please try again.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
