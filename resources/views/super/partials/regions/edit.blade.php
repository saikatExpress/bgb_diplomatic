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
                        <div class="form-group
                                    <label for=" country">Country</label>
                            <select name="country" id="" class="form-control" required>
                                <option value="">Select Country</option>
                                <option value="bangladesh" {{ $region->country == 'bangladesh' ? 'selected' : '' }}>
                                    Bangladesh</option>
                                <option value="india" {{ $region->country == 'india' ? 'selected' : '' }}>India
                                </option>
                            </select>
                            @error('country')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group
                                    <label for=" code">Region Code</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="Enter region code"
                                value="{{ old('code', $region->code) }}" required>
                            @error('code')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group
                                    <label for=" name">Region Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter region name"
                                value="{{ old('name', $region->name) }}" required>
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
@endsection