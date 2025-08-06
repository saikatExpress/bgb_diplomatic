<form method="GET" action="{{ route('region.index') }}" class="row g-3 mb-3">
    <div class="col-md-3">
        <input type="text" name="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}">
    </div>
    <div class="col-md-2">
        <input type="text" name="code" class="form-control" placeholder="Code" value="{{ request('code') }}">
    </div>
    <div class="col-md-3">
        <select name="country" id="" class="form-control">
            <option value="">Select Country</option>
            <option value="bangladesh">Bangladesh</option>
            <option value="india">India</option>
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa fa-search"></i> Search
        </button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('region.index') }}" class="btn btn-secondary w-100">
            <i class="fa fa-undo"></i> Reset
        </a>
    </div>
</form>