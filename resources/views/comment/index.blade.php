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
                                        <td>{!! $comment->content !!}</td>

                                        <td>{{ $comment->user ? $comment->user->name : 'Không có tác giả' }}</td>
                                        <td>{{ $comment->created_at ? $comment->created_at->format('d/m/Y H:i') : 'Không có ngày tạo' }}</td> 
                                        <td>    
                                            <button type="button" class="btn btn-primary btn-sm btn-edit" data-id="{{ $comment->id }}" data-content="{{ $comment->content }}">Chỉnh sửa</button>                      
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

<!-- Modal chỉnh sửa -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Chỉnh sửa bình luận</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="commentContent" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="saveComment">Lưu</button>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
<script>
    var editorInstance;
    $(document).ready(function() {
        // Mở modal và khởi tạo CKEditor khi nhấn nút chỉnh sửa
        $('.btn-edit').click(function() {
            var commentId = $(this).data('id');
            var content = $(this).data('content');
            
            // Hiển thị modal và thiết lập nội dung ban đầu
            $('#editModal').modal('show');
            $('#commentContent').val(content);

            // Khởi tạo CKEditor
            if (editorInstance) {
                editorInstance.destroy();
            }
            ClassicEditor
                .create(document.querySelector('#commentContent'))
                .then(editor => {
                    editorInstance = editor;
                    editor.setData(content);
                })
                .catch(error => {
                    console.error(error);
                });

            // Xử lý sự kiện lưu
            $('#saveComment').off('click').on('click', function() {
                var updatedContent = editorInstance.getData();
                $.ajax({
                    url: '{{ route('comment.update', [':blog', ':comment']) }}'
                          .replace(':blog', '{{ $comment->blog_id ?? 0 }}')
                          .replace(':comment', commentId),
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        content: updatedContent
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            $('#comment-' + commentId + ' td:nth-child(3)').html(updatedContent);
                            $('#editModal').modal('hide');
                        } else {
                            alert(response.error || 'Có lỗi xảy ra');
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra, vui lòng thử lại.');
                    }
                });
            });
        });

        // Xóa bình luận
        $('.btn-delete').click(function() {
            var commentId = $(this).data('id');
            if (confirm('Bạn có chắc chắn muốn xóa bình luận này?')) {
                $.ajax({
                    url: '{{ route('comment.destroy', ':id') }}'.replace(':id', commentId),
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
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
