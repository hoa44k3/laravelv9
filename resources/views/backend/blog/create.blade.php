<div class="container mt-4">
    <h1 class="mb-4">Thêm Bài Viết Mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <table class="table table-bordered">
            <tr>
                <td class="w-25" style="padding: 20px;">
                    <div class="form-group">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" class="form-control" id="title" required>
                    </div>
                </td>
                <tr>
                    <td colspan="4" style="padding: 20px;">
                        <div class="form-group">
                            <label for="image">Ảnh</label>
                            <input type="file" name="image" class="form-control" id="image" accept="image/*">
                        </div>
                    </td>
                    
                </tr>
                <td class="w-25" style="padding: 20px;">
                    <div class="form-group">
                        <label for="user_id">Tác giả</label>
                        <select name="user_id" class="form-control" id="user_id" required>
                            <option value="">Chọn tác giả</option>
                            @foreach ($users as $user) 
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="w-25" style="padding: 20px;">
                    <div class="form-group">
                        <label for="category_id">Danh mục</label>
                        <select name="category_id" class="form-control" id="category_id" required>
                            <option value="">Chọn danh mục</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="w-25" style="padding: 20px;">
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" id="status" required>
                            <option value="approved">Đã phê duyệt</option>
                            <option value="pending">Chờ phê duyệt</option>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding: 20px;">
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea name="content" class="form-control" id="content" rows="5" required></textarea>
                    </div>
                </td>
                <td style="padding: 20px;">
                    <div class="form-group">
                        <label for="likes">Lượt thích</label>
                        <input type="number" name="likes" class="form-control" id="likes" value="0" required>
                    </div>
                </td>
                <td style="padding: 20px;">
                    <div class="form-group">
                        <label for="comment_count">Lượt bình luận</label>
                        <input type="number" name="comment_count" class="form-control" id="comment_count" value="0" required>
                    </div>
                </td>
            </tr>
            @if (old('image_path'))
                <tr>
                    <td colspan="4" style="padding: 20px;">
                        <p>Ảnh hiện tại: <img src="{{ asset(old('image_path')) }}" alt="Blog Image" style="max-width: 200px;" class="mt-2"></p>
                        <small>Để giữ lại ảnh này, không cần tải lên ảnh mới.</small>
                    </td>
                </tr>
            @endif
        </table>

        <button type="submit" class="btn btn-primary btn-lg">Lưu Bài Viết</button>
    </form>
</div>
