<form action="{{ isset($category) ? route('backend.category.update', $category->id) : route('backend.category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($category))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name ?? '' }}" required>
    </div>
    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Add' }}</button>
</form>
