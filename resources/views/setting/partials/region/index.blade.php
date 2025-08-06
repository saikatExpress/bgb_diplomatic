@extends('setting.app')
@section('title', 'Region List')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                style="background: linear-gradient(90deg, #A91D2A, #D72638);">
                <h5 class="mb-0">🌍 All Regions</h5>
                <a href="{{ route('region.create') }}" class="btn btn-light btn-sm">
                    <i class="fa fa-plus"></i> Add Region
                </a>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3 success-alert" role="alert">
                        <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- 🔎 Filter Form -->
                @include('setting.partials.region.components.filter_form')
                <!-- 🔎 Filter Form -->

                <!-- 📋 Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-info">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Country</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($regions as $index => $region)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ filter($region->name) }}</td>
                                    <td>{{ $region->code }}</td>
                                    <td>{{ filter($region->country) }}</td>
                                    <td>{{ $region->lat }}</td>
                                    <td>{{ $region->lon }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('region.show', $region->id) }}" class="btn btn-sm btn-info me-1">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('region.edit', $region->id) }}" class="btn btn-sm btn-warning me-1">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('region.destroy', $region->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure to delete this region?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fa fa-user-slash fa-2x d-block mb-2"></i>
                                        No region found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection