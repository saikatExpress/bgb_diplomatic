{{-- LTR Modal Start --}}
<div class="modal fade" id="ltrModal" tabindex="-1" role="dialog" aria-labelledby="ltrModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="ltrModalLabel">Add New LTR Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="ltrForm" action="{{ route('ltrs.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="ltrName">LTR Subject Name</label>
                        <input type="text" id="ltrName" class="form-control" name="ltr_name"
                            placeholder="Enter LTR Subject Name" required />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submitLtr">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- LTR Modal End --}}
