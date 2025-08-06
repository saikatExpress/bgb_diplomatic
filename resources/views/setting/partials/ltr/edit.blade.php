@extends('setting.app')
@section('title', 'Edit LTR')

@section('content')
    <div class="form-container">
        <a href="{{ route('ltr.index') }}" class="back-btn">
            ← Back to LTR List
        </a>
        <div class="form-header">Edit LTR</div>

        <form id="editLtrForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $ltr->id }}">

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $ltr->name }}">
                <span class="invalid_check"></span>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $ltr->description }}</textarea>
                <span class="invalid_check"></span>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-sm btn-submit">Update LTR</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#editLtrForm').on('submit', function (e) {
                e.preventDefault();

                $('.form-control').removeClass('is-invalid');
                $('.invalid_check').text('');

                $.ajax({
                    url: "{{ route('ltr.update', $ltr->id) }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Updating...');
                    },
                    success: function (response) {
                        if (response && response.status === 'success') {
                            toastr.success(response.message + ' for ' + response.data.name);
                            setTimeout(() => {
                                window.location.href = "{{ route('ltr.index') }}";
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
                        $('.btn-submit').prop('disabled', false).text('Update LTR');
                    }
                });
            });
        });
    </script>
@endpush