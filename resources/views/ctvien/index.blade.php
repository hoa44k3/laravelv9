@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Quản lý bài viết - Cộng tác viên</h4>
                        <a href="{{ route('ctvien.create') }}" class="btn btn-primary btn-round ms-auto">Thêm bài viết</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Danh mục</th>
                                    <th>Trạng thái</th>
                                
                                    <th>CTV</th>
                                    <th>Ảnh đại diện</th>
                                    <th>Công việc</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ Str::limit($blog->content, 100) }}</td>
                                        <td>{{ $blog->category->name }}</td>
                                        <td>
                                            @if ($blog->status === 'pending')
                                                <span class="badge bg-warning">Chờ duyệt</span>
                                            @elseif ($blog->status === 'approved')
                                                <span class="badge bg-success">Đã duyệt</span>
                                            @else
                                                <span class="badge bg-danger">Bị từ chối</span>
                                            @endif
                                        </td>
                                    
                                        <td>{{ $blog->user->name }}</td>
                                    
                                        <td>
                                            <img src="{{ $blog->user->image ? asset('storage/' . $blog->user->image) : asset('assets/img/default-avatar.jpg') }}" 
                                                 alt="Avatar" 
                                                 style="width: 50px; height: 50px; border-radius: 50%;">
                                        </td>
                                        <td>Quản lý bài viết</td>
                                        <td>
                                            @if ($blog->status === 'approved')
                                                <form action="{{ route('ctvien.reject', $blog->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-danger btn-sm">Bỏ duyệt</button>
                                                </form>
                                            @else
                                                <form action="{{ route('ctvien.approve', $blog->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-success btn-sm">Duyệt</button>
                                                </form>
                                                
                                                <form action="{{ route('ctvien.reject', $blog->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-danger btn-sm">Không duyệt</button>
                                                </form>
                                            @endif
                                            <a href="{{ route('ctvien.edit', $blog->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                            <form action="{{ route('ctvien.destroy', $blog->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-secondary btn-sm">Xóa</button>
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
