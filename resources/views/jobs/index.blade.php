@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Danh sách tuyển dụng</h4>
                    <a href="{{ route('jobs.create') }}" class="btn btn-primary btn-round ms-auto">Tạo tuyển dụng mới</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Người tuyển dụng</th>
                                <th>Tiêu đề</th>
                                <th>Mô tả</th>
                                <th>Ngày</th>
                                <th>Hình ảnh</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                            <tr>
                                <td>
                                    {{ $job->user ? $job->user->name : 'Không xác định' }}
                                </td>
                                <td>
                                    <a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a>
                                </td>
                                <td>{{ Str::limit($job->description, 100) }}</td>
                                <td>{{ \Carbon\Carbon::parse($job->job_date)->format('d/m/Y') }}</td>
                                <td>
                                    @if($job->image)
                                        <img src="{{ asset('storage/'.$job->image) }}" alt="image" width="100">
                                    @else
                                        <span>Không có ảnh</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning">Sửa</a>

                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Xóa</button>
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

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
