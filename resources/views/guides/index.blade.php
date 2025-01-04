@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Danh sách hướng dẫn</h4>
                        <a href="{{ route('guides.create') }}" class="btn btn-primary btn-round ms-auto">Thêm </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="guides-table" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th> 
                                    <th>Hình ảnh</th>
                                    <th>Nội dung</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guides as $guide)
                                    <tr>
                                        <td>
                                            <a href="{{ route('guides.show', $guide->id) }}">{{ $guide->title }}</a>
                                        </td>
                                    
                                        <td>
                                            @if($guide->image)
                                                <img src="{{ asset('storage/' . $guide->image) }}" alt="{{ $guide->title }}" width="100">
                                            @else
                                                <span>Không có hình ảnh</span>
                                            @endif
                                        </td>
                                        <td>
                                            {!! \Illuminate\Support\Str::limit($guide->content, 200) !!}
                                            <br>
                                            <small>({{ strlen($guide->content) }} characters)</small>
                                        </td>
                                        
                                        <td>{{ $guide->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $guide->updated_at->format('d/m/Y') }}</td>
                                        <td>
                                         
                                            <a href="{{ route('guides.edit', $guide->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                            <form action="{{ route('guides.destroy', $guide->id) }}" method="POST" style="display:inline;">
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

<script>
    $(document).ready(function() {
        $('#guides-table').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "order": [[1, 'desc']], // Mặc định sắp xếp theo ngày tạo
            "lengthMenu": [5, 10, 25, 50], // Số lượng bản ghi trên mỗi trang
            "language": {
                "paginate": {
                    "next": "Tiếp theo",
                    "previous": "Trước"
                },
                "info": "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ bản ghi",
                "search": "Tìm kiếm:",
                "lengthMenu": "Hiển thị _MENU_ bản ghi"
            }
        });
    });
</script>
