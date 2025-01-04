@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $guide->title }}</h4>
                </div>

                <div class="card-body">
                    @if ($guide->image)
                        <p><strong>Hình ảnh:</strong></p>
                        <img src="{{ asset('storage/' . $guide->image) }}" 
                             alt="Guide Image" 
                             style="max-width: 100%; height: auto; border-radius: 5px;">
                    @else
                        <p><strong>Hình ảnh:</strong> Không có hình ảnh</p>
                    @endif

                    <div class="content mt-3">
                        <p>{!! nl2br(e($guide->content)) !!}</p>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('guides.index') }}" class="btn btn-primary">Quay lại danh sách hướng dẫn</a>
                        <a href="{{ route('guides.edit', $guide->id) }}" class="btn btn-warning">Sửa hướng dẫn</a>
                        <form action="{{ route('guides.destroy', $guide->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa hướng dẫn này?')">Xóa hướng dẫn</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
