@extends('super.app')
@section('title', 'Create Tag')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Tag</h4>
                    <form class="forms-sample" method="POST" action="{{ route('super_admin.tags.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="region">Region</label>
                            <select name="region_id" id="region_id" class="form-control" required>
                                <option value="">Select Region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ filter($region->name) }}</option>
                                @endforeach
                            </select>
                            @error('region')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="code">Sector Code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter sector code"
                                value="{{ old('code') }}" required>
                            @error('code')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group
                                                <label for=" name">Sector Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter sector name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group
                                                <label for=" status">Status</label>
                            <select name="status" id="" class="form-control" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
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
        $('#region').select2({
            placeholder: 'Select Region',
            allowClear: true
        });
    });
</script>
