@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách bình luận</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tên bài viết</th>
                                    <th>Tên danh mục</th>
                                    <th>Nội dung</th>
                                    <th>Người dùng</th>
                                    <th>Ngày tạo</th>
                                    <th style="width: 10%">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr id="comment-{{ $comment->id }}">
                                        <td>{{ $comment->blog ? $comment->blog->title : 'Không có bài viết' }}</td>
                                        <td>{{ $comment->blog && $comment->blog->category ? $comment->blog->category->name : 'Không có danh mục' }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>{{ $comment->user ? $comment->user->name : 'Không có tác giả' }}</td>
                                        <td>{{ $comment->created_at ? $comment->created_at->format('d/m/Y H:i') : 'Không có ngày tạo' }}</td> 
                                        <td>                          
                                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $comment->id }}">Xóa</button>
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
        $('.btn-delete').click(function() {
            var commentId = $(this).data('id');

            if (confirm('Bạn có chắc chắn muốn xóa bình luận này?')) {
                $.ajax({
                    url: '{{ route('comment.destroy', ':id') }}'.replace(':id', commentId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            $('#comment-' + commentId).remove(); 
                        } else {
                            alert(response.error || 'Có lỗi xảy ra');
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra, vui lòng thử lại.');
                    }
                });
            }
        });
    });
</script>
