<form id="filterForm" class="row g-3 mb-3">
    <div class="col-md-4">
        <label class="form-label">Filter by Region</label>
        <select name="region_id" id="region_id" class="form-control">
            <option value="">All Regions</option>
            @foreach($regions as $region)
                <option value="{{ $region->id }}">{{ filter($region->name) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Sector Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Search by sector name">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button type="button" id="btnFilter" class="btn btn-primary me-2">
            <i class="fa fa-search"></i> Search
        </button>
        <button type="button" id="btnReset" class="btn btn-secondary">
            <i class="fa fa-undo"></i> Reset
        </button>
    </div>
</form>