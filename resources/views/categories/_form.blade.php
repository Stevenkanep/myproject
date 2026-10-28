<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}">
    @error('name')
    <div class="text-danger">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
</div>
<button class="btn btn-success">Save</button>
<a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>