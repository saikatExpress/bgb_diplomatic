@extends('super.app')
@section('title', 'All Sub Pillars')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Sub Pillars</h4>
                        <a href="{{ route('super_admin.subpillars.create') }}" class="btn btn-sm btn-primary">
                            Add Sub Pillar
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Pillar</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subpillars as $subpillar)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ filter($subpillar->pillar->name) }}</td>
                                        <td>{{ filter($subpillar->name) }}</td>
                                        <td>
                                            <a href="{{ route('super_admin.subpillars.edit', $subpillar->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('super_admin.subpillars.destroy', $subpillar->id) }}"
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