@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<style>
    .table tbody tr:hover {
    background-color: #e8f0fe;
}

.table thead th, .table tbody td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

    .table thead th {
    background-color: #717172;
    color: white;
}
</style>
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
                                    {{-- <th>Comment</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td><img src="{{ asset('storage/' . $category->image_path) }}" alt="Image" style="width: 90px; height: 70px;">
                                        </td>       
                                      
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
                    url: '{{ route('category.destroy', '') }}/' + id,  // Đảm bảo đường dẫn đúng
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',  // Chuyển token csrf
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Danh mục đã được xóa!');
                            row.remove();  // Xóa dòng trong bảng
                        } else {
                            alert('Có lỗi xảy ra!');
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra!');
                    }
                });
            }
        });
    });
    </script>
    

