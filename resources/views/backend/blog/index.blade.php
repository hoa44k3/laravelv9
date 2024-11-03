<h1>Danh sách bài viết</h1>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('backend.blog.create') }}" class="btn btn-primary">Thêm bài viết</a>
<table class="table">
    <thead>
        <tr>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
            <th>Ảnh</th>
            <th>Danh mục</th>
            <th>Lượt thích</th>
            <th>Lượt bình luận</th>
            <th>Trạng thái</th>
            <th>Ngày đăng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @if($blogs->isEmpty())
            <tr>
                <td colspan="5" class="text-center">Không có bài viết nào.</td>
            </tr>
        @else
            @foreach ($blogs as $blog)
                <tr>
                  
                    <td><a href="{{ route('backend.blog.show', $blog->id) }}">{{ $blog->title }}</a></td>
                    {{-- <td>{{ $blog->user->name }}</td> --}}
                    <td>
                        @if ($blog->user)
                            {{ $blog->user->name }}
                        @else
                            Không có tác giả
                        @endif
                    </td>
                    
                    <td>
                        @if($blog->image_path)
                            <img src="{{ asset($blog->image_path) }}" alt="Image" style="width: 100px;height:auto;" />
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
                    <td>{{ $blog->created_at }}</td>
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
