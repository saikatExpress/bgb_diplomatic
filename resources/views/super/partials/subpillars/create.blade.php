@extends('super.app')
@section('title', 'Create Sub Pillar')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Sub Pillar</h4>
                    <form class="forms-sample" method="POST" action="{{ route('super_admin.subpillars.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="pillar">Pillar</label>
                            <select name="pillar_id" id="pillar_id" class="form-control" required>
                                <option value="">Select Pillar</option>
                                @foreach ($pillars as $pillar)
                                    <option value="{{ $pillar->id }}">{{ filter($pillar->name) }}</option>
                                @endforeach
                            </select>
                            @error('pillar_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="code">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter sub pillar name" value="{{ old('name') }}" required>
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
@section('scripts')
<script>
    $(document).ready(function () {
        $('#pillar_id').select2({
            placeholder: 'Select Pillar',
            allowClear: true
        });
    });
</script>