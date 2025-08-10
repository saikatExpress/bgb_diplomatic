{{-- Pillar Modal Start --}}
<div class="modal fade" id="addPillarModal" tabindex="-1" role="dialog" aria-labelledby="addPillarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addNewModalLabel">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="pillarForm" action="{{ route('pillars.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="pillarName">Pillar Name</label>
                        <input type="text" id="pillarName" class="form-control" name="pillar_name"
                            placeholder="Enter Pillar Name" required />
                    </div>
                    <button type="button" id="submitPillar" class="btn btn-primary">Save Pillar</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- Pillar Modal End --}}
