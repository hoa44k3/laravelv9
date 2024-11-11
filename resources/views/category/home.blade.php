@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách category</h4>
                        <a href="{{ route('category.create') }}" class="btn btn-primary btn-round ms-auto" id="create-new-category">Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="laravel_9_datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td><img src="{{ asset('storage/' . $category->image_path) }}" alt="Image" style="width: 80px; height: 70px;">
                                        </td>
                                        
                                        <td>{{ $category->comment }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $category->id }}">Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')

<script>
    $.ajax({
    url: '/category/' + id,
    type: 'DELETE',
    data: {
        _token: '{{ csrf_token() }}',
        id: id
    },
    success: function(response) {
        if (response === 'success') {
            alert('Danh mục đã được xóa!');
            $('#laravel_9_datatable').DataTable().ajax.reload(); // Reload bảng sau khi xóa
        } else {
            alert('Có lỗi xảy ra!');
        }
    },
    error: function() {
        alert('Có lỗi xảy ra!');
    }
});

</script>