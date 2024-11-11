<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">     
                     <h1 class="text-center mb-4 text-primary">Thống Kê</h1>
                </div>
                    <div class="row text-center mb-4">
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card shadow-sm p-3">
                                <h4>Tổng số bài viết</h4>
                                <p class="display-4 text-primary">{{ $totalBlogs }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card shadow-sm p-3">
                                <h4>Tổng số bình luận</h4>
                                <p class="display-4 text-primary">{{ $totalComments }}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card shadow-sm p-3">
                                <h4>Tổng người dùng đăng ký</h4>
                                <p class="display-4 text-primary">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>

                    <h3 class="text-center mb-4">Tổng số lượt thích của từng bài viết:</h3>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tựa đề</th>
                                        <th>Lượt thích</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @if (is_array($likesCount) || is_object($likesCount)) --}}
                                        @foreach ($likesCount as $blog)
                                            <tr>
                                                <td>{{ $blog->id }}</td>
                                                <td>{{ $blog->title }}</td>
                                                <td>{{ $blog->likes_count }}</td>
                                            </tr>
                                        @endforeach
                                    {{-- @else
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Không có dữ liệu</td>
                                        </tr>
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>        
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
