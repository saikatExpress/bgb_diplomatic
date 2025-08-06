@extends('setting.app')
@section('title', 'Create Battalion')

@section('content')
    <div class="form-container">
        <a href="{{ route('battalion.index') }}" class="back-btn">← Back to Battalion List</a>
        <div class="form-header">Create Battalion</div>

        <form id="createBattalionForm">
            @csrf

            <!-- Region Dropdown -->
            <div class="mb-3">
                <label for="sector_id" class="form-label">Select Sector</label>
                <select name="sector_id" id="sector_id" class="form-control select3" required>
                    <option value="">-- Select Sector --</option>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->id }}">{{ filter($sector->name) }}</option>
                    @endforeach
                </select>
                <span class="invalid_check"></span>
            </div>

            <!-- Dynamic Sector Rows -->
            <div id="battalion-container">
                <div class="sector-row">
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
                        <div class="col-md-2 d-flex align-items-end">
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
                <button type="submit" class="btn btn-sm btn-submit">Create Battalions</button>
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
                        <div class="sector-row">
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
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-remove">Remove</button>
                                </div>
                            </div>
                        </div>`;
                $('#battalion-container').append(row);
            });

            // Remove Row
            $(document).on('click', '.btn-remove', function () {
                $(this).closest('.sector-row').remove();
            });

            // Submit Form (Example AJAX)
            $('#createBattalionForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('battalion.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Submitting...');
                    },
                    success: function (response) {
                        if (response && response.status == 'success') {
                            toastr.success(response.message);
                            $('#createBattalionForm')[0].reset();
                        }
                    },
                    error: function (xhr) {
                        toastr.alert('Error creating sectors.');
                    },
                    complete: function () {
                        $('.btn-submit').prop('disabled', false).text('Create Battalions');
                    }
                });
            });
        });
    </script>
@endpush