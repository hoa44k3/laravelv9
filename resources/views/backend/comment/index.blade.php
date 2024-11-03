<div class="container">
    <h1>Danh sách bình luận cho bài viết: {{ $blog->title ?? 'Tất cả bình luận' }}</h1>
    @if(isset($blog))
        <a href="{{ route('backend.comment.create', ['blog' => $blog->id ?? null]) }}" class="btn btn-primary mb-3">Thêm bình luận</a> 
        
        <a href="{{ route('backend.comment.index', ['blog' => $blog->id]) }}">Xem danh sách bình luận</a>
    @endif
    

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tác giả</th>
                <th>Bài viết</th>
                <th>Danh mục</th>
                <th>Nội dung</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->author }}</td>
                <td>
                    @if($comment->blog)  
                        <a href="{{ route('backend.blog.show', $comment->blog->id) }}">
                            {{ $comment->blog->title }}
                        </a>
                    @else
                        N/A  
                    @endif
                </td>
                <td>
                    @if($comment->blog && $comment->blog->category)  
                    <a href="{{ route('backend.category.show', $comment->blog->category->id) }}">
                        {{ $comment->blog->category->name }}
                    </a>
                @else
                    N/A  
                @endif
                    
                </td>
                
                <td>{{ $comment->content }}</td>
                
                <td>{{ $comment->created_at }}</td>
                <td>
                    @if($comment->blog) 
                        <a href="{{ route('backend.comment.edit', ['blog' => $comment->blog->id, 'comment' => $comment->id]) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('backend.comment.destroy', ['blog' => $comment->blog->id, 'comment' => $comment->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    @else
                        N/A  
                    @endif
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
