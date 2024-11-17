@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

<h3>Bình luận chính</h3>
<div class="comment">
    <p>{{ $comment->content }}</p>
    <p><strong>Người bình luận:</strong> {{ $comment->author }}</p>
</div>

<h3>Bình luận con</h3>
@if($comment->replies->count() > 0)
    <ul>
        @foreach ($comment->replies as $reply)
        <div class="comment-wrapper d-flex">
            <div class="comment-author">
                <img src="{{ asset('storage/' . ltrim($reply->user->image ?? 'default-avatar.jpg', 'http://127.0.0.1:8000/')) }}" alt="Image" style="width: 50px; height: 50px; object-fit: cover;">
            </div>
            <div class="comment-content">
                <span class="comment-date text-muted">{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                <h5>{{ $reply->user->name ?? 'Không có tên' }}</h5>
                <p>{{ $reply->content }}</p>
            </div>
        </div>
    @endforeach
    
    </ul>
@else
    <p>Chưa có bình luận con.</p>
@endif

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')