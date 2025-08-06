@extends('setting.app')
@section('title', 'Create Region')

@section('content')
    <div class="form-container">
        <a href="{{ route('region.index') }}" class="back-btn">
            ← Back to Region List
        </a>
        <div class="form-header">Create New Region</div>

        <form id="createRegionForm">
            @csrf
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select name="country" id="" class="form-control" required>
                    <option value="">Select Country</option>
                    <option value="bangladesh">Bangladesh</option>
                    <option value="india">India</option>
                </select>
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="lat" placeholder="Enter latitude">
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="lon" placeholder="Enter longitude">
                <span class="invalid_check"></span>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-submit">Create Region</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#createRegionForm').on('submit', function (e) {
                e.preventDefault();

                $('.form-control').removeClass('is-invalid');
                $('.invalid_check').text('');

                $.ajax({
                    url: "{{ route('region.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Submitting...');
                    },
                    success: function (response) {
                        if (response && response.status === 'success') {
                            toastr.success(response.message + ' for ' + response.data.name);
                            $('#createRegionForm')[0].reset();
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
                        $('.btn-submit').prop('disabled', false).text('Create Region');
                    }
                });
            });
        });
    </script>
@endpush