


    <h1>Sửa Lượt Thích</h1>
    <form action="{{ route('backend.likes.update', $like->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="blog_id">Blog:</label>
        <select name="blog_id" required>
            @foreach($blogs as $blog)
                <option value="{{ $blog->id }}" {{ $like->blog_id == $blog->id ? 'selected' : '' }}>{{ $blog->title }}</option>
            @endforeach
        </select>

        <label for="user_id">User:</label>
        <select name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $like->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>

        <button type="submit">Cập nhật</button>
    </form>
    <a href="{{ route('backend.likes.index') }}" class="btn btn-secondary">Quay lại</a>

