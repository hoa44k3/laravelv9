@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">     
                    <h1 class="text-center mb-4 text-primary">Bài viết: {{ $blog->title }}</h1>
               </div>
               <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Thông tin bài viết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tổng lượt thích:</td>
                                    <td>{{ $totalLikes }}</td>
                                </tr>
                                <tr>
                                    <td>Tổng bình luận:</td>
                                    <td>{{ $totalComments }}</td>
                                </tr>
                                <tr>
                                    <td>Nội dung:</td>
                                    {{-- <td>{{ $blog->content }}</td> --}}
                                    <td>
                                        <textarea name="content" id="content-editor" rows="4" class="form-control" required>{{ $blog->content }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tác giả:</td>
                                    <td>{{ $blog->user ? $blog->user->name : 'Không có tác giả' }}</td>
                                </tr>
                                <tr>
                                    <td>Danh mục:</td>
                                    <td>{{ $blog->category ? $blog->category->name : 'Không có danh mục' }}</td>
                                </tr>
                                <tr>
                                    <td>Trạng thái:</td>
                                    <td>{{ $blog->status == 'approved' ? 'Đã phê duyệt' : 'Chờ phê duyệt' }}</td>
                                </tr>
                                <tr>
                                    <td>Ngày tạo:</td>
                                    <td>{{ $blog->created_at ? $blog->created_at->format('d/m/Y H:i') : 'Không có ngày' }}</td>
                                </tr>
                                <tr>
                                    <td>Ảnh:</td>
                                    <td>
                                        @if ($blog->image_path)
                                        <img src="{{ asset('storage/' . ltrim($blog->image_path, 'http://127.0.0.1:8000/')) }}" alt="Image"style="width: 90px; height: 70px;">
                                        @else
                                            Không có ảnh
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                     </div>
               </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        ClassicEditor
            .create(document.querySelector('#content-editor'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
