@extends('super.app')
@section('title', 'All Sector')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Sectors</h4>
                        <a href="{{ route('super_admin.sectors.create') }}" class="btn btn-sm btn-primary">
                            Add Sector
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Region</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sectors as $sector)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ filter($sector->region->name) }}</td>
                                        <td>{{ $sector->code }}</td>
                                        <td>{{ filter($sector->name) }}</td>
                                        <td>
                                            @if ($sector->status == 'active')
                                                <span class="btn btn-sm btn-success">Active</span>
                                            @else
                                                <span class="btn btn-sm btn-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('super_admin.sectors.edit', $sector->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('super_admin.sectors.destroy', $sector->id) }}" method="POST"
                                                style="display:inline;">
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