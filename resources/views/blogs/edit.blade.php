@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
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
                            <textarea class="form-control" name="content" id="content-editor" rows="4" required>{{ old('content', $blog->content) }}</textarea>
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
                            <img src="{{ asset(ltrim($blog->image_path, 'http://127.0.0.1:8000/')) }}" alt="Image"style="width: 80px; height: 70px;">
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <label for="tag_ids">Thẻ</label>
                            <select class="form-control" name="tag_ids[]" id="tag_ids" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" 
                                        {{ in_array($tag->id, old('tag_ids', $blog->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="tags">Thẻ</label>
                            <input type="text" class="form-control" name="tags" id="tags" value="{{ old('tags', $blog->tags) }}" placeholder="Nhập thẻ, cách nhau bằng dấu phẩy">
                        </div> --}}
                        
                        <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#content-editor'))
            .catch(error => {
                console.error(error);
            });
    });
</script>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 