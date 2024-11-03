
<div class="container">
    <h1>Thống Kê</h1>

    <h2>Tổng số bài viết: {{ $totalBlogs }}</h2>

    <h2>Tổng số bình luận: {{ $totalComments }}</h2>

    <h3>Tổng số lượt thích của từng bài viết:</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tựa đề</th>
                <th>Lượt thích</th>
            </tr>
        </thead>
        <tbody>
            @if (is_array($likesCount) || is_object($likesCount))
            @foreach ($likesCount as $blog)
                <tr>
                    <td>{{ $blog->id }}</td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->likes_count }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">Không có dữ liệu</td>
            </tr>
        @endif
        
        </tbody>
    </table>
</div>

