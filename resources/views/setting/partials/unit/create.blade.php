@extends('setting.app')
@section('title', 'Create Unit')

@section('content')
    <div class="form-container">
        <a href="{{ route('unit.index') }}" class="back-btn">
            ← Back to Unit List
        </a>
        <div class="form-header">Create New Unit</div>

        <form id="createUnitForm">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                <span class="invalid_check"></span>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-submit">Create Unit</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script> $(document).ready(function () {
            $('#createUnitForm').on('submit', function (e) {
                e.preventDefault();
                $('.form-control').removeClass('is-invalid'); $('.invalid_check').text(''); $.ajax({
                    url: "{{ route('unit.store') }}",
                    type: "POST", data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Submitting...');
                    },
                    success: function (response) {
                        if (response &&
                            response.status === 'success') {
                            toastr.success(response.message + ' for ' + response.data.name);
                            $('#createUnitForm')[0].reset();
                        }
                    }, error: function (xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            $.each(xhr.responseJSON.errors, function (key, value) {
                                let input = $('[name="' + key + '" ]');
                                input.addClass('is-invalid'); input.closest('.mb-3').find('.invalid_check').text(value[0]);
                            });
                        } else {
                            toastr.error('Something went wrong. Try again.');
                        }
                    },
                    complete: function () {
                        $('.btn-submit').prop('disabled',
                            false).text('Create Unit');
                    }
                });
            });
        }); </script>
@endpush
