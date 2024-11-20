@extends('site.master')
@section('title','Bài viết')
@section('body')
<style>
    /* Tạo hiệu ứng hover cho bài viết */
.single-post {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    object-fit: cover;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

/* Hiệu ứng hover */
.single-post:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
}

/* Tùy chỉnh ảnh */
.post-thumb img {
    width: 100%;
    height: 200px; /* Fix chiều cao ảnh */
    object-fit: cover;
    border-radius: 8px;
}

/* Meta info */
.post-meta {
    font-size: 14px;
    color: #999;
}

/* Tùy chỉnh tiêu đề bài viết */
.post-headline {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.post-headline:hover {
    color: #007bff;
}

/* Tùy chỉnh thống kê (số lượt thích và bình luận) */
.post-stats {
    font-size: 14px;
    color: #999;
}

.post-stats .text-muted {
    color: #6c757d;
}

/* Chỉnh sửa tên tác giả */
.author-name {
    font-weight: 600;
    color: #007bff;
}

.author-name:hover {
    color: #0056b3;
}

</style>
 <!-- ****** Breadcumb Area Start ****** -->
 <div class="breadcumb-area" style="background-image: url(/customer/img/ne2.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="bradcumb-title text-center">
                    <h2>Bài viết</h2>
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
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bài viết</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ****** Breadcumb Area End ****** -->

<!-- ****** Archive Area Start ****** -->
<section class="archive-area section_padding_80">
    <div class="container">
        <div class="row">
            <!-- Single Post -->
            @foreach ($blogs as $blog)
                <div class="col-12 col-md-6 col-lg-4">
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
                            </a>
                            <!-- Post Stats -->
                            <div class="post-stats mt-3 d-flex justify-content-between align-items-center">
                                <div class="post-favourite">
                                    <a href="#" class="text-muted"><i class="fa fa-heart-o" aria-hidden="true"></i> {{ $blog->likes_count }}</a>
                                </div>
                                <div class="post-comments">
                                    <a href="#" class="text-muted"><i class="fa fa-comment-o" aria-hidden="true"></i> {{ $blog->comments_count }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ****** Archive Area End ****** -->
@endsection