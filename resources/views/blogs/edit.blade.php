@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<div class="container-fluid">
<div class="row">
    <div class="col-md-10 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Sửa bài viết</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="title">Tên bài viết</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $blog->title) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Tác giả</label>
                        <select class="form-control" name="user_id" id="user_id" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $blog->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea class="form-control" name="content" id="content" rows="4" required>{{ old('content', $blog->content) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Danh mục</label>
                        <select class="form-control" name="category_id" id="category_id" required>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                        </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Hình ảnh</label>
                        <input type="file" class="form-control" name="image_path" id="image">
                        @if($blog->image_path)
                            <img src="{{ Storage::url($blog->image_path) }}" alt="Image" class="mt-2" style="width: 100px;">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 