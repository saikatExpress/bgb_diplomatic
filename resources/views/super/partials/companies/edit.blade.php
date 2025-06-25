@extends('super.app')
@section('title', 'Edit Company')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Company</h4>
                    <form class="forms-sample" method="POST"
                        action="{{ route('super_admin.companies.update', $company->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="battalion">Battalion</label>
                            <select name="battalion_id" id="battalion_id" class="form-control" required>
                                <option value="">Select Battalion</option>
                                @foreach ($battalions as $battalion)
                                    <option value="{{ $battalion->id }}" {{ $battalion->id == $company->battalion_id ? 'selected' : '' }}>{{ filter($battalion->name) }}</option>
                                @endforeach
                            </select>
                            @error('battalion_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter company name"
                                value="{{ old('name', $company->name) }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $('#battalion_id').select2({
            placeholder: 'Select Battalion',
            allowClear: true
        });
    });
</script>