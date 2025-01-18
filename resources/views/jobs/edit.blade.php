@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sửa công việc</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="user_id">Người tạo</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $job->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Tiêu đề -->
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $job->title }}" required>
                        </div>
                        
                        <!-- Mô tả -->
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description" class="form-control" required>{{ $job->description }}</textarea>
                        </div>
                        
                        <!-- Ngày tuyển dụng -->
                        <div class="form-group">
                            <label for="job_date">Ngày tuyển dụng</label>
                            <input type="date" name="job_date" id="job_date" class="form-control" value="{{ $job->job_date->format('Y-m-d') }}" required>
                        </div>
                        
                        <!-- Hình ảnh -->
                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        
                        <!-- Hiển thị hình ảnh hiện tại nếu có -->
                        @if($job->image)
                            <div class="form-group">
                                <label>Hình ảnh hiện tại</label><br>
                                <img src="{{ asset('storage/'.$job->image) }}" alt="image" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                        @endif

                        <!-- Nút cập nhật -->
                        <button type="submit" class="btn btn-warning">Cập nhật công việc</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
