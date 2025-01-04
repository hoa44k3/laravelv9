@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chi tiết công việc</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Tiêu đề:</label>
                        <p>{{ $job->title }}</p>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <p>{{ $job->description }}</p>
                    </div>
                    <div class="form-group">
                        <label for="job_date">Ngày tuyển dụng:</label>
                        <p>{{ $job->job_date->format('d/m/Y') }}</p>
                    </div>
                    @if($job->image)
                        <div class="form-group">
                            <label for="image">Hình ảnh:</label>
                            <img src="{{ asset('storage/' . $job->image) }}" alt="Job Image" class="img-fluid" style="max-width: 200px;">
                        </div>
                    @endif
                    <div class="form-group">
                        <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
