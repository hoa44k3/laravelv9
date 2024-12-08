@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Quản lý bài viết</h4>
                        <a href="{{ route('ctv.posts.create') }}" class="btn btn-primary btn-round ms-auto">
                            <i class="fa fa-plus"></i> Thêm bài viết
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Tiêu đề</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>
                                            @if ($post->status === 'pending')
                                                <span class="badge bg-warning">Chờ duyệt</span>
                                            @elseif ($post->status === 'approved')
                                                <span class="badge bg-success">Đã duyệt</span>
                                            @else
                                                <span class="badge bg-danger">Bị từ chối</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('ctv.posts.edit', $post->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> Sửa
                                            </a>
                                            <form action="{{ route('ctv.posts.destroy', $post->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn xóa bài viết này?');">
                                                    <i class="fa fa-trash"></i> Xóa
                                                </button>
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
