<div class="container">
    <h1>Chỉnh Sửa Bình Luận</h1>
    <form action="{{ route('backend.comment.update', ['blog' => $blog->id, 'comment' => $comment->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="author">Tác giả</label>
            <input type="text" name="author" class="form-control" value="{{ $comment->author }}" required>
        </div>
        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" required>{{ $comment->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="category">Danh mục</label>
            @if($comment->blog && $comment->blog->category) {{-- Kiểm tra nếu blog và category tồn tại --}}
                <p class="form-control">{{ $comment->blog->category->name }}</p>
            @else
                <p class="form-control">Không có danh mục</p> {{-- Hiển thị nếu không có danh mục --}}
            @endif
        </div>
        
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    
   
</div>
