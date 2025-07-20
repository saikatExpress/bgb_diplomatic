@extends('super.app')
@section('title', 'Edit Unit')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Unit</h4>
                    <form class="forms-sample" method="POST" action="{{ route('unit.update', $unit->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="unit">Name</label>
                            <input type="text" class="form-control" id="unit" name="name" placeholder="Enter unit name"
                                value="{{ old('name', $unit->name) }}" required>
                            @error('name')
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
