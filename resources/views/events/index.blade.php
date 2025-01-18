
@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Danh sách sự kiện</h4>
                        <a href="{{ route('events.create') }}" class="btn btn-primary btn-round ms-auto">Thêm sự kiện</a>
                    </div>
                </div>
                <div class="card-body">
                   <div class="table-responsive">
                        <table id="guides-table" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Người tổ chức</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th>Nội dung</th>
                                    <th>Ngày sự kiện</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>
                                            {{ $event->user ? $event->user->name : 'Không xác định' }} <!-- Hiển thị tên tác giả -->
                                        </td>
                                        <td>
                                            <a href="{{ route('events.show', $event->id) }}">{{ $event->title }}</a>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . ltrim($event->image)) }}" 
                                            alt="Image" style="width: 90px; height: 70px; object-fit: cover;">
                                        </td>
                                      
                                        <td>
                                            {!! \Illuminate\Support\Str::limit($event->description, 200) !!}
                                            <br>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}</td>

                                        <td>
                                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                   </div>  
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>