{{-- Incident Modal Start --}}
<div class="modal fade" id="incidentModal" tabindex="-1" role="dialog" aria-labelledby="incidentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="incidentModalLabel">Add New Incident</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('incidents.store') }}" method="post" id="incidentForm">
                    @csrf
                    <div class="form-group">
                        <label for="incidentDescription">Incident Title</label>
                        <input type="text" id="incidentTitle" class="form-control" name="title"
                            placeholder="Enter Incident Title" required />
                    </div>

                    <button type="button" id="submitIncident" class="btn btn-primary">Save Incident</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- Incident Modal End --}}
