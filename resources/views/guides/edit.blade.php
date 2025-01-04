@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sửa</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('guides.update', $guide->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Tiêu Đề</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $guide->title) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Nội Dung</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $guide->content) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Hình Ảnh</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if($guide->image)
                                <img src="{{ asset('storage/' . $guide->image) }}" alt="Hình ảnh hiện tại" width="100">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                        <a href="{{ route('guides.index') }}" class="btn btn-secondary">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>            
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
