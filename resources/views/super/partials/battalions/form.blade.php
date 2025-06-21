<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $battalion->name ?? '') }}"
        required>
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3"
        required>{{ old('description', $battalion->description ?? '') }}</textarea>
</div>
<div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control-file" id="image" name="image">
    @if(isset($battalion) && $battalion->image)
        <img src="{{ asset('storage/' . $battalion->image) }}" alt="{{ $battalion->name }}" class="img-thumbnail mt-2"
            style="max-width: 200px;">
    @endif
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status" required>
        <option value="active" {{ (isset($battalion) && $battalion->status == 'active') ? 'selected' : '' }}>Active
        </option>
        <option value="inactive" {{ (isset($battalion) && $battalion->status == 'inactive') ? 'selected' : '' }}>
            Inactive</option>
    </select>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ isset($battalion) ? 'Update Battalion' : 'Add Battalion' }}
    </button>
    <a href="{{ route('super_admin.battalions') }}" class="btn btn-secondary">Cancel</a>
</div>
@if(isset($battalion))
    <input type="hidden" name="_method" value="PUT">
@else
    <input type="hidden" name="_method" value="POST">
@endif
@if(isset($battalion))
    <input type="hidden" name="id" value="{{ $battalion->id }}">
@else
    <input type="hidden" name="id" value="">
@endif
@if(isset($battalion))
    <input type="hidden" name="old_image" value="{{ $battalion->image }}">
@else
    <input type="hidden" name="old_image" value="">
@endif
@if(isset($battalion))
    <input type="hidden" name="created_by" value="{{ $battalion->created_by }}">
@else
    <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
@endif
@if(isset($battalion))
    <input type="hidden" name="updated_by" value="{{ $battalion->updated_by }}">
@else
    <input type="hidden" name="updated_by" value="{{ auth()->user()->id }}">
@endif
@if(isset($battalion))
    <input type="hidden" name="deleted_by" value="{{ $battalion->deleted_by }}">
@else
    <input type="hidden" name="deleted_by" value="">
@endif
@if(isset($battalion))
    <input type="hidden" name="deleted_at" value="{{ $battalion->deleted_at }}">
@else
    <input type="hidden" name="deleted_at" value="">
@endif