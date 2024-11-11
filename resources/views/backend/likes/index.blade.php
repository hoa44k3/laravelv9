<div class="container mt-4">
    <h1 class="my-4">Danh sách Lượt Thích</h1>
    <a href="{{ route('backend.likes.create') }}" class="btn btn-success mb-3">Thêm Lượt Thích</a>

    <table class="table table-bordered table-striped table-hover" style="width: 100%; border-collapse: collapse;">
        <thead style="background-color: #343a40; color: white;">
            <tr>
                <th style="width: 10%; padding: 12px; border: 1px solid #dee2e6;">ID</th>
                <th style="width: 40%; padding: 12px; border: 1px solid #dee2e6;">Blog</th>
                <th style="width: 30%; padding: 12px; border: 1px solid #dee2e6;">User</th>
                <th style="width: 20%; padding: 12px; border: 1px solid #dee2e6;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($likes as $like)
                <tr>
                    <td style="padding: 12px; border: 1px solid #dee2e6;">{{ $like->id }}</td>
                    <td style="padding: 12px; border: 1px solid #dee2e6;">
                        @if($like->blog)
                            <a href="{{ route('backend.blog.show', $like->blog->id) }}" style="text-decoration: none; color: #007bff;">{{ $like->blog->title }}</a>
                        @else
                            <span style="color: #6c757d;">N/A</span>
                        @endif
                    </td>
                    <td style="padding: 12px; border: 1px solid #dee2e6;">
                        @if($like->user)
                            {{ $like->user->name }}
                        @else
                            <span style="color: #6c757d;">N/A</span>
                        @endif
                    </td>
                    <td style="padding: 12px; border: 1px solid #dee2e6;">
                        <a href="{{ route('backend.likes.edit', $like->id) }}" class="btn btn-warning btn-sm" style="margin-right: 5px;">Sửa</a>
                        <form action="{{ route('backend.likes.destroy', $like->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center" style="color: #6c757d;">Chưa có lượt thích nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>



