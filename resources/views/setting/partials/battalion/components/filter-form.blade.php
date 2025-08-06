<form id="filterForm" class="row g-3 mb-3">
    <div class="col-md-4">
        <label class="form-label">Filter by Sector</label>
        <select name="sector_id" id="sector_id" class="form-control select3">
            <option value="">All Sector</option>
            @foreach($sectors as $sector)
                <option value="{{ $sector->id }}">{{ filter($sector->name) }}</option>
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