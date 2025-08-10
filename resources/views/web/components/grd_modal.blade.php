{{-- GRD Modal Start --}}
<div class="modal fade" id="grdModal" tabindex="-1" role="dialog" aria-labelledby="grdModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="grdModalLabel">Add New GRD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="grdCreateForm">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">GRD Title</label>
                        <input type="text" id="grdTitle" class="form-control" name="title" placeholder="Enter grd Title"
                            required />
                    </div>

                    <button type="submit" id="submitGrd" class="btn btn-primary">Save GRD</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- GRD Modal End --}}

@push('script')
    <script>
        $(document).ready(function () {
            $('#grdCreateForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('grd.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response && response.status == 'success') {
                            toastr.success(response.message);
                            let newOption = `<option value="${response.data.slug}" selected>${response.data.title}</option>`;
                            $("#grdSelect").append(newOption);


                            $('#grdCreateForm')[0].reset();
                            $("#grdModal").modal("hide");
                        }
                    },
                    error: function (xhr) {
                        toastr.alert('Error creating grd.');
                    }
                });
            });
        });
    </script>
@endpush
