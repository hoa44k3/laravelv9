@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container mt-5">
    <h1 class="text-center mb-4">Thêm Bình Luận Cho Bài Viết: {{ $blog->title }}</h1>

    <form action="{{ route('comment.store', ['blog' => $blog->id]) }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="user_id">Tác giả</label>
            <select name="user_id" class="form-control" required>
                <option value="">Chọn tác giả</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Danh mục</label>
            <select name="category_id" class="form-control" required>
                <option value="">Chọn danh mục</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="content">Nội dung</label>
            <textarea name="content" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="created_at">Ngày Tạo</label>
            <input type="text" class="form-control" value="{{ now()->format('d/m/Y H:i:s') }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Lưu Bình Luận</button>
        <a href="{{ route('comment.index', ['blog' => $blog->id]) }}" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 