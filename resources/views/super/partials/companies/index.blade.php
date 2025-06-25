@extends('super.app')
@section('title', 'All Companies')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Companies</h4>
                        <a href="{{ route('super_admin.companies.create') }}" class="btn btn-sm btn-primary">
                            Add Company
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Battlion</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ filter($company->battalion->name) }}</td>
                                        <td>{{ $company->code }}</td>
                                        <td>{{ filter($company->name) }}</td>

                                        <td>
                                            <a href="{{ route('super_admin.companies.edit', $company->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('super_admin.companies.destroy', $company->id) }}"
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