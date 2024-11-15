@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        @if ($blog)
                            Bình luận thuộc bài viết: {{ $blog->title }}
                        @else
                            Danh sách tất cả bình luận
                        @endif
                    </h4>
                    @if ($blog)
    <a href="{{ route('comment.create', ['blog' => $blog->id]) }}" class="btn btn-success btn-sm">Thêm bình luận</a>
@else
    <!-- Nếu không có $blog, bạn có thể không hiển thị nút này hoặc thay đổi hành động khác -->
    <p>Không có bài viết, không thể thêm bình luận.</p>
@endif


                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tên bài viết</th>
                                <th>Tên danh mục</th>
                                <th>Nội dung</th>
                                <th>Người dùng</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($comments as $comment)
                                <tr id="comment-{{ $comment->id }}">
                                    <td>{{ $comment->blog->title ?? 'Không có bài viết' }}</td>
                                    <td>{{ $comment->blog->category->name ?? 'Không có danh mục' }}</td>
                                    <td>{!! $comment->content !!}</td>
                                    <td>{{ $comment->user->name ?? 'Không có tác giả' }}</td>
                                    <td>
                                        {{ $comment->created_at ? $comment->created_at->format('d/m/Y H:i') : 'Không có ngày tạo' }}
                                    </td>
                                    <td>
                                        @if ($blog)
                                        <a href="{{ route('comment.edit', ['blog' => $blog->id, 'comment' => $comment->id]) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    @else
                                        <p>Không có bài viết để sửa bình luận.</p>
                                    @endif
                                    

                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $comment->id }}">Xóa</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Không có bình luận nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')

<script>
    $(document).on('click', '.btn-delete', function() {
        let commentId = $(this).data('id');
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
</script>
