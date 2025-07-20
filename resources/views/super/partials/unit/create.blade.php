@extends('super.app')
@section('title', 'Create Unit')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Unit</h4>
                    <form class="forms-sample" method="POST" action="{{ route('unit.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="unit">Name</label>
                            <input type="text" class="form-control" id="unit" name="name" placeholder="Enter unit name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Create</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
