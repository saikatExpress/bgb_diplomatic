@extends('setting.app')
@section('title', 'Create Sector')
@section('content')
    <div class="form-container">
        <a href="{{ route('sector.index') }}" class="back-btn">
            ← Back to Sector List
        </a>
        <div class="form-header">Create New Sector</div>

        <form id="createSectorForm">
            @csrf
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select name="country" id="" class="form-control" required>
                    <option value="">Select Country</option>
                    <option value="bangladesh">Bangladesh</option>
                    <option value="india">India</option>
                </select>
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="lat" placeholder="Enter latitude">
                <span class="invalid_check"></span>
            </div>

            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="lon" placeholder="Enter longitude">
                <span class="invalid_check"></span>
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-submit">Create Region</button>
            </div>
        </form>
    </div>
@endsection