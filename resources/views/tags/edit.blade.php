@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sửa Thẻ Tag</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Tên Thẻ Tag:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="blog_id">Blog ID:</label>
                            <input type="number" name="blog_id" id="blog_id" class="form-control" value="{{ $tag->blog_id }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 
