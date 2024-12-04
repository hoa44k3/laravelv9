@extends('site.master')
@section('body')
<style>
    p {
    display: block;
    margin-bottom: 1rem;
}

</style>
    <!-- ****** Breadcumb Area Start ****** -->
    <div class="breadcumb-area" style="background-image: url(/customer/img/ne2.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>Chi tiết bài viết</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcumb-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index')}}"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="{{route('blog')}}">Bài viết</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết bài viết</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Breadcumb Area End ****** -->

    <!-- ****** Single Blog Area Start ****** -->
    <section class="single_blog_area section_padding_80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row">
                        <!-- Bài viết chính -->
                        @if($featuredBlog)
                        <div class="col-lg-8 mb-4">
                            <div class="single-post featured-post">
                                <!-- Post Thumb -->
                                <div class="post-thumb">
                                    <img src="{{ asset('storage/' . ltrim($featuredBlog->image_path, 'http://127.0.0.1:8000/')) }}" 
                                         alt="Image" 
                                         style="width: 100%; height: auto; object-fit: cover;">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content mt-3">
                                    <h2>{{ $featuredBlog->title }}</h2>
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <div class="post-author">
                                                <a href="#">{{ $featuredBlog->user->name ?? 'Không có tác giả' }}</a>
                                            </div>
                                            <div class="post-date">
                                                <a href="#">{{ $featuredBlog->created_at->format('d/m/Y H:i') }}</a>
                                            </div>
                                        </div>
                                    </div>
                           
                                     {!! \Illuminate\Support\Str::limit(strip_tags($featuredBlog->content, '<p><br><strong><em>'), 5000) !!}

                                </div>
                            </div>
    
                            <!-- Hiển thị số lượng bình luận -->
                            <div class="comments-count mt-4">
                                <h4>{{ $featuredBlog->comments_count }} Bình luận</h4>
                            </div>
    
                            <!-- Các bình luận -->
                            <div class="leave-comment-area section_padding_50 clearfix">
                                <div class="comment-form">
                                    <hr>
                                    <!-- Hiển thị bình luận -->
                                    <ol>
                                        @foreach ($featuredBlog->comments as $comment)
                                        <li class="single_comment_area">
                                            <div class="comment-wrapper d-flex">
                                                <!-- Comment Meta -->
                                                <div class="comment-author">
                                                    <img src="{{ asset('storage/' . ltrim($comment->user->image ?? 'default-avatar.jpg', 'http://127.0.0.1:8000/')) }}" 
                                                    alt="Image" 
                                                    style="width: 100%; height: auto; object-fit: cover;">
                                                </div>
                                                <!-- Comment Content -->
                                                <div class="comment-content">
                                                    <span class="comment-date text-muted">
                                                        <a href="#">{{ $comment->created_at ? $comment->created_at->format('d/m/Y H:i') : 'N/A' }}</a>
                                                    </span>
                                                    
                                                    <h5>{{ $comment->user->name ?? 'Không có tên' }}</h5>
                                                    <p>{{ $comment->content }}</p>
                                    
                                                    <!-- Nút trả lời -->
                                                    @if (auth()->check())
                                                    <button 
                                                        class="btn btn-link btn-sm text-primary reply-toggle" 
                                                        data-reply-id="{{ $comment->id }}" 
                                                        style="text-decoration: underline;">Trả lời
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                    
                                            <!-- Form trả lời bình luận, ẩn mặc định -->
                                            @if (auth()->check())
                                            <form id="reply-form-{{ $comment->id }}" method="POST" action="{{ route('comment.reply', $comment->id) }}" style="display: none; margin-left: 60px;">
                                                @csrf
                                                <div class="form-group mt-3">
                                                    <textarea class="form-control" name="content" rows="3" placeholder="Trả lời bình luận..."></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-sm mt-2" style="margin-left: 60px;">Gửi</button>
                                            </form>
                                            @endif
                            
                                            <!-- Các câu trả lời -->
                                            @foreach ($comment->replies as $reply)
                                            <div class="comment-wrapper d-flex ml-4">
                                                <div class="comment-author">
                                                    <img src="{{ asset('storage/' . ltrim($reply->user->image ?? 'default-avatar.jpg', 'http://127.0.0.1:8000/')) }}" 
                                                    alt="Image" 
                                                    style="width: 100%; height: auto; object-fit: cover;">
                                                </div>
                                                <div class="comment-content">
                                                    <span class="comment-date text-muted">{{ $reply->created_at->format('d/m/Y H:i') }}</span>
                                                    <h5>{{ $reply->user->name ?? 'Không có tên' }}</h5>
                                                    <p>{{ $reply->content }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </li>
                                        @endforeach
                                    </ol>
                            
                                    <!-- Biểu mẫu bình luận -->
                                    @if (auth()->check())
                                    <form method="POST" action="{{ route('comment.store') }}">
                                        @csrf
                                        <div class="form-group mt-3">
                                            <textarea class="form-control" name="content" rows="3" placeholder="Viết bình luận..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-2">Gửi bình luận</button>
                                    </form>
                                    @else
                                    <p class="text-muted mt-3">
                                        Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận.
                                    </p>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                        @endif
    
                        <!-- Các bài viết khác -->
                        <div class="col-lg-4">
                            <h4 class="mb-4">Các bài viết khác</h4>
                            @foreach ($otherBlogs as $blog)
                                <div class="single-post mb-3">
                                    <!-- Post Thumb -->
                                    <div class="post-thumb">
                                        <img src="{{ asset('storage/' . ltrim($blog->image_path, 'http://127.0.0.1:8000/')) }}" 
                                             alt="Image" 
                                             style="width: 100%; height: auto; object-fit: cover;">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content mt-2">
                                        <h5><a href="{{ route('site.post', $blog->id) }}">{{ $blog->title }}</a></h5>
                                        <div class="post-meta d-flex">
                                            <div class="post-author-date-area d-flex">
                                                <div class="post-author">
                                                    <a href="#">{{ $blog->user->name ?? 'Không có tác giả' }}</a>
                                                </div>
                                                <div class="post-date">
                                                    <a href="#">{{ $blog->created_at->format('d/m/Y H:i') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                            {!! \Illuminate\Support\Str::limit(strip_tags($blog->content, '<p><br><strong><em>'), 50) !!}
                                    </div>
                                </div>                         
                            @endforeach   
                            <div class="pagination mt-4 d-flex justify-content-center">
                                {{ $otherBlogs->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
 document.addEventListener('DOMContentLoaded', () => {

    // Bình luận và trả lời bình luận
    const replyButtons = document.querySelectorAll(".reply-toggle");

    replyButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const replyId = this.getAttribute("data-reply-id");
            const replyForm = document.getElementById(`reply-form-${replyId}`);

            if (replyForm) {
                // Toggle hiện/ẩn form trả lời
                if (replyForm.style.display === "none" || replyForm.style.display === "") {
                    replyForm.style.display = "block";
                } else {
                    replyForm.style.display = "none";
                }
            } else {
                console.error(`Reply form with ID reply-form-${replyId} not found.`);
            }
        });
    });
    //comment
    const commentForm = document.getElementById('comment-form');
    const blogId = commentForm.dataset.id;

    commentForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch(`/comment/${blogId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                const comment = data.comment;

                // Tạo phần tử bình luận mới
                const commentList = document.querySelector('ol');
                const newComment = document.createElement('li');
                newComment.innerHTML = `
                    <div class="comment-wrapper d-flex">
                        <div class="comment-author">
                            <img src="/path/to/default-avatar.jpg" alt="Image" style="width: 100%; height: auto; object-fit: cover;">
                        </div>
                        <div class="comment-content">
                            <span class="comment-date text-muted">${comment.created_at}</span>
                            <h5>${comment.user_name}</h5>
                            <p>${comment.content}</p>
                        </div>
                    </div>
                `;
                commentList.appendChild(newComment);

                // Xóa nội dung form
                commentForm.reset();
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>