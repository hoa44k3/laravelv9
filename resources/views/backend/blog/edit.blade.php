<h1>Sửa bài viết</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('backend.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Tiêu đề</label>
        <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $blog->title) }}" required>
    </div>

    <div class="form-group">
        <label for="content">Nội dung</label>
        <textarea name="content" class="form-control" id="content" rows="5" required>{{ old('content', $blog->content) }}</textarea>
    </div>

    <div class="form-group">
        <label for="image">Ảnh</label>
        <input type="file" name="image" class="form-control" id="image">
        @if(isset($blog))
    <img src="{{ asset($blog->image_path) }}" alt="Blog Image" style="max-width: 200px;">
   

@endif
    </div>

    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" class="form-control" id="status" required>
            <option value="approved" {{ $blog->status == 'approved' ? 'selected' : '' }}>Đã phê duyệt</option>
            <option value="pending" {{ $blog->status == 'pending' ? 'selected' : '' }}>Chờ phê duyệt</option>
        </select>
    </div>
    <div class="form-group">
        <label for="category_id">Danh mục</label>
        <select name="category_id" class="form-control" id="category_id" required>
            <option value="">Chọn danh mục</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="likes">Lượt thích</label>
        <input type="number" name="likes" class="form-control" id="likes" value="{{ old('likes', $blog->likes) }}" min="0" readonly>
    </div>

    <div class="form-group">
        <label for="comment_count">Lượt bình luận</label>
        <input type="number" name="comment_count" class="form-control" id="comment_count" value="{{ old('comment_count', $blog->comment_count) }}" min="0" readonly>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
    <a href="{{ route('backend.blog.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
