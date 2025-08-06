@extends('setting.app')
@section('title', 'Edit User')

@section('content')
    <div class="form-container">
        <a href="{{ route('user.index') }}" class="back-btn">
            ← Back to User List
        </a>
        <div class="form-header">Edit User</div>

        <form id="editUserForm">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}">

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                <span class="invalid_check"></span>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                <span class="invalid_check"></span>
            </div>

            <!-- Mobile -->
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}">
                <span class="invalid_check"></span>
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control form-select" id="role" name="role">
                    <option value="" disabled>Select Role</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                </select>
                <span class="invalid_check"></span>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="form-label d-block">Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="active" value="active" {{ $user->status === 'active' ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive" {{ $user->status === 'inactive' ? 'checked' : '' }}>
                    <label class="form-check-label" for="inactive">Inactive</label>
                </div>
                <span class="invalid_check"></span>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-sm btn-submit">Update User</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#editUserForm').on('submit', function (e) {
                e.preventDefault();

                $('.form-control').removeClass('is-invalid');
                $('.invalid_check').text('');

                $.ajax({
                    url: "{{ route('user.update', $user->id) }}",
                    type: "POST",
                    data: $(this).serialize(),
                    beforeSend: function () {
                        $('.btn-submit').prop('disabled', true).text('Updating...');
                    },
                    success: function (response) {
                        if (response && response.status === 'success') {
                            toastr.success(response.message + ' for ' + response.data.name);
                            setTimeout(() => {
                                window.location.href = "{{ route('user.index') }}";
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
                        $('.btn-submit').prop('disabled', false).text('Update User');
                    }
                });
            });
        });
    </script>
@endpush