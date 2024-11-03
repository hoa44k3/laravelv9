
<div class="container">
    <h1>Chi tiết Danh mục: {{ $category->name }}</h1>

    <p><strong>ID:</strong> {{ $category->id }}</p>
    <p><strong>Mô tả:</strong> {{ $category->description ?? 'Không có mô tả' }}</p> {{-- Nếu bạn có thuộc tính description --}}
    
    <h2>Bài viết trong danh mục này:</h2>
    <ul>
        @foreach($category->blogs as $blog)
            <li>
                <a href="{{ route('backend.blog.show', $blog->id) }}">{{ $blog->title }}</a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('backend.category.index') }}" class="btn btn-secondary">Quay lại danh sách danh mục</a>
</div>

