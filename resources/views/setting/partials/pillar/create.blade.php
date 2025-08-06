@extends('setting.app')
@section('title', 'Create Pillar')

@section('content')
    <div class="form-container">
        <a href="{{ route('pillar.index') }}" class="back-btn">
            ← Back to Pillar List
        </a>
        <div class="form-header">Create New Pillar</div>

        <form id="createPillarForm">
            @csrf
            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                <span class="invalid_check"></span>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
                <span class="invalid_check"></span>
            </div>

            <!-- Latitude -->
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="lat" placeholder="Enter latitude">
                <span class="invalid_check"></span>
            </div>

            <!-- Longitude -->
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="lon" placeholder="Enter longitude">
                <span class="invalid_check"></span>
            </div>


            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-sm btn-submit">Create Pillar</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#createPillarForm').on('submit', function (e) {
                e.preventDefault();

                $('.form-control').removeClass('is-invalid');
                $('.invalid_check').text('');

                $.ajax({
                    url: "{{ route('pillar.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Submitting...');
                    },
                    success: function (response) {
                        if (response && response.status === 'success') {
                            toastr.success(response.message + ' for ' + response.data.name);
                            $('#createPillarForm')[0].reset();
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
                        $('.btn-submit').prop('disabled', false).text('Create Pillar');
                    }
                });
            });
        });
    </script>
@endpush