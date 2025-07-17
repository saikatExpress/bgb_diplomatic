@extends('super.app')
@section('title', 'Create Company')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Company</h4>
                    <form class="forms-sample" method="POST" action="{{ route('super_admin.companies.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="battalion">Battalion</label>
                            <select name="battalion_id" id="battalion_id" class="form-control" required>
                                <option value="">Select Battalion</option>
                                @foreach ($battalions as $battalion)
                                    <option value="{{ $battalion->id }}">{{ filter($battalion->name) }}</option>
                                @endforeach
                            </select>
                            @error('battalion_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter company name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Latitude</label>
                            <input type="text" class="form-control" id="lat" name="lat" placeholder="Enter latitude"
                                value="{{ old('lat') }}">
                            @error('lat')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Longitude</label>
                            <input type="text" class="form-control" id="lon" name="lon" placeholder="Enter longitude"
                                value="{{ old('lon') }}">
                            @error('lat')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Create</button>
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
