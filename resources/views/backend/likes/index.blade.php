


    <h1>Danh sách Lượt Thích</h1>
    <a href="{{ route('backend.likes.create') }}">Thêm Lượt Thích</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Blog</th>
            <th>User</th>
            <th>Actions</th>
        </tr>
        @foreach($likes as $like)
            <tr>
                <td>{{ $like->id }}</td>
                <td>{{ $like->blog->title }}</td>
                <td>{{ $like->user->name }}</td>
                <td>
                    <a href="{{ route('backend.likes.edit', $like->id) }}">Sửa</a>
                    <form action="{{ route('backend.likes.destroy', $like->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

