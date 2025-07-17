@extends('super.app')
@section('title', 'Edit Regions')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Region</h4>
                    <form class="forms-sample" method="POST"
                        action="{{ route('super_admin.regions.update', $region->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Country --}}
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select name="country" id="country" class="form-control" required>
                                <option value="">Select Country</option>
                                <option value="bangladesh" {{ $region->country == 'bangladesh' ? 'selected' : '' }}>Bangladesh
                                </option>
                                <option value="india" {{ $region->country == 'india' ? 'selected' : '' }}>India</option>
                            </select>
                            @error('country')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Region Name --}}
                        <div class="form-group">
                            <label for="name">Region Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter region name"
                                value="{{ old('name', $region->name) }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Latitude --}}
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude"
                                placeholder="Enter latitude" value="{{ old('latitude', $region->lat) }}" required>
                            @error('latitude')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Longitude --}}
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude"
                                placeholder="Enter longitude" value="{{ old('longitude', $region->lon) }}" required>
                            @error('longitude')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <a href="{{ route('super_admin.regions') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
@endsection
