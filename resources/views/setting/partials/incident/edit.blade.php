@extends('setting.app')
@section('title', 'Edit Incident')

@section('content')
    <div class="form-container">
        <a href="{{ route('incident.index') }}" class="back-btn">
            ← Back to Incident List
        </a>
        <div class="form-header">Edit Incident</div>

        <form id="editIncidentForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $incident->id }}">

            <!-- Name -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $incident->title }}">
                <span class="invalid_check"></span>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $incident->description }}</textarea>
                <span class="invalid_check"></span>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label d-block">Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="active" value="active" {{ $incident->status === 'active' ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive" {{ $incident->status === 'inactive' ? 'checked' : '' }}>
                    <label class="form-check-label" for="inactive">Inactive</label>
                </div>
                <span class="invalid_check"></span>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-sm btn-submit">Update Incident</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#editIncidentForm').on('submit', function (e) {
                e.preventDefault();

                $('.form-control').removeClass('is-invalid');
                $('.invalid_check').text('');

                $.ajax({
                    url: "{{ route('incident.update', $incident->id) }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Updating...');
                    },
                    success: function (response) {
                        if (response && response.status === 'success') {
                            toastr.success(response.message + ' for ' + response.data.title);
                            setTimeout(() => {
                                window.location.href = "{{ route('incident.index') }}";
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
                        $('.btn-submit').prop('disabled', false).text('Update Incident');
                    }
                });
            });
        });
    </script>
@endpush