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
                <form id="incidentForm">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="incidentDescription">Incident Title</label>
                        <input type="text" id="incidentTitle" class="form-control" name="title"
                            placeholder="Enter Incident Title" required />
                    </div>

                    <button type="submit" class="btn btn-primary">Save Incident</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- Incident Modal End --}}

@push('script')
    <script>
        $(document).ready(function () {
            $('#incidentForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('incidents.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response && response.status == 'success') {
                            toastr.success(response.message);
                            let newOption = `<option value="${response.data.id}" selected>${response.data.title}</option>`;
                            $("#incidentSelect").append(newOption);


                            $('#incidentForm')[0].reset();
                            $("#incidentModal").modal("hide");
                        }
                    },
                    error: function (xhr) {
                        toastr.alert('Error creating incident.');
                    }
                });
            });
        });
    </script>
@endpush
