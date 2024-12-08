@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm Thẻ Tag</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên Thẻ Tag:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên thẻ tag" required>
                        </div>
                      
                        <div class="form-group">
                            <label for="blog_id">Chọn Bài Viết:</label>
                            <select name="blog_id" id="blog_id" class="form-control" required>
                                <option value="">-- Chọn Bài Viết --</option>
                                @foreach ($blogs as $blog)
                                    <option value="{{ $blog->id }}">{{ $blog->title }} (ID: {{ $blog->id }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 