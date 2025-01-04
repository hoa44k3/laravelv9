
@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }
    
    .table thead th {
        background-color: #f8f9fa;
        font-weight: bold;
        text-transform: uppercase;
    }
    
    .table tbody td {
        vertical-align: middle;
        padding: 10px;
    }
    
    .table img {
        border-radius: 5px;
        object-fit: cover;
    }
    
    .scrollable-table {
        overflow-x: auto;
    }
    
    .form-button-action {
        display: flex;
        justify-content: center;
        gap: 5px;
    }
    
    .btn-link {
        text-decoration: none;
        font-size: 14px;
    }
    .table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

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
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách bài viết</h4>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="scrollable-table">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên bài viết</th>
                                        <th>Tác giả</th>
                                        <th>Hình ảnh</th>
                                        <th>Danh mục</th>
                                        <th>Lượt thích</th>
                                        <th>Lượt bình luận</th>
                                  
                                        <th>Ngày tạo</th>
                                        <th>Thẻ bài viết</th>
                                        <th style="width: 10%">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      {{-- Hiển thị bài viết nổi bật --}}
                                    @if ($featuredBlog)
                                    <tr id="blog-{{ $featuredBlog->id }}" style="background-color: #ffeeba; font-weight: bold;">
                                        <td>
                                            <span style="color: #e74c3c; font-size: 18px;">★</span> 
                                            {{ \Illuminate\Support\Str::limit($featuredBlog->title, 30, '...') }}
                                        </td>
                                        <td>{{ $featuredBlog->user ? $featuredBlog->user->name : 'Không có tác giả' }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . ltrim($featuredBlog->image_path, 'http://127.0.0.1:8000/')) }}" alt="Image" style="width: 90px; height: 70px;">
                                        </td>
                                        <td>{{ $featuredBlog->category ? $featuredBlog->category->name : 'Không có danh mục' }}</td>
                                        <td>{{ $featuredBlog->likes_count }}</td>
                                        <td>
                                            <button class="btn btn-link" onclick="showCommentForm({{ $featuredBlog->id }})">
                                                {{ $featuredBlog->comments_count }}
                                            </button>
                                        </td>
                                       
                                        <td>{{ $featuredBlog->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @foreach ($featuredBlog->tags as $tag)
                                                <span class="badge bg-primary">{{ $tag->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('blogs.show', $featuredBlog->id) }}" class="btn btn-link btn-info btn-lg">
                                                    <i class="fa fa-eye"></i> 
                                                </a>
                                                <a href="{{ route('blogs.edit', $featuredBlog->id) }}" class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-link btn-danger" onclick="deleteBlog({{ $featuredBlog->id }})">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                        </td>
                                    </tr>
                                    @endif
                                    @foreach ($otherBlogs as $blog)
                                    <tr id="blog-{{ $blog->id }}">
                                        <td>{{ \Illuminate\Support\Str::limit($blog->title, 30, '...') }}</td>
                                        <td>{{ $blog->user ? $blog->user->name : 'Không có tác giả' }}</td> 
                                        <td>
                                            <img src="{{ asset('storage/' . ltrim($blog->image_path, 'http://127.0.0.1:8000/')) }}" 
                                            alt="Image" style="width: 90px; height: 70px; object-fit: cover;">
                                        </td>
                                        <td>{{ $blog->category ? $blog->category->name : 'Không có danh mục' }}</td>    
                                        <td>{{ $blog->likes_count }}</td>
                                        <td>
                                            <a href="{{ route('comment.index', ['blog' => $blog->id]) }}">
                                                {{ $blog->comments_count }}
                                            </a>
                                        </td>
                                        
                                        <td>{{ $blog->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @foreach ($blog->tags as $tag)
                                                <span class="badge bg-primary">{{ $tag->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-link btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-link btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-link btn-danger" onclick="deleteBlog({{ $blog->id }})">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                               
                                            </div>
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
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')

<script>
function deleteBlog(id) {
    if (confirm('Bạn có chắc chắn muốn xóa bài viết này?')) {
        $.ajax({
            url: '{{ route("blog.destroy", ":id") }}'.replace(':id', id),
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.success);
                $('#blog-' + id).remove();
            },
            error: function() {
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    }
}

function toggleApproval(id) {
    $.ajax({
        url: '{{ route("blog.toggleApproval", ":id") }}'.replace(':id', id),
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
                location.reload(); // Tải lại trang để cập nhật trạng thái mới
            } else {
                alert(response.error || 'Có lỗi xảy ra');
            }
        },
        error: function() {
            alert('Có lỗi xảy ra, vui lòng thử lại.');
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#content-editor'))
            .catch(error => {
                console.error(error);
            });
    });
    function showCommentForm(blogId) {
    var form = document.getElementById('comment-form-' + blogId);
    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
}

</script>
