
@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sửa sự kiện</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('events.update', $event->id) }}" method="POST"enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="user_id">Người tạo</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $event->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Nội Dung</label>
                            <textarea name="description" id="editor" rows="10" class="form-control">{{ old('description', $event->description) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="event_date">Ngày sự kiện</label>
                            <input type="date" name="event_date" id="event_date" class="form-control" value="{{ $event->event_date->format('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Hình Ảnh</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="Hình ảnh hiện tại" width="100">
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
