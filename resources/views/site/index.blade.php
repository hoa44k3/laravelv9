@extends('site.master')

@section('title','Trang chủ')
@section('body')
<!-- Thêm CSS của Slick Carousel -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

<!-- Thêm JS của Slick Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <style>
      .category-carousel {
    width: 100%;
    position: relative;
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
    border-radius: 10px; /* Tùy chọn: Bo góc ảnh */
}

.category-title-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(238, 127, 127, 0.5); /* Nền mờ */
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

/* Swiper điều hướng */
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

/* Tạo bố cục đẹp mắt */
/* Ghi đè margin-bottom mặc định của Bootstrap */
.container .row {
    margin-bottom: 0;
    padding-bottom: 0;
}

/* Giảm khoảng cách giữa các phần (section) */
.categories_area {
    margin-bottom: 30px; /* Tăng hoặc giảm khoảng cách giữa danh mục và blog */
}

.blog_area {
    padding-top: 0; /* Xóa khoảng trống phía trên blog */
}

/* Căn chỉnh các bài viết trong phần blog */
.blog_area .row {
    row-gap: 20px; /* Khoảng cách dọc giữa các bài viết */
}

/* Chỉnh ảnh danh mục */
.category-image-container img {
    margin-bottom: 15px; /* Tăng khoảng cách giữa ảnh và nội dung danh mục */
}

/* Đảm bảo ảnh bài viết không bị giãn */
.post-thumb img {
    width: 100%;
    height: auto;
    border-radius: 5px; /* Tùy chọn: Thêm bo góc nhẹ cho ảnh */
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
                                <div class="category-image-container">
                                    <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}">
                                    <div class="category-title-overlay">
                                        <h5>{{ $category->name }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Nút điều hướng -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
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
                                            <div class="post-favourite mr-3">
                                                <a href="#" class="text-muted"><i class="fa fa-heart-o" aria-hidden="true"></i> {{ $featuredBlog->likes_count }}</a>
                                            </div>
                                            <div class="post-comments">
                                                <a href="#" class="text-muted"><i class="fa fa-comment-o" aria-hidden="true"></i>  {{ $featuredBlog->comments_count }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <h2 class="post-headline mb-3">{{ $featuredBlog->title }}</h2>
                                    </a>
                                    {{-- <p class="text-muted">{{ \Illuminate\Support\Str::limit($featuredBlog->content, 1000) }}</p> --}}
                                    <p class="text-muted">{!! \Illuminate\Support\Str::limit($featuredBlog->content, 1000) !!}</p>

                                </div>
                            </div>
                        </div>
                    @endif
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
                                        <button 
                                            class="btn btn-link btn-sm text-primary reply-toggle" 
                                            data-reply-id="{{ $comment->id }}" 
                                            style="text-decoration: underline;">Trả lời
                                        </button>
                                    </div>
                                </div>
                        
                                <!-- Form trả lời bình luận, ẩn mặc định -->
                                <form id="reply-form-{{ $comment->id }}" method="POST" action="{{ route('comment.reply', $comment->id) }}" style="display: none; margin-left: 60px;">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <textarea class="form-control" name="content" rows="3" placeholder="Trả lời bình luận..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2"style="margin-left: 60px;">Gửi</button>
                                </form>
                        
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
                        
                
                    </div>
                </div>
                
            </div>
            <!-- Phần các bài viết còn lại nằm bên phải -->
            <div class="col-12 col-lg-4">
                @foreach ($blogs as $blog)
                    <div class="single-post wow fadeInUp" data-wow-delay=".4s">
                        <!-- Post Thumb -->
                        <div class="post-thumb mb-3">
                            <img src="{{ asset('storage/' . ltrim($blog->image_path, 'http://127.0.0.1:8000/')) }}" 
                                alt="Image" 
                                class="img-fluid rounded" 
                                style="object-fit: cover; height: 200px;">
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <div class="post-meta d-flex justify-content-between mb-3">
                                <div class="post-author-date-area d-flex">
                                    <!-- Post Author -->
                                    <div class="post-author mr-4">
                                        <a href="#" class="text-muted">{{ $blog->user->name ?? 'Không có tên tác giả' }}</a>
                                    </div>
                                    <!-- Post Date -->
                                    <div class="post-date">
                                        <a href="#" class="text-muted">{{ $blog->created_at->format('d/m/Y H:i') }}</a>
                                    </div>
                                </div>
                                <!-- Post Comment & Share Area -->
                                <div class="post-comment-share-area d-flex">
                                    <div class="post-favourite mr-3">
                                        <a href="#" class="text-muted"><i class="fa fa-heart-o" aria-hidden="true"></i> {{ $blog->likes_count }}</a>
                                    </div>
                                    <div class="post-comments">
                                        <i class="fa fa-comment-o" aria-hidden="true"></i> {{ $blog->comments_count }}
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('site.post', $blog->id) }}">
                                <h4 class="post-headline">{{ $blog->title }}</h4>
                                <p>{{ \Illuminate\Support\Str::limit($blog->content, 100) }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
                <!-- Hiển thị phân trang -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $blogs->links('pagination::bootstrap-4') }}
                </div>         
            </div> 
        </div>
    </div>
</section>
@endsection
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Khởi tạo Swiper
    const swiper = new Swiper('.swiper-container', {
        loop: true, // Cho phép lặp lại
        navigation: {
            nextEl: '.swiper-button-next', // Nút Next
            prevEl: '.swiper-button-prev', // Nút Previous
        },
        slidesPerView: 3, // Hiển thị 3 danh mục mỗi lần
        spaceBetween: 20, // Khoảng cách giữa các danh mục
        breakpoints: {
            768: {
                slidesPerView: 2, // Hiển thị 2 danh mục trên thiết bị nhỏ
            },
            1024: {
                slidesPerView: 3, // Hiển thị 3 danh mục trên thiết bị lớn
            },
        },
    });

    // Khởi tạo ClassicEditor cho textarea có id 'content-editor'
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
});

</script>

    <!-- Include CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
