@extends('super.app')
@section('title', 'Edit BOP')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit BOP</h4>
                    <form class="forms-sample" method="POST" action="{{ route('super_admin.bops.update', $bop->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="company">Company</label>
                            <select name="company_id" id="company_id" class="form-control" required>
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ $company->id == $bop->company_id ? 'selected' : '' }}>
                                        {{ filter($company->name) }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="code">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter sub pillar name" value="{{ old('name', $bop->name) }}" required>
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
@section('scripts')
<script>
    $(document).ready(function () {
        $('#company_id').select2({
            placeholder: 'Select Company',
            allowClear: true
        });
    });
</script>