@extends('super.app')
@section('title', 'Edit Sub Pillar')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Sub Pillar</h4>
                    <form class="forms-sample" method="POST"
                        action="{{ route('super_admin.subpillars.update', $subpillar->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="pillar">Pillar</label>
                            <select name="pillar_id" id="pillar_id" class="form-control" required>
                                <option value="">Select Pillar</option>
                                @foreach ($pillars as $pillar)
                                    <option value="{{ $pillar->id }}" {{ $subpillar->pillar_id == $pillar->id ? 'selected' : '' }}>
                                        {{ filter($pillar->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pillar_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter sub pillar name"
                                value="{{ old('name', $subpillar->name) }}" required>
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="s" {{ $subpillar->type == 's' ? 'selected' : '' }}>S</option>
                                <option value="t" {{ $subpillar->type == 't' ? 'selected' : '' }}>T</option>
                                <option value="r" {{ $subpillar->type == 'r' ? 'selected' : '' }}>R</option>
                                <option value="pool" {{ $subpillar->type == 'pool' ? 'selected' : '' }}>Pool</option>
                            </select>
                            @error('type')
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
@section('scripts')
<script>
    $(document).ready(function () {
        $('#pillar_id').select2({
            placeholder: 'Select Pillar',
            allowClear: true
        });
    });
</script>
