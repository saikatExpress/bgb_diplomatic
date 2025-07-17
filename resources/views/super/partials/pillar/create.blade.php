@extends('super.app')
@section('title', 'Create Pillar')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <!-- Left column: Create Pillar -->
                    <div class="col-sm-6 mb-4">
                        <div class="p-4 shadow-sm bg-white rounded">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <h3 class="mb-4">Create Pillar</h3>
                            <form action="{{ route('super_admin.pillars.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                        required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" rows="4"></textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lat" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" id="lat" value="{{ old('lat') }}" name="lat"
                                        placeholder="Enter latitude">
                                    @error('lat')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lon" class="form-label">Longitude</label>
                                    <input type="text" class="form-control" id="lon" name="lon" value="{{ old('lon') }}"
                                        placeholder="Enter longitude">
                                    @error('lon')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Create Pillar</button>
                            </form>
                        </div>
                    </div>

                    <!-- Right column: Latest Incidents -->
                    <div class="col-sm-6 mb-4">
                        <div class="p-4 shadow-sm bg-white rounded">
                            <h3 class="mb-4">Latest Pillars</h3>

                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pillars as $pillar)
                                        <tr>
                                            <td>{{ filter($pillar->name) }}</td>
                                            <td>{{ filter($pillar->lat) }}</td>
                                            <td>{{ filter($pillar->lon) }}</td>
                                            <td>{{ $pillar->created_at->format('d-m-y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
