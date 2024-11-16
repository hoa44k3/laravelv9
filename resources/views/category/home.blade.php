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
  $(document).ready(function() {
    // Thêm sự kiện click cho các nút xóa
    $('.btn-delete').on('click', function() {
        var id = $(this).data('id');  // Lấy id từ thuộc tính data-id
        var row = $(this).closest('tr');  // Lấy dòng tr của danh mục cần xóa
        
        // Xác nhận xóa
        if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
            $.ajax({
                url: '/category/' + id,  // Đảm bảo rằng URL chính xác
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',  // Chuyển token csrf
                    id: id  // Truyền id để xóa
                },
                success: function(response) {
                    // Kiểm tra phản hồi từ server
                    if (response.status === 'success') {
                        alert('Danh mục đã được xóa!');
                        row.remove();  // Xóa dòng trong bảng
                    } else {
                        alert('Có lỗi xảy ra!');
                    }
                },
                error: function(xhr, status, error) {
                    // In ra thông báo lỗi chi tiết trong console
                    console.error('AJAX Error: ', error);
                    alert('Có lỗi xảy ra!');
                }
            });
        }
    });
});


</script>

