@extends('setting.app')
@section('title', 'Edit Battalion')
@section('content')
    <div class="form-container">
        <a href="{{ route('battalion.index') }}" class="back-btn">
            ← Back to Battalion List
        </a>
        <div class="form-header">Edit Battalion</div>

        <form id="editBattalionForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="sector" class="form-label">Sector</label>
                <select name="sector_id" id="sector_id" class="form-control select3" required>
                    <option value="">Select Sector</option>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->id }}" {{ ($sector->id == $battalion->sector_id) ? 'selected' : '' }}>
                            {{ filter($sector->name) . ' ( ' . filter($sector->region->name) . ' )' }}
                        </option>
                    @endforeach
                </select>
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $battalion->name }}"
                    placeholder="Enter name">
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="lat" value="{{ $battalion->lat }}"
                    placeholder="Enter latitude">
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="lon" value="{{ $battalion->lon }}"
                    placeholder="Enter longitude">
                <span class="invalid_check"></span>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-sm btn-submit">Update Battalion</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#editBattalionForm').on('submit', function (e) {
                e.preventDefault();

                $('.form-control').removeClass('is-invalid');
                $('.invalid_check').text('');

                $.ajax({
                    url: "{{ route('battalion.update', $battalion->id) }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Updating...');
                    },
                    success: function (response) {
                        if (response && response.status === 'success') {
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.href = "{{ route('battalion.index') }}";
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
                        $('.btn-submit').prop('disabled', false).text('Update Battalion');
                    }
                });
            });
        });
    </script>
@endpush