@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Like</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('likes.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="blog_id">Blog</label>
                            <select name="blog_id" id="blog_id" class="form-control" required>
                                @foreach ($blogs as $blog)
                                    <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_id">User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm Lượt Thích</button>
                    </form>
                </div>
            </div>
        </div>
    </div>        
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')
