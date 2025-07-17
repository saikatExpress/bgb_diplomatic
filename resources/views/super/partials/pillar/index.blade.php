@extends('super.app')
@section('title', 'All Pillars')
@section('content')
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="col-sm-12 mb-4">
                        <div class="p-4 shadow-sm bg-white rounded">
                            <h3 class="mb-4">All Pillars</h3>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pillars as $key => $pillar)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ filter($pillar->name) }}</td>
                                            <td>{{ $pillar->description }}</td>
                                            <td>{{ filter($pillar->lat) }}</td>
                                            <td>{{ filter($pillar->lon) }}</td>
                                            <td>{{ $pillar->created_at->format('d-m-y') }}</td>
                                            <td>
                                                <a href="{{ route('super_admin.pillars.edit', $pillar->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('super_admin.pillars.destroy', $pillar->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this pillar?')">
                                                        Delete
                                                    </button>
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
    </div>
@endsection
