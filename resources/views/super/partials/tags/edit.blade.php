@extends('super.app')
@section('title', 'Edit Tag')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Tag</h4>
                    <form class="forms-sample" method="POST" action="{{ route('super_admin.tags.update', $tag->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="code">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                                value="{{ old('title', $tag->title) }}" required>
                            @error('title')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Input Name</label>
                            <input type="text" class="form-control" id="input_name" name="input_name"
                                placeholder="Enter input name" value="{{ old('input_name', $tag->input_name) }}" required>
                            @error('input_name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
