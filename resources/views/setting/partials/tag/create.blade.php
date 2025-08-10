@extends('setting.app')
@section('title', 'Create Tag')

@section('content')
    <div class="form-container">
        <a href="{{ route('tag.index') }}" class="back-btn">
            ← Back to Tag List
        </a>
        <div class="form-header">Create New Tags</div>

        <form id="createTagForm">
            @csrf
            <div id="tagFields">
                <div class="tag-group mb-3">
                    <!-- Title -->
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title[]" placeholder="Enter title">
                    <span class="invalid_check"></span>

                    <!-- Input Name -->
                    <label class="form-label mt-2">Input Name</label>
                    <input type="text" class="form-control" name="input_name[]" placeholder="Enter input name">
                    <span class="invalid_check"></span>

                    <button type="button" class="btn btn-danger btn-sm removeTag mt-2" style="display:none;">
                        Remove
                    </button>
                </div>
            </div>

            <!-- Add New Button -->
            <div class="mb-3">
                <button type="button" id="addTag" class="btn btn-primary btn-sm">+ Add New Tag</button>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-sm btn-submit">Create Tags</button>
            </div>
        </form>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function () {

            // Add new tag fields
            $('#addTag').click(function () {
                let newTag = `
                        <div class="tag-group mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title[]" placeholder="Enter title">
                            <span class="invalid_check"></span>

                            <label class="form-label mt-2">Input Name</label>
                            <input type="text" class="form-control" name="input_name[]" placeholder="Enter input name">
                            <span class="invalid_check"></span>

                            <button type="button" class="btn btn-danger btn-sm removeTag mt-2">Remove</button>
                        </div>`;
                $('#tagFields').append(newTag);
            });

            // Remove tag group
            $(document).on('click', '.removeTag', function () {
                $(this).closest('.tag-group').remove();
            });

            // Submit form
            $('#createTagForm').on('submit', function (e) {
                e.preventDefault();

                $('.form-control').removeClass('is-invalid');
                $('.invalid_check').text('');

                $.ajax({
                    url: "{{ route('tag.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Submitting...');
                    },
                    success: function (response) {
                        if (response && response.status === 'success') {
                            toastr.success(response.message);
                            $('#createTagForm')[0].reset();
                            $('#tagFields').html($('.tag-group:first').clone().find('input').val('').end());
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
                        $('.btn-submit').prop('disabled', false).text('Create Tags');
                    }
                });
            });

        });
    </script>
@endpush
