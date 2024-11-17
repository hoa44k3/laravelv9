@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sửa danh mục</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image_path">Hình ảnh</label>
                            <input type="file" class="form-control" id="image_path" name="image_path" accept="image/*">
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="Preview" width="100px">
                        </div>
                        {{-- <div class="form-group">
                            <label for="comment">Mô tả</label>
                            <textarea class="form-control" id="comment" name="comment">{{ $category->comment }}</textarea>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 