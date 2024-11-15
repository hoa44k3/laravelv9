@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2>Thêm Bài Viết</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Tên bài viết</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="user_id">Tác giả</label>
                        <select class="form-control" name="user_id" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="content">Nội dung</label>
                        <textarea class="form-control" name="content" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Danh mục</label>
                        <select class="form-control" name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="image_path">Hình ảnh</label>
                        <input type="file" class="form-control" name="image_path"class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm bài viết</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 
