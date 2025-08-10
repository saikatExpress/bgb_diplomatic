@extends('setting.app')
@section('title', 'Edit Tag')
@section('content')
    <div class="form-container">
        <a href="{{ route('tag.index') }}" class="back-btn">
            ← Back to Tag List
        </a>
        <div class="form-header">Edit Tag</div>

        <form id="editTagForm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $tag->title }}"
                    placeholder="Enter name">
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="input_name" class="form-label">Input Name</label>
                <input type="text" class="form-control" id="input_name" name="input_name" value="{{ $tag->input_name }}"
                    placeholder="Enter input_name">
                <span class="invalid_check"></span>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-sm btn-submit">Update Tag</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script> $(document).ready(function () {
            $('#editTagForm').on('submit', function (e) {
                e.preventDefault();
                $('.form-control').removeClass('is-invalid'); $('.invalid_check').text(''); $.ajax({
                    url: "{{ route('tag.update', $tag->id) }}",
                    type: "POST", data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Updating...');
                    },
                    success: function (response) {
                        if (response &&
                            response.status === 'success') {
                            toastr.success(response.message); setTimeout(() => {
                                window.location.href = "{{ route('tag.index') }}";
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
                        $('.btn-submit').prop('disabled', false).text('Update Tag');
                    }
                });
            });
        });
    </script>
@endpush
