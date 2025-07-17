@extends('super.app')
@section('title', 'All Battalions')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Battalions</h4>
                        <a href="{{ route('super_admin.battalions.create') }}" class="btn btn-sm btn-primary">
                            Add Battalion
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Sector</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($battalions as $battalion)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ filter($battalion->sector->name) }}</td>
                                        <td>{{ filter($battalion->name) }}</td>
                                        <td>{{ filter($battalion->code) }}</td>
                                        <td>{{ filter($battalion->lat) }}</td>
                                        <td>{{ filter($battalion->lon) }}</td>
                                        <td>
                                            <a href="{{ route('super_admin.battalions.edit', $battalion->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('super_admin.battalions.destroy', $battalion->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
