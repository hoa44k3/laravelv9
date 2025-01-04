@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $event->title }}</h4>
                </div>

                <div class="card-body">
                    <p><strong>Mô tả:</strong></p>
                    {{-- <p>{{ $event->description }}</p> --}}
                    <p>{!! $event->description !!}</p>

                    <p><strong>Ngày sự kiện:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}</p>
                    
                    @if ($event->image)
                        <p><strong>Hình ảnh:</strong></p>
                        <img src="{{ asset('storage/' . $event->image) }}" 
                             alt="Event Image" 
                             style="max-width: 100%; height: auto; border-radius: 5px;">
                    @else
                        <p><strong>Hình ảnh:</strong> Không có hình ảnh</p>
                    @endif
                    
                    <div class="mt-4">
                        <a href="{{ route('events.index') }}" class="btn btn-primary">Quay lại danh sách sự kiện</a>
                        <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Sửa sự kiện</a>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sự kiện này?')">Xóa sự kiện</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
