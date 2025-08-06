@extends('setting.app')
@section('title', 'Create Sector')

@section('content')
    <div class="form-container">
        <a href="{{ route('sector.index') }}" class="back-btn">← Back to Sector List</a>
        <div class="form-header">Create Sectors</div>

        <form id="createSectorForm">
            @csrf

            <!-- Region Dropdown -->
            <div class="mb-3">
                <label for="region_id" class="form-label">Select Region</label>
                <select name="region_id" id="region_id" class="form-control" required>
                    <option value="">-- Select Region --</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}">{{ filter($region->name) }}</option>
                    @endforeach
                </select>
                <span class="invalid_check"></span>
            </div>

            <!-- Dynamic Sector Rows -->
            <div id="sector-container">
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
                <button type="submit" class="btn btn-submit">Create Sectors</button>
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
                $('#sector-container').append(row);
            });

            // Remove Row
            $(document).on('click', '.btn-remove', function () {
                $(this).closest('.sector-row').remove();
            });

            // Submit Form (Example AJAX)
            $('#createSectorForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('sector.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response && response.status == 'success') {
                            toastr.success(response.message);
                            $('#createSectorForm')[0].reset();
                        }
                    },
                    error: function (xhr) {
                        toastr.alert('Error creating sectors.');
                    }
                });
            });
        });
    </script>
@endpush