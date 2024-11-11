@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sửa lượt thích</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('likes.update', $like->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="blog_id">Blog</label>
                            <select name="blog_id" id="blog_id" class="form-control" required>
                                @foreach ($blogs as $blog)
                                    <option value="{{ $blog->id }}" {{ $like->blog_id == $blog->id ? 'selected' : '' }}>{{ $blog->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $like->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập Nhật Lượt Thích</button>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
