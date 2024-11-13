@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-10 offset-md-2">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h4 class="card-title">Danh sách bài viết</h4>
                                            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-round ms-auto">
                                                <i class="fa fa-plus"></i> Thêm Bài Viết
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="add-row" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Tên bài viết</th>
                                                        <th>Tác giả</th>
                                                        <th>Hình ảnh</th>
                                                        <th>Danh mục</th>
                                                        <th>Lượt thích</th>
                                                        <th>Trạng thái</th>
                                                        <th>Ngày tạo</th>
                                                        <th style="width: 10%">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($blogs as $blog)
                                                    <tr id="blog-{{ $blog->id }}">
                                                        <td>{{ $blog->title }}</td>
                                                        <td>{{ $blog->user ? $blog->user->name : 'Không có tác giả' }}</td>
                                                        {{-- <td><img src="{{ asset('storage/' . $blog->image_path) }}" alt="Image" style="width: 80px; height: 70px;"></td> --}}
                                                        {{-- <td>
                                                            <img src="{{ isset($blog->image_path) && $blog->image_path ? asset('storage/' . $blog->image_path) : asset('assets/img/avt1.jpg') }}" alt="Image" style="width: 80px; height: 70px;">
                                                        </td> --}}
                                                        <td>
                                                            <img src="{{ $blog->image_path ? asset('storage/' . $blog->image_path) : asset('assets/img/avt1.jpg') }}" alt="Image" style="width: 80px; height: 70px;">
                                                        </td>
                                                        
                                                        <td>{{ $blog->category ? $blog->category->name : 'Không có danh mục' }}</td>
                                                        <td>{{ $blog->likes_count }}</td>
                                                        <td id="status-{{ $blog->id }}">{{ $blog->status == 'approved' ? 'Đã phê duyệt' : 'Chờ phê duyệt' }}</td>
                                                        <td>{{ $blog->created_at->format('d/m/Y H:i') }}</td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-link btn-info btn-lg">
                                                                    <i class="fa fa-eye"></i> Xem chi tiết
                                                                </a>
                                                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-link btn-primary btn-lg">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-link btn-danger" onclick="deleteBlog({{ $blog->id }})">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-link btn-success" onclick="toggleApproval({{ $blog->id }})">
                                                                    <i class="fa fa-check"></i> {{ $blog->status == 'approved' ? 'Bỏ duyệt' : 'Duyệt' }}
                                                                </button>
                                                            </div>
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
function deleteBlog(id) {
    if (confirm('Bạn có chắc chắn muốn xóa bài viết này?')) {
        $.ajax({
            url: '{{ route("blog.destroy", ":id") }}'.replace(':id', id),
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.success);
                $('#blog-' + id).remove();
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    }
}

function toggleApproval(id) {
    $.ajax({
        url: '{{ route("blog.toggleApproval", ":id") }}'.replace(':id', id),
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
                location.reload(); // Tải lại trang để cập nhật trạng thái mới
            } else {
                alert(response.error || 'Có lỗi xảy ra');
            }
        },
        error: function() {
            alert('Có lỗi xảy ra, vui lòng thử lại.');
        }
    });
}
</script>
