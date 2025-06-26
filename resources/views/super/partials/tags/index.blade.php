@extends('super.app')
@section('title', 'All Tags')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Tags</h4>
                        <a href="{{ route('super_admin.tags.create') }}" class="btn btn-sm btn-primary">
                            Add Tag
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Input Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ filter($tag->title) }}</td>
                                        <td>{{ filter($tag->input_name) }}</td>

                                        <td>
                                            <a href="{{ route('super_admin.tags.edit', $tag->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>
                                            <form action="{{ route('super_admin.tags.destroy', $tag->id) }}" method="POST"
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
