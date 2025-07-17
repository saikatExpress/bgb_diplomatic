@extends('super.app')
@section('title', 'Update Pillar')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <!-- Left column: Create Pillar -->
                    <div class="col-sm-12 mb-4">
                        <div class="p-4 shadow-sm bg-white rounded">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <h3 class="mb-4">Edit Pillar</h3>
                            <form action="{{ route('super_admin.pillars.update', $pillar->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $pillar->name }}" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description"
                                        rows="4">{{ $pillar->description }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lat" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" id="lat" value="{{ $pillar->lat }}" name="lat"
                                        placeholder="Enter latitude">
                                    @error('lat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lon" class="form-label">Longitude</label>
                                    <input type="text" class="form-control" id="lon" name="lon" value="{{ $pillar->lon }}"
                                        placeholder="Enter longitude">
                                    @error('lon')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update Pillar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
