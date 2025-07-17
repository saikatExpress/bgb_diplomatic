@extends('super.app')
@section('title', 'Edit Batttalion')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Battalion</h4>
                    <form action="{{ route('super_admin.battalions.update', $battalion->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="sector_id">Select Sector</label>
                            <select class="form-control" name="sector_id" required>
                                <option value="">Select Sector</option>
                                @foreach($sectors as $sector)
                                    <option value="{{ $sector->id }}" {{ $sector->id == $battalion->sector_id ? 'selected' : '' }}>{{ $sector->name }}</option>
                                @endforeach
                            </select>
                            @error('sector_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Battalion Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Battalion Name"
                                required value="{{ old('name', $battalion->name) }}">
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lat">Latitude</label>
                            <input type="text" class="form-control" id="lat" name="lat" placeholder="Enter Latitude"
                                value="{{ old('lat', $battalion->lat) }}">
                            @error('lat')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lon">Longitude</label>
                            <input type="text" class="form-control" id="lon" name="lon" placeholder="Enter Longitude"
                                value="{{ old('lon', $battalion->lon) }}">
                            @error('lon')
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
