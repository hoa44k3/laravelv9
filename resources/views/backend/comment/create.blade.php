<div class="container">
    <h1>Thêm Bình Luận Cho Bài Viết: {{ $blog->title }}</h1>

    <form action="{{ route('backend.comment.store', $blog->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="author">Tác giả</label>
            <input type="text" name="author" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Lưu Bình Luận</button>
        <a href="{{ route('backend.comment.index', $blog->id) }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
