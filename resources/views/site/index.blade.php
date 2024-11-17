@extends('site.master')

@section('title','Trang chủ')
@section('body')
<!-- Thêm CSS của Slick Carousel -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

<!-- Thêm JS của Slick Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <style>
      /* Thiết lập kích thước cho container carousel */
.category-carousel {
    display: flex;
    overflow: hidden;
}

.category-carousel .single_catagory {
    flex: 0 0 auto; /* Giúp các danh mục không bị co giãn */
    width: 33.33%; /* Hiển thị 3 danh mục mỗi lần */
    padding: 0 10px; /* Khoảng cách giữa các danh mục */
}

/* Thiết lập cho ảnh trong mỗi danh mục */
.category-image-container {
    position: relative;
    overflow: hidden;
    height: 200px; /* Đảm bảo tất cả ảnh có chiều cao cố định */
}

.category-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Đảm bảo ảnh không bị kéo dài, cắt ảnh nếu cần */
}

/* Hiển thị tiêu đề khi hover vào ảnh */
.category-title-overlay {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background-color: rgba(248, 90, 90, 0.5);
    color: white;
    padding: 10px;
    width: 100%;
    text-align: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.category-image-container:hover .category-title-overlay {
    opacity: 1;
}
/* CSS cho nút Prev và Next */
.slick-prev, .slick-next {
    font-size: 20px;
    color: black;
    background-color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
}

.slick-prev {
    left: 0;
}

.slick-next {
    right: 0;
}

    </style>
 <!-- ****** Welcome Post Area Start ****** -->
 <section class="welcome-post-sliders owl-carousel">

    <!-- Single Slide -->
    <div class="welcome-single-slide">
        <!-- Post Thumb -->
        <img src="/customer/img/bg-img/slide-1.jpg" alt="">
        <!-- Overlay Text -->
        <div class="project_title">
            <div class="post-date-commnents d-flex">
                <a href="#">May 19, 2017</a>
                <a href="#">5 Comment</a>
            </div>
            <a href="#">
                <h5>“I’ve Come and I’m Gone”: A Tribute to Istanbul’s Street</h5>
            </a>
        </div>
    </div>

    <!-- Single Slide -->
    <div class="welcome-single-slide">
        <!-- Post Thumb -->
        <img src="/customer/img/bg-img/slide-2.jpg" alt="">
        <!-- Overlay Text -->
        <div class="project_title">
            <div class="post-date-commnents d-flex">
                <a href="#">May 19, 2017</a>
                <a href="#">5 Comment</a>
            </div>
            <a href="#">
                <h5>“I’ve Come and I’m Gone”: A Tribute to Istanbul’s Street</h5>
            </a>
        </div>
    </div>

    <!-- Single Slide -->
    <div class="welcome-single-slide">
        <!-- Post Thumb -->
        <img src="/customer/img/bg-img/slide-3.jpg" alt="">
        <!-- Overlay Text -->
        <div class="project_title">
            <div class="post-date-commnents d-flex">
                <a href="#">May 19, 2017</a>
                <a href="#">5 Comment</a>
            </div>
            <a href="#">
                <h5>“I’ve Come and I’m Gone”: A Tribute to Istanbul’s Street</h5>
            </a>
        </div>
    </div>

    <!-- Single Slide -->
    <div class="welcome-single-slide">
        <!-- Post Thumb -->
        <img src="/customer/img/bg-img/slide-4.jpg" alt="">
        <!-- Overlay Text -->
        <div class="project_title">
            <div class="post-date-commnents d-flex">
                <a href="#">May 19, 2017</a>
                <a href="#">5 Comment</a>
            </div>
            <a href="#">
                <h5>“I’ve Come and I’m Gone”: A Tribute to Istanbul’s Street</h5>
            </a>
        </div>
    </div>

    <!-- Single Slide -->
    <div class="welcome-single-slide">
        <!-- Post Thumb -->
        <img src="/customer/img/bg-img/slide-4.jpg" alt="">
        <!-- Overlay Text -->
        <div class="project_title">
            <div class="post-date-commnents d-flex">
                <a href="#">May 19, 2017</a>
                <a href="#">5 Comment</a>
            </div>
            <a href="#">
                <h5>“I’ve Come and I’m Gone”: A Tribute to Istanbul’s Street</h5>
            </a>
        </div>
    </div>

</section>
<!-- ****** Welcome Area End ****** -->
<!-- ****** Categories Area Start ****** -->
<section class="categories_area clearfix" id="about">
    <div class="container">
        <div class="row">
            <!-- Thêm class category-carousel để tạo hiệu ứng trượt -->
            <div class="category-carousel">
                @foreach ($categories as $category)
                    <div class="single_catagory wow fadeInUp" data-wow-delay=".3s">
                        <div class="category-image-container" style="position: relative;">
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" style="width: 100%; height: auto;">
                            <div class="category-title-overlay">
                                <h5>{{ $category->name }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>





<!-- ****** Categories Area End ****** -->

<!-- ****** Blog Area Start ****** -->
<section class="blog_area section_padding_0_80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="row">

                    <!-- Single Post -->
                    <div class="col-12">
                        <div class="single-post wow fadeInUp" data-wow-delay=".2s">
                            <!-- Post Thumb -->
                            <div class="post-thumb">
                                <img src="/customer/img/blog-img/1.jpg" alt="">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <div class="post-meta d-flex">
                                    <div class="post-author-date-area d-flex">
                                        <!-- Post Author -->
                                        <div class="post-author">
                                            <a href="#">By Marian</a>
                                        </div>
                                        <!-- Post Date -->
                                        <div class="post-date">
                                            <a href="#">May 19, 2017</a>
                                        </div>
                                    </div>
                                    <!-- Post Comment & Share Area -->
                                    <div class="post-comment-share-area d-flex">
                                        <!-- Post Favourite -->
                                        <div class="post-favourite">
                                            <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> 10</a>
                                        </div>
                                        <!-- Post Comments -->
                                        <div class="post-comments">
                                            <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> 12</a>
                                        </div>
                                        <!-- Post Share -->
                                        <div class="post-share">
                                            <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <h2 class="post-headline">Boil The Kettle And Make A Cup Of Tea Folks, This Is Going To Be A Big One!</h2>
                                </a>
                                <p>Tiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat.</p>
                                <a href="#" class="read-more">Continue Reading..</a>
                            </div>
                        </div>
                    </div>
                    @foreach ($blogs as $blog)
                         <!-- Single Post -->
                    <div class="col-12 col-md-6">
                        <div class="single-post wow fadeInUp" data-wow-delay=".4s">
                            <!-- Post Thumb -->
                            <div class="post-thumb">
                                <img src="{{ asset('storage/' . ltrim($blog->image_path, 'http://127.0.0.1:8000/')) }}" alt="Image"style="width:300px; height: 200px;">
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <div class="post-meta d-flex">
                                    <div class="post-author-date-area d-flex">
                                        <!-- Post Author -->
                                        <div class="post-author">
                                            <a href="#">{{ $blog->user->name ?? 'Không có tên tác giả' }}</a>
                                        </div>
                                        <!-- Post Date -->
                                        <div class="post-date">
                                            <a href="#">{{ $blog->created_at->format('d/m/Y H:i') }}</a>
                                        </div>
                                    </div>
                                    <!-- Post Comment & Share Area -->
                                    <div class="post-comment-share-area d-flex">
                                        <!-- Post Favourite -->
                                        <div class="post-favourite">
                                            <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> {{ $blog->likes_count }}</a>
                                        </div>
                                        <!-- Post Comments -->
                                        {{-- <div class="post-comments">
                                            <i class="fa fa-comment-o" aria-hidden="true"></i>
                                            {{ $blog->comments_count > 0 ? $blog->comments_count . ' Bình luận' : 'Chưa có bình luận' }}
                                        </div> --}}
                                        
                                        <div class="post-comments">
                                            <i class="fa fa-comment-o" aria-hidden="true"></i>
                                            {{ $blog->comments_count }}
                                        </div>
                                        <!-- Post Share -->
                                        {{-- <div class="post-share">
                                            <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                        </div> --}}
                                    </div>
                                </div>
                                <a href="#">
                                    <h4 class="post-headline">{{ $blog->title }}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                   


                    <!-- ******* List Blog Area Start ******* -->
                    @foreach ($blogs as $blog)
                    <!-- Single Post -->
                        <div class="col-12">
                            <div class="list-blog single-post d-sm-flex wow fadeInUpBig" data-wow-delay=".2s">
                                <!-- Post Thumb -->
                                <div class="post-thumb">
                                    <img src="{{ asset('storage/' . ltrim($blog->image_path, 'http://127.0.0.1:8000/')) }}" alt="Image"style="width:300px; height: 200px;">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author">
                                                <a href="#">By Marian</a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date">
                                                <a href="#">May 19, 2017</a>
                                            </div>
                                        </div>
                                        <!-- Post Comment & Share Area -->
                                        <div class="post-comment-share-area d-flex">
                                            <!-- Post Favourite -->
                                            <div class="post-favourite">
                                                <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> 10</a>
                                            </div>
                                            <!-- Post Comments -->
                                            <div class="post-comments">
                                                <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> 12</a>
                                            </div>
                                            <!-- Post Share -->
                                            <div class="post-share">
                                                <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <h4 class="post-headline">The 10 Best Bars By The Seaside In Blackpool, UK</h4>
                                    </a>
                                    <p>Tiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                                    <a href="#" class="read-more">Continue Reading..</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                   

                </div>
            </div>

            <!-- ****** Blog Sidebar ****** -->
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                <div class="blog-sidebar mt-5 mt-lg-0">
                    <!-- Single Widget Area -->
                    <div class="single-widget-area about-me-widget text-center">
                        <div class="widget-title">
                            <h6>About Me</h6>
                        </div>
                        <div class="about-me-widget-thumb">
                            <img src="/customer/img/about-img/1.jpg" alt="">
                        </div>
                        <h4 class="font-shadow-into-light">Shopia Bernard</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
                    </div>

                    <!-- Single Widget Area -->
                    <div class="single-widget-area subscribe_widget text-center">
                        <div class="widget-title">
                            <h6>Subscribe &amp; Follow</h6>
                        </div>
                        <div class="subscribe-link">
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-google" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <!-- Single Widget Area -->
                    <div class="single-widget-area popular-post-widget">
                        <div class="widget-title text-center">
                            <h6>Populer Post</h6>
                        </div>
                        <!-- Single Popular Post -->
                        <div class="single-populer-post d-flex">
                            <img src="/customer/img/sidebar-img/1.jpg" alt="">
                            <div class="post-content">
                                <a href="#">
                                    <h6>Top Wineries To Visit In England</h6>
                                </a>
                                <p>Tuesday, October 3, 2017</p>
                            </div>
                        </div>
                        <!-- Single Popular Post -->
                        <div class="single-populer-post d-flex">
                            <img src="/customer/img/sidebar-img/2.jpg" alt="">
                            <div class="post-content">
                                <a href="#">
                                    <h6>The 8 Best Gastro Pubs In Bath</h6>
                                </a>
                                <p>Tuesday, October 3, 2017</p>
                            </div>
                        </div>
                        <!-- Single Popular Post -->
                        <div class="single-populer-post d-flex">
                            <img src="/customer/img/sidebar-img/3.jpg" alt="">
                            <div class="post-content">
                                <a href="#">
                                    <h6>Zermatt Unplugged the best festival</h6>
                                </a>
                                <p>Tuesday, October 3, 2017</p>
                            </div>
                        </div>
                        <!-- Single Popular Post -->
                        <div class="single-populer-post d-flex">
                            <img src="/customer/img/sidebar-img/4.jpg" alt="">
                            <div class="post-content">
                                <a href="#">
                                    <h6>Harrogate's Top 10 Independent Eats</h6>
                                </a>
                                <p>Tuesday, October 3, 2017</p>
                            </div>
                        </div>
                        <!-- Single Popular Post -->
                        <div class="single-populer-post d-flex">
                            <img src="/customer/img/sidebar-img/5.jpg" alt="">
                            <div class="post-content">
                                <a href="#">
                                    <h6>Eating Out On A Budget In Oxford</h6>
                                </a>
                                <p>Tuesday, October 3, 2017</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget Area -->
                    <div class="single-widget-area add-widget text-center">
                        <div class="add-widget-area">
                            <img src="/customer/img/sidebar-img/6.jpg" alt="">
                            <div class="add-text">
                                <div class="yummy-table">
                                    <div class="yummy-table-cell">
                                        <h2>Cooking Book</h2>
                                        <p>Buy Book Online Now!</p>
                                        <a href="#" class="add-btn">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Single Widget Area -->
                    <div class="single-widget-area newsletter-widget">
                        <div class="widget-title text-center">
                            <h6>Newsletter</h6>
                        </div>
                        <p>Subscribe our newsletter gor get notification about new updates, information discount, etc.</p>
                        <div class="newsletter-form">
                            <form action="#" method="post">
                                <input type="email" name="newsletter-email" id="email" placeholder="Your email">
                                <button type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ****** Blog Area End ****** -->

<!-- ****** Instagram Area Start ****** -->
<div class="instargram_area owl-carousel section_padding_100_0 clearfix" id="portfolio">

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="/customer/img/instagram-img/1.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="/customer/img/instagram-img/2.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="/customer/img/instagram-img/3.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="/customer/img/instagram-img/4.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="/customer/img/instagram-img/5.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="/customer/img/instagram-img/6.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="/customer/img/instagram-img/1.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Item -->
    <div class="instagram_gallery_item">
        <!-- Instagram Thumb -->
        <img src="/customer/img/instagram-img/2.jpg" alt="">
        <!-- Hover -->
        <div class="hover_overlay">
            <div class="yummy-table">
                <div class="yummy-table-cell">
                    <div class="follow-me text-center">
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Follow me</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- ****** Our Creative Portfolio Area End ****** -->
@endsection

<!-- Thêm JS để khởi tạo Slick Carousel -->
<!-- Thêm JS để khởi tạo Slick Carousel -->
<script>
    $(document).ready(function(){
        $('.category-carousel').slick({
            infinite: true,            // Lặp lại carousel
            slidesToShow: 3,           // Hiển thị 3 danh mục mỗi lần
            slidesToScroll: 1,         // Trượt 1 mục mỗi lần
            prevArrow: $('.slick-prev'),  // Liên kết nút Prev
            nextArrow: $('.slick-next'),  // Liên kết nút Next
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2   // Hiển thị 2 danh mục trên màn hình vừa
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1   // Hiển thị 1 danh mục trên màn hình nhỏ
                    }
                }
            ]
        });
    });
</script>


