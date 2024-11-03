<h1>Bài viết: {{ $blog->title }}</h1>
<p>Tổng lượt thích: {{ $totalLikes }}</p>
<p>Tổng bình luận: {{ $totalComments }}</p>

<h2>Bình luận:</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tác giả</th>
            <th>Nội dung</th>
            <th>Ngày tạo</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>
                    @if($blog->user)
                    {{ $blog->user->name }}
                @else
                    N/A
                @endif
                </td>
                <td>{{ $comment->content }}</td>
                <td>{{ $blog->created_at }}</td>
                <td>
                    <a href="{{ route('backend.comment.edit', ['blog' => $comment->blog_id, 'comment' => $comment->id]) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('backend.comment.destroy', ['blog' => $comment->blog_id, 'comment' => $comment->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
