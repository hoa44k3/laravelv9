<div class="container mt-5">
    <h1 class="text-center mb-4">Danh sách bài viết</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-right">
        <a href="{{ route('backend.blog.create') }}" class="btn btn-primary">Thêm bài viết</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Tiêu đề</th>
                    <th>Tác giả</th>
                    <th>Ảnh</th>
                    <th>Danh mục</th>
                    <th>Lượt thích</th>
                    <th>Lượt bình luận</th>
                    <th>Trạng thái</th>
                    <th>Ngày đăng</th>
                    <th>Hành độn</th>
                </tr>
            </thead>
            <tbody>
                @if($blogs->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">Không có bài viết nào.</td>
                    </tr>
                @else
                    @foreach ($blogs as $blog)
                        <tr>
                            <td>
                                <a href="{{ route('backend.blog.show', $blog->id) }}" class="text-primary">{{ $blog->title }}</a>
                            </td>
                            <td>
                                @if ($blog->user)
                                    {{ $blog->user->name }}
                                @else
                                    Không có tác giả
                                @endif
                            </td>
                            <td>
                                @if($blog->image_path)
                                    <img src="{{ asset($blog->image_path) }}" alt="Image" style="width: 100px; height: auto;" />
                                @else
                                    Không có ảnh
                                @endif
                            </td>
                            <td>
                                @if ($blog->category)
                                    {{ $blog->category->name }}
                                @else
                                    Không có danh mục
                                @endif
                            </td>
                            <td>{{ $blog->likes_count }}</td>
                            <td>
                                <a href="{{ route('backend.comment.index', $blog->id) }}" class="btn btn-info">Xem bình luận</a>
                            </td>
                            <td>{{ $blog->status == 'approved' ? 'Đã phê duyệt' : 'Chờ phê duyệt' }}</td>
                            <td>{{ $blog->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('backend.blog.edit', $blog->id) }}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('backend.blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Xóa</button>
                                </form>
                                @if($blog->status == 'pending')
                                    <form action="{{ route('backend.blog.approve', $blog->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button class="btn btn-success" type="submit">Duyệt</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<style>
  
    .table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        border-radius: 0.5rem; 
        overflow: hidden; 
    }

    .table th, .table td {
        padding: 15px;
        text-align: center;
        border: 1px solid #dee2e6; 
    }

    .table th {
        background-color: #6e7175; 
        color: white; 
    }

    .table-hover tbody tr:hover {
        background-color: #e9ecef; 
    }

    .alert {
        margin-bottom: 20px; 
    }

    .text-primary {
        text-decoration: none; 
        font-weight: bold; 
    }

    .text-primary:hover {
        text-decoration: underline; 
    }

    /* Nút bấm */
    .btn {
        transition: background-color 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #ffc107; 
        color: black; 
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-info:hover {
        background-color: #138496; 
    }
</style>
