


    <h1>Thêm Lượt Thích</h1>
    <form action="{{ route('backend.likes.store') }}" method="POST">
        @csrf
        <label for="blog_id">Blog:</label>
        <select name="blog_id" required>
            @foreach($blogs as $blog)
                <option value="{{ $blog->id }}">{{ $blog->title }}</option>
            @endforeach
        </select>

        <label for="user_id">User:</label>
        <select name="user_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <button type="submit">Thêm</button>
    </form>
    <a href="{{ route('backend.likes.index') }}" class="btn btn-secondary">Quay lại</a>
