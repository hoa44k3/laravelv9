@extends('site.master')

@section('title','Trang chủ')
@section('body')
<!-- Thêm CSS của Slick Carousel -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Thêm JS của Slick Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <style>
      .category-carousel {
    width: 100%;
    overflow: hidden;
}

.category-image-container {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.category-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px; 
}

.category-title-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(238, 127, 127, 0.5); 
    color: white;
    text-align: center;
    padding: 10px;
    font-size: 16px;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
}

.category-image-container:hover .category-title-overlay {
    opacity: 1;
}

.swiper-button-next, .swiper-button-prev {
    color: black;
    background-color: white;
    padding: 10px;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    z-index: 10;
}

.swiper-button-next {
    right: 0;
}

.swiper-button-prev {
    left: 0;
}

.container .row {
    margin-bottom: 0;
    padding-bottom: 0;
}
.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
}

.categories_area {
    margin-bottom: 30px; 
}

.blog_area {
    padding-top: 0;
}

.blog_area .row {
    row-gap: 20px; 
}

.category-image-container img {
    margin-bottom: 15px;
}

.post-thumb img {
    width: 100%;
    height: auto;
    border-radius: 5px;
}

/*comment*/
.single_comment_area {
    margin-bottom: 20px;
}

.comment-wrapper {
    margin-bottom: 15px;
}

.comment-author img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.comment-content {
    margin-left: 15px;
    flex-grow: 1;
}

.reply-toggle {
    cursor: pointer;
    color: #007bff;
}

.reply-toggle:hover {
    text-decoration: underline;
}

    </style>

<!-- ****** Categories Area Start ****** -->
<section class="categories_area clearfix" id="about">
    <div class="container">
        <div class="row">
            <!-- Swiper container -->
            <div class="swiper-container category-carousel">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide">
                            <div class="single_catagory">
                                <a href="{{ route('site.post', ['id' => $category->id]) }}">
                                    <div class="category-image-container">
                                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}">
                                        <div class="category-title-overlay">
                                            <h5>{{ $category->name }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ****** Categories Area End ****** -->

<!-- ****** Blog Area Start ****** -->
<section class="blog_area section_padding_80">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Phần bài viết nổi bật nằm bên trái -->
            <div class="col-12 col-lg-8 mb-4">
                <div class="row">
                    @if($featuredBlog)
                        <div class="col-12">
                            <div class="single-post wow fadeInUp" data-wow-delay=".2s">
                                <!-- Post Thumb -->
                                <div class="post-thumb">
                                    <img src="{{ asset('storage/' . ltrim($featuredBlog->image_path, 'http://127.0.0.1:8000/')) }}" 
                                         alt="Image" 
                                         class="img-fluid rounded mb-3" 
                                         style="object-fit: cover; height: 400px;">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex justify-content-between mb-3">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author mr-4">
                                                <a href="#" class="text-muted">{{ $featuredBlog->user->name ?? 'Không có tác giả' }}</a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date">
                                                <a href="#" class="text-muted">{{ $featuredBlog->created_at->format('d/m/Y H:i') }}</a>
                                            </div>
                                        </div>
                                        <!-- Post Comment & Share Area -->
                                        <div class="post-comment-share-area d-flex">
                                            <div class="post-favourite">
                                                <a href="#" id="toggle-like">
                                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                                    <span class="likes-count">{{ $featuredBlog->likes_count }}</span>
                                                </a>
                                            </div>
                                            
                                            <div class="post-comments">
                                                <a href="#comments-section" class="text-muted">
                                                    <i class="fa fa-comment-o" aria-hidden="true"></i>  
                                                    {{ $featuredBlog->comments_count }}
                                                </a>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <a href="#">
                                        <h2 class="post-headline mb-3">{{ $featuredBlog->title }}</h2>
                                    </a>
                                    {!! \Illuminate\Support\Str::limit(strip_tags($featuredBlog->content, '<p><br><strong><em>'), 5000) !!}
                                        <div class="post-tags mt-3">
                                            @foreach ($featuredBlog->tags as $tag)
                                                <span class="badge bg-primary">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                {{-- Tất cả bài viết --}}
                    <div class="row">
                        <!-- Single Post -->
                        @foreach ($blogs->take(5) as $blog)
                            <div class="col-md-6 mb-4">
                                <div class="single-post wow fadeInUp" data-wow-delay="0.1s">
                                    <!-- Post Thumb -->
                                    <div class="post-thumb">
                                        <img src="{{ asset('storage/' . ltrim($blog->image_path, 'http://127.0.0.1:8000/')) }}" 
                                            alt="Image" 
                                            class="img-fluid rounded" 
                                            style="object-fit: cover; height: 200px;">
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <div class="post-meta d-flex justify-content-between align-items-center">
                                            <div class="post-author">
                                                <a href="#" class="author-name">{{ $blog->user->name ?? 'Không có tên tác giả' }}</a>
                                            </div>
                                            <div class="post-date">
                                                <span>{{ $blog->created_at->format('d/m/Y') }}</span>
                                            </div>
                                        </div>
                                        <!-- Post Title -->
                                        <a href="{{ route('site.post', $blog->id) }}" class="post-title">
                                            <h4 class="post-headline mt-3">{{ $blog->title }}</h4>           
                                         
                                            {!! \Illuminate\Support\Str::limit(strip_tags($blog->content, '<p><br><strong><em>'), 100) !!}

                                        </a>
                                        <!-- Post Stats -->
                                        <div class="post-stats mt-3 d-flex justify-content-between align-items-center">
                                             <div class="post-favourite">
                                                <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> {{ $blog->likes_count }}</a>
                                            </div>
                                            <div class="post-comments">
                                                <a href="#" class="text-muted"><i class="fa fa-comment-o" aria-hidden="true"></i> {{ $blog->comments_count }}</a>
                                            </div>
                                        </div>
                                        <div class="post-tags mt-2">
                                            @foreach ($blog->tags as $tag)
                                                <span class="badge bg-primary">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                 <!-- Leave A Comment -->
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
                            <!-- Đảm bảo blog_id được gửi -->
                            <input type="hidden" name="blog_id" value="{{ $featuredBlog->id }}">
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
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="blog-sidebar mt-5 mt-lg-0">
                    <!-- Single Widget Area -->
                    <div class="single-widget-area about-me-widget text-center">
                        <div class="widget-title">
                            <h6>About Me</h6>
                        </div>
                        <div class="about-me-widget-thumb">
                            <img src="/customer/img/chandung.jpg" alt="">
                        </div>
                        <h4 class="font-shadow-into-light">Lê Hòa</h4>
                        <p>Hãy làm mọi thứ mà bạn thích, cố gắng trong mọi hoàn cảnh dù khắc nghiệt!</p>
                    </div>

                    <!-- Single Widget Area -->
                    <div class="single-widget-area subscribe_widget text-center">
                        <div class="widget-title">
                            <h6>Theo dõi &amp; Follow</h6>
                        </div>
                        <div class="subscribe-link">
                            <a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="https://www.youtube.com/@xinhpham276"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <!-- Single Widget Area -->
                    <div class="single-widget-area popular-post-widget">
                        <div class="widget-title text-center">
                            <h6>Chi tiết bài viết</h6>
                        </div>
                        @foreach ($blogs as $blog)

                        <!-- Single Popular Post -->
                        <div class="single-populer-post d-flex">
                            <img src="{{ asset('storage/' . ltrim($blog->image_path, 'http://127.0.0.1:8000/')) }}" 
                                alt="Image" 
                                class="img-fluid rounded" 
                                style="object-fit: cover; height: 200px;">
                            <div class="post-content">
                                <a href="{{ route('site.post', $blog->id) }}">
                                    <h6>{{ $blog->title }}</h6>
                                </a>
                                <p>{{ $blog->created_at->format('d/m/Y H:i') }}</p>
                                <a href="{{ route('site.post', $blog->id) }}" class="post-title">
                                    {{-- <h4 class="post-headline mt-3">{{ $blog->title }}</h4> --}}
                                    {{-- {!! \Illuminate\Support\Str::limit(strip_tags($blog->content, '<p><br>'), 50) !!} --}}
                                        {!! \Illuminate\Support\Str::limit(strip_tags($blog->content, '<p><br><strong><em>'), 100) !!}

                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('toggle-like').addEventListener('click', function (e) {
            e.preventDefault(); 
            let icon = this.querySelector('i');
            let likesCountSpan = this.querySelector('.likes-count');
            
            // Đổi class của thẻ <i> (fa-heart-o -> fa-heart và ngược lại)
            if (icon.classList.contains('fa-heart-o')) {
                icon.classList.remove('fa-heart-o');
                icon.classList.add('fa-heart');
            } else {
                icon.classList.remove('fa-heart');
                icon.classList.add('fa-heart-o');
            }
            
            // Cập nhật số lượt thích (giả định tăng hoặc giảm 1)
            let currentLikes = parseInt(likesCountSpan.textContent);
            if (icon.classList.contains('fa-heart')) {
                likesCountSpan.textContent = currentLikes + 1;
            } else {
                likesCountSpan.textContent = currentLikes - 1;
            }
        });
    });     

document.addEventListener('DOMContentLoaded', () => {
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 3, 
        spaceBetween: 30, 
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 3, 
            },
            480: {
                slidesPerView: 1, 
            }
        }
    });
    ClassicEditor
        .create(document.querySelector('#content-editor'))
        .catch(error => {
            console.error(error);
        });

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
                commentForm.reset();
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

</script>
