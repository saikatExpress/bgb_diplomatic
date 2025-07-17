@extends('super.app')
@section('title', 'All BOPS')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">BOP</h4>
                        <a href="{{ route('super_admin.bops.create') }}" class="btn btn-sm btn-primary">
                            Add BOP
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Company</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bops as $bop)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ filter($bop->company->name) }}</td>
                                        <td>{{ filter($bop->code) }}</td>
                                        <td>{{ filter($bop->name) }}</td>
                                        <td>{{ filter($bop->lat) }}</td>
                                        <td>{{ filter($bop->lon) }}</td>

                                        <td>
                                            <a href="{{ route('super_admin.bops.edit', $bop->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('super_admin.bops.destroy', $bop->id) }}" method="POST"
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
