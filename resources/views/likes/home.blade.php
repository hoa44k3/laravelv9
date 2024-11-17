@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<style>
    .table tbody tr:hover {
    background-color: #e8f0fe;
}

.table thead th, .table tbody td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

    .table thead th {
    background-color: #717172;
    color: white;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Danh sách lượt thích</h4>
                        <a href="{{ route('likes.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i> Thêm Lượt Thích
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Blog</th>
                                    <th>User</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="likesTable">
                                @foreach($likes as $like)
                                    <tr id="like-{{ $like->id }}">
                                        <td>{{ $like->id }}</td>
                                        <td>{{ $like->blog ? $like->blog->title : 'N/A' }}</td>
                                        <td>{{ $like->user ? $like->user->name : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('likes.edit', $like->id) }}" class=" btn btn-warning btn-sm">Sửa</a>
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $like->id }}">Xóa</button>
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
$(document).on('click', '.deleteLike', function() {
    let likeId = $(this).data('id');
    if (confirm('Bạn có chắc chắn muốn xóa lượt thích này?')) {
        $.ajax({
            url: '/admin/like/' + likeId, // Đảm bảo URL chính xác
            type: 'DELETE',
            data: { 
                _token: '{{ csrf_token() }}' 
            },
            success: function(response) {
                alert(response.success);
                $('#like-' + likeId).remove(); // Xóa hàng khỏi bảng
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    }
});

</script>
