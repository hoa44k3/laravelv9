@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Sửa bình luận</h4>
                </div>
                <div class="card-body">
    
                    <form action="{{ route('comment.update', ['blog' => $blog->id, 'comment' => $comment->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="user_id">Tác giả</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">Chọn tác giả</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $comment->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="content">Nội dung</label>
                            <textarea name="content" class="form-control" rows="4" required>{{ $comment->content }}</textarea>
                        </div>

                        {{-- <div class="form-group mb-3">
                            <label for="category">Danh mục</label>
                            @if($comment->blog && $comment->blog->category)
                                <p class="form-control">{{ $comment->blog->category->name }}</p>
                            @else
                                <p class="form-control">Không có danh mục</p>
                            @endif
                        </div> --}}
                        
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('comment.index', ['blog' => $blog->id]) }}" class="btn btn-secondary">Quay Lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 