<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Yummy Blog - Food Blog Template</title>

    <!-- Favicon -->
    <link rel="icon" href="/customer/img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link href="/customer/style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="/customer/css/responsive/responsive.css" rel="stylesheet">

</head>
<style>
    .logo_area {
    position: relative; /* Tạo lớp cha để định vị chữ */
    display: inline-block;
}

.yummy-logo {
    width: 3000px; /* Kéo ảnh ra toàn chiều rộng cột */
    height: 300px; /* Đặt chiều cao cố định hoặc sử dụng giá trị tự do */
    object-fit: cover; /* Đảm bảo ảnh không bị méo */
    border-radius: 10px; /* Tùy chọn: Thêm bo tròn góc nếu cần */
}

.logo-text {
    position: absolute;
    top: 50%; /* Căn giữa theo chiều dọc */
    left: 50%; /* Căn giữa theo chiều ngang */
    transform: translate(-50%, -50%); /* Đảm bảo chữ nằm chính giữa ảnh */
    font-size: 36px; /* Tùy chỉnh kích thước chữ */
    font-weight: bold;
    color: white; /* Màu chữ (tùy chỉnh nếu cần) */
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5); /* Tạo bóng để chữ nổi bật hơn */
    z-index: 2; /* Đảm bảo chữ nằm trên ảnh */
    font-family: Arial, sans-serif; /* Tùy chỉnh font chữ */
}
.user_avatar img {
    border-radius: 50%;
    border: 2px solid #ddd;
}

</style>
<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="yummy-load"></div>
    </div>

    <!-- ****** Top Header Area Start ****** -->
    <div class="top_header_area">
        <div class="container">
            <div class="row">
                <div class="col-5 col-sm-6"></div>
                <!-- Login Register Area -->
                <div class="col-7 col-sm-6">
                    <div class="signup-search-area d-flex align-items-center justify-content-end">
                        @if (Auth::check())
                            <!-- User Logged In -->
                            <div class="user_area d-flex align-items-center">
                                <div class="user_avatar">
                                    <a href="{{ route('users.profile', Auth::id()) }}">
                                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/default-avatar.png') }}" 
                         alt="Image" style="width: 40px; height: 40px;">
                                    </a>
                                </div>
                                <div class="user_name ml-2">
                                    <a href="{{ route('users.profile', Auth::id()) }}">
                                        {{ Auth::user()->name }}
                                    </a>
                                </div>
                                <div class="logout ml-3">
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                    </a>
                                </div>
                            </div>
                        @else
                            <!-- Guest View -->
                            <div class="login_register_area d-flex">
                                <div class="login">
                                    <a href="{{ route('auth.login') }}">Đăng nhập</a>
                                </div>
                                <div class="register">
                                    <a href="{{ route('auth.register') }}">Đăng ký</a>
                                </div>
                            </div>
                        @endif
                        <!-- Search Button Area -->
                        <div class="search_button">
                            <a class="searchBtn" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <!-- ****** Top Header Area End ****** -->

    <!-- ****** Header Area Start ****** -->
    <header class="header_area">
        <div class="container">
            <div class="row">
                <!-- Logo Area Start -->
                <div class="col-12">
                    <div class="logo_area text-center position-relative">
                        <a href="index.html">
                            <img src="/customer/img/nen.jpg" alt="Yummy Blog Logo" class="yummy-logo">
                        </a>
                        <div class="logo-text">
                            Yummy Blog
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#yummyfood-nav" aria-controls="yummyfood-nav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars" aria-hidden="true"></i> Menu</button>
                        <!-- Menu Area Start -->
                        <div class="collapse navbar-collapse justify-content-center" id="yummyfood-nav">
                            <ul class="navbar-nav" id="yummy-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="yummyDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                                    <div class="dropdown-menu" aria-labelledby="yummyDropdown">
                                        <a class="dropdown-item" href="{{ route('index') }}">Trang chủ</a>
                                        <a class="dropdown-item" href="{{ route('blog') }}">Bài viết</a>
             
                                        <a class="dropdown-item" href="{{ route('site.post', ['id' => $blog->id]) }}">Nội dung bài viết</a> 
                                    
                                        <a class="dropdown-item" href="{{ route('contact') }}">Liên hệ</a>
                                    </div>
                                    
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{route('category')}}">Categories</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('blog')}}">Blog</a>
                                </li>
                                <li class="nav-item">
                                    
                                    <a class="nav-link" href="{{ route('site.post', ['id' => $blog->id]) }}">Post</a>
                                    
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('contact')}}">Contact</a>
                                </li>
                            </ul>
                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ****** Header Area End ****** -->

    @yield('body')

    <!-- ****** Footer Social Icon Area Start ****** -->
    <div class="social_icon_area clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-social-area d-flex">
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i><span>facebook</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twitter</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i><span>GOOGLE+</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i><span>linkedin</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i><span>VIMEO</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>YOUTUBE</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Footer Social Icon Area End ****** -->



    <!-- Jquery-2.2.4 js -->
    <script src="/customer/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="/customer/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="/customer/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins JS -->
    <script src="/customer/js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="/customer/js/active.js"></script>
</body>
