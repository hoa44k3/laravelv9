<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container mt-5">
    <h1 class="text-center mb-4">Thống Kê</h1>

    <h2 class="text-center">Tổng số bài viết: <span class="text-primary">{{ $totalBlogs }}</span></h2>

    <h2 class="text-center">Tổng số bình luận: <span class="text-primary">{{ $totalComments }}</span></h2>

    <h3 class="text-center">Tổng số lượt thích của từng bài viết:</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Tựa đề</th>
                    <th>Lượt thích</th>
                </tr>
            </thead>
            <tbody>
                @if (is_array($likesCount) || is_object($likesCount))
                    @foreach ($likesCount as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->likes_count }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">Không có dữ liệu</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
