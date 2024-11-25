@extends('site.master')

   
@section('body')
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
                                    <p>{{ \Illuminate\Support\Str::limit($featuredBlog->content, 5000) }}</p>
                                    {{-- <a href="{{ route('blogs.show', $featuredBlog->id) }}" class="btn btn-primary">Xem chi tiết</a> --}}
                                </div>
                            </div>
    
                            <!-- Hiển thị số lượng bình luận -->
                            <div class="comments-count mt-4">
                                <h4>{{ $featuredBlog->comments_count }} Bình luận</h4>
                            </div>
    
                            <!-- Các bình luận -->
                            <div class="comment_area section_padding_50 clearfix">
                                <h4 class="mb-30">Bình luận</h4>
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
                                                <span class="comment-date text-muted"><a href="#">{{ $comment->created_at ? $comment->created_at->format('d/m/Y H:i') : 'N/A' }}</a>
                                                </span>
                                                
                                                <h5>{{ $comment->user->name ?? 'Không có tên' }}</h5>
                                                <p>{{ $comment->content }}</p>
                                                <a href="#reply-form-{{ $comment->id }}" class="reply-btn">Trả lời</a>
                                            </div>
                                        </div>
    
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
    
                                        <!-- Form trả lời bình luận -->
                                        <form id="reply-form-{{ $comment->id }}" method="POST" action="{{ route('comment.reply', $comment->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <textarea class="form-control" name="content" rows="3" placeholder="Trả lời bình luận..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Gửi</button>
                                        </form>
                                    </li>
                                    @endforeach
                                </ol>
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
                                        <p>{{ \Illuminate\Support\Str::limit($blog->content, 50) }}</p>
                                       
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
