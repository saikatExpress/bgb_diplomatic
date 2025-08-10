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
                <form id="pillarForm">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="pillarName">Pillar Name</label>
                        <input type="text" id="pillarName" class="form-control" name="name"
                            placeholder="Enter Pillar Name" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Save Pillar</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- Pillar Modal End --}}

@push('script')
    <script>
        $(document).ready(function () {
            $('#pillarForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('pillar.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response && response.status == 'success') {
                            toastr.success(response.message);
                            let newOption = `<option value="${response.data.id}" selected>${response.data.name}</option>`;
                            $("#pillarSelect").append(newOption);


                            $('#pillarForm')[0].reset();
                            $("#addPillarModal").modal("hide");
                        }
                    },
                    error: function (xhr) {
                        toastr.alert('Error creating pillar.');
                    }
                });
            });
        });
    </script>
@endpush
