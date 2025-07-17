@extends('super.app')
@section('title', 'Create Region')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Create Region</h4>
                        <a href="{{ route('super_admin.regions') }}" class="btn btn-sm btn-primary mb-3">
                            All Regions
                        </a>
                    </div>
                    <form class="forms-sample" method="POST" action="{{ route('super_admin.regions.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select name="country" id="" class="form-control" required>
                                <option value="">Select Country</option>
                                <option value="bangladesh">Bangladesh</option>
                                <option value="india">India</option>
                            </select>
                            @error('country')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Region Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter region name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude"
                                placeholder="Enter latitude" value="{{ old('latitude') }}" required>
                            @error('latitude')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude"
                                placeholder="Enter longitude" value="{{ old('longitude') }}" required>
                            @error('longitude')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Region List</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($regions as $region)
                                    <tr>
                                        <td>{{ filter($region->name) }}</td>
                                        <td>{{ $region->code }}</td>
                                        <td>{{ $region->lat }}</td>
                                        <td>{{ $region->lon }}</td>
                                        <td>{{ filter($region->status) }}</td>
                                        <td>
                                            <a href="{{ route('super_admin.regions.edit', $region->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('super_admin.regions.destroy', $region->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('.table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
<script>
    $(document).ready(function () {
        $('#status').select2({
            placeholder: "Select Status",
            allowClear: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#description').summernote({
            height: 200,
            placeholder: 'Enter description here...'
        });
    });
</script>

</script>
<script>
    $(document).ready(function () {
        $('.forms-sample').on('submit', function () {
            // Add any additional validation or processing here if needed
            return true; // Allow form submission
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.alert').fadeOut(5000);
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-danger').on('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this region?')) {
                $(this).closest('form').submit();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-warning').on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            window.location.href = url;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-primary').on('click', function () {
            // Add any additional processing for the submit button if needed
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-light').on('click', function (e) {
            e.preventDefault();
            window.location.href = "{{ route('super_admin.regions') }}";
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.table').on('click', '.btn-danger', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this region?')) {
                $(this).closest('form').submit();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.table').on('click', '.btn-warning', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            window.location.href = url;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.table').on('click', '.btn-primary', function () {
            // Add any additional processing for the submit button if needed
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.table').on('click', '.btn-light', function (e) {
            e.preventDefault();
            window.location.href = "{{ route('super_admin.regions') }}";
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.forms-sample').on('submit', function () {
            // Add any additional validation or processing here if needed
            return true; // Allow form submission
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.alert').fadeOut(5000);
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-danger').on('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this region?')) {
                $(this).closest('form').submit();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-warning').on('click', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            window.location.href = url;
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-primary').on('click', function () {
            // Add any additional processing for the submit button if needed
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.btn-light').on('click', function (e) {
            e.preventDefault();
            window.location.href = "{{ route('super_admin.regions') }}";
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.table').on('click', '.btn-danger', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this region?')) {
                $(this).closest('form').submit();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.table').on('click', '.btn-warning', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            window.location.href = url;
        });
    });
</script>
