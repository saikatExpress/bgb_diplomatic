@extends('setting.app')
@section('title', 'Edit Region')
@section('content')
    <div class="form-container">
        <a href="{{ route('region.index') }}" class="back-btn">
            ← Back to Region List
        </a>
        <div class="form-header">Edit Region</div>

        <form id="editRegionForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select name="country" id="" class="form-control" required>
                    <option value="">Select Country</option>
                    <option value="bangladesh" {{ ($region->country == 'bangladesh') ? 'selected' : '' }}>Bangladesh</option>
                    <option value="india" {{ ($region->country == 'india') ? 'selected' : '' }}>India</option>
                </select>
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $region->name }}"
                    placeholder="Enter name">
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="lat" value="{{ $region->lat }}"
                    placeholder="Enter latitude">
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="lon" value="{{ $region->lon }}"
                    placeholder="Enter longitude">
                <span class="invalid_check"></span>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-submit">Update Region</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#editRegionForm').on('submit', function (e) {
                e.preventDefault();

                $('.form-control').removeClass('is-invalid');
                $('.invalid_check').text('');

                $.ajax({
                    url: "{{ route('region.update', $region->id) }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Updating...');
                    },
                    success: function (response) {
                        if (response && response.status === 'success') {
                            toastr.success(response.message + ' for ' + response.data.name);
                            setTimeout(() => {
                                window.location.href = "{{ route('region.index') }}";
                            }, 1000);
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
                        $('.btn-submit').prop('disabled', false).text('Update Region');
                    }
                });
            });
        });
    </script>
@endpush