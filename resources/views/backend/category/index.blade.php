<div class="container mt-5">
    <h1 class="text-center mb-4">Categories</h1>
    <a href="{{ route('backend.category.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="category image" class="img-thumbnail" style="width: 50px; height: auto;">
                    </td>
                    <td>{{ $category->comments_count }}</td>
                    <td>
                        <a href="{{ route('backend.category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('backend.category.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #dee2e6;
    }

    .table th {
        background-color: #596571; 
        color: white; 
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa; 
    }

    .alert {
        margin-bottom: 20px; 
    }

    .btn-warning {
        background-color: #ffc107; 
        color: black;
    }

    .btn-danger {
        background-color: #dc3545; 
        color: white;
    }

    .img-thumbnail {
        border: 1px solid #dee2e6; 
        border-radius: 0.25rem; 
    }
</style>
