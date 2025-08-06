@extends('setting.app')
@section('title', 'Create BOP')

@section('content')
    <div class="form-container">
        <a href="{{ route('bop.index') }}" class="back-btn">← Back to BOP List</a>
        <div class="form-header">Create BOP</div>

        <form id="createBopForm">
            @csrf

            <!-- Region Dropdown -->
            <div class="mb-3">
                <label for="battalion" class="form-label">Select Battalion</label>
                <select name="battalion_id" id="battalion_id" class="form-control select3" required>
                    <option value="">-- Select Battalion --</option>
                    @foreach ($battalions as $battalion)
                        <option value="{{ $battalion->id }}">
                            {{ filter($battalion->name) . ' ( ' . $battalion->sector->name . ' )' }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid_check"></span>
            </div>

            <!-- Dynamic Sector Rows -->
            <div id="bop-container">
                <div class="bop-row">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name[]" class="form-control" placeholder="Enter name">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="lat[]" class="form-control" placeholder="Latitude">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="lon[]" class="form-control" placeholder="Longitude">
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-remove d-none">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add More Button -->
            <button type="button" id="addMore" class="btn btn-add">
                <i class="fa fa-plus"></i> Add More
            </button>

            <!-- Submit -->
            <div class="d-grid mt-3">
                <button type="submit" class="btn btn-sm btn-submit">Create BOP</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Add More Rows
            $('#addMore').click(function () {
                let row = `
                            <div class="bop-row">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name[]" class="form-control" placeholder="Enter name">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="lat[]" class="form-control" placeholder="Latitude">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" name="lon[]" class="form-control" placeholder="Longitude">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center">
                                        <button type="button" class="btn btn-remove">Remove</button>
                                    </div>
                                </div>
                            </div>`;
                $('#bop-container').append(row);
            });

            // Remove Row
            $(document).on('click', '.btn-remove', function () {
                $(this).closest('.bop-row').remove();
            });

            // Submit Form (Example AJAX)
            $('#createBopForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('bop.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Submitting...');
                    },
                    success: function (response) {
                        if (response && response.status == 'success') {
                            toastr.success(response.message);
                            $('#createBopForm')[0].reset();
                        }
                    },
                    error: function (xhr) {
                        toastr.alert('Error creating bops.');
                    },
                    complete: function () {
                        $('.btn-submit').prop('disabled', false).text('Create BOP');
                    }
                });
            });
        });
    </script>
@endpush