{{-- GR Modal Start --}}
<div class="modal fade" id="grNoModal" tabindex="-1" role="dialog" aria-labelledby="grNoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="grNoModalLabel">Add New GR NO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="grNoCreateForm">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">GR Title</label>
                        <input type="text" id="grdTitle" class="form-control" name="title" placeholder="Enter gr Title"
                            required />
                    </div>

                    <button type="submit" id="submitGr" class="btn btn-primary">Save GR No</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
{{-- GR Modal End --}}

@push('script')
    <script>
        $(document).ready(function () {
            $('#grNoCreateForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('gr.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response && response.status == 'success') {
                            toastr.success(response.message);
                            let newOption = `<option value="${response.data.slug}" selected>${response.data.title}</option>`;
                            $("#grSelect").append(newOption);


                            $('#grNoCreateForm')[0].reset();
                            $("#grNoModal").modal("hide");
                        }
                    },
                    error: function (xhr) {
                        toastr.alert('Error creating gr.');
                    }
                });
            });
        });
    </script>
@endpush
