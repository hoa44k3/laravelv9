<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>Yummy Blog - Food Blog Template</title>

    <!-- Favicon -->
    <link rel="icon" href="/customer/img/core-img/logo.png">

    <!-- Core Stylesheet -->
    <link href="/customer/style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="/customer/css/responsive/responsive.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<style>
    .login_register_area a {
    pointer-events: auto;
    }

    a {
    text-decoration: none !important;
}
.no-underline a {
    text-decoration: none !important;
}

    .logo_area {
    position: relative; 
    display: inline-block;
}

.yummy-logo {
    width: 3000px;
    height: 300px; 
    object-fit: cover; 
    border-radius: 10px; 
}

.logo-text {
    position: absolute;
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%); 
    font-size: 36px; 
    font-weight: bold;
    color: white; 
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5); 
    z-index: 2; 
    font-family: Arial, sans-serif;
}
.user_avatar img {
    border-radius: 50%;
    border: 2px solid #ddd;
}
/* footer */
.social_icon_area {
    background-color: #222; 
    padding: 30px 0;
}

.footer-social-area .single-icon a {
    text-decoration: none;
    color: #ffffff; 
    font-size: 16px;
    transition: all 0.3s ease;
}

.footer-social-area .single-icon a:hover {
    color: #FFD700; 
}

.footer-social-area .single-icon i {
    font-size: 28px; 
    margin-right: 10px;
    transition: transform 0.3s ease;
}

.footer-social-area .single-icon i:hover {
    transform: scale(1.2); 
}

.footer-social-area .single-icon span {
    font-weight: 500; 
}
.signup-search-area {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 15px;
}

.login_register_area a,
.user_area .logout a,
.search_button a {
    display: inline-block;
    padding: 5px 10px;
    text-decoration: none;
    color: #333;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.login_register_area a:hover,
.user_area .logout a:hover,
.search_button a:hover {
    background-color: #007bff;
    color: #fff;
}

.search-hidden-form {
    display: none; /* Ban đầu ẩn */
    position: absolute;
    top: 100%;
    right: 0;
    background-color: white;
    border: 1px solid #ddd;
    padding: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 100;
}

.search-hidden-form.active {
    display: block; /* Hiển thị khi nhấn vào biểu tượng tìm kiếm */
}

.search_button {
    cursor: pointer;
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
                <div class="col-12">
                    <div class="signup-search-area d-flex align-items-center justify-content-end">
                        @if (Auth::check())
                            <!-- User Logged In -->
                            <div class="user_area d-flex align-items-center">
                                <div class="user_avatar">
                                    <a href="{{ route('users.profile', Auth::id()) }}" aria-label="Xem hồ sơ">
                                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/default-avatar.png') }}" 
                                             alt="Avatar của {{ Auth::user()->name }}" 
                                             style="width: 40px; height: 40px; border-radius: 50%;">
                                    </a>
                                </div>
                                <div class="user_name ml-2">
                                    <a href="javascript:void(0);" id="viewUserDetail" data-id="{{ Auth::id() }}">
                                        {{ Str::limit(Auth::user()->name, 15) }}
                                    </a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <div class="logout ml-3">
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                       aria-label="Đăng xuất">
                                        Đăng xuất
                                    </a>
                                </div>
                            </div>
                        @else
                            <!-- Guest View -->
                            <div class="login_register_area d-flex align-items-center">
                                <div class="login mr-2">
                                    <a href="{{ route('auth.login') }}" aria-label="Đăng nhập">Đăng nhập</a>
                                </div>
                                <div class="register">
                                    <a href="{{ route('auth.register') }}" aria-label="Đăng ký">Đăng ký</a>
                                </div>
                            </div>
                        @endif
    
                        <!-- Search Button -->
                        <div class="search_button ml-3">
                            <a class="searchBtn" href="#" aria-label="Tìm kiếm"><i class="fa fa-search" aria-hidden="true"></i></a>
                        </div>
    
                        <!-- Search Form -->
                        <div class="search-hidden-form">
                            <form action="{{ route('site.search') }}" method="GET">
                                <input type="search" name="query" id="search-anything" 
                                       placeholder="Tìm bài viết..." 
                                       aria-label="Tìm kiếm bài viết">
                                <button type="submit" aria-label="Tìm kiếm">Tìm kiếm</button>
                                <span class="searchBtn"><i class="fa fa-times" aria-hidden="true"></i></span>
                            </form>
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
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="yummyDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Chuyên mục</a>
                                    <div class="dropdown-menu" aria-labelledby="yummyDropdown">
                                        <a class="dropdown-item" href="{{route('guides')}}">Hướng dẫn</a>
                                        <a class="dropdown-item" href="#">Sự kiện</a>
             
                                        <a class="dropdown-item" href="#">Tuyển dụng</a> 
                                    
                                        <a class="dropdown-item" href="#">Diễn dàn</a>
                                    </div> 
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('event')}}">Sự kiện</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('blog')}}">Bài viết</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('guides')}}">Hướng dẫn</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('job')}}">Tuyển dụng</a>
                                </li>
                                {{-- <li class="nav-item"> 
                                    <a class="nav-link" href="{{ route('site.post', ['id' => $blog->id]) }}">Post</a> 
                                </li> --}}
                                <!-- site.master -->
                                {{-- <li class="nav-item">
                                    @if(isset($blog)) <!-- Kiểm tra sự tồn tại của biến $blog -->
                                        <a class="nav-link" href="{{ route('site.post', ['id' => $blog->id]) }}">Post</a>
                                    @else
                                        <span class="nav-link">Không có bài viết</span>
                                    @endif
                                </li> --}}

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
    
  <!-- End of .container -->
  <div class="social_icon_area py-4" style="background-color: #222;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="footer-social-area d-flex justify-content-center align-items-center flex-wrap">
                    <!-- Single Social Icon -->
                    <div class="single-icon mx-3">
                        <a href="#" class="text-white d-flex align-items-center">
                            <i class="fa fa-facebook fa-2x mr-2"></i>
                            <span>Facebook</span>
                        </a>
                    </div>
                    <div class="single-icon mx-3">
                        <a href="#" class="text-white d-flex align-items-center">
                            <i class="fa fa-twitter fa-2x mr-2"></i>
                            <span>Twitter</span>
                        </a>
                    </div>
                    <div class="single-icon mx-3">
                        <a href="#" class="text-white d-flex align-items-center">
                            <i class="fa fa-google-plus fa-2x mr-2"></i>
                            <span>Google+</span>
                        </a>
                    </div>
                    <div class="single-icon mx-3">
                        <a href="#" class="text-white d-flex align-items-center">
                            <i class="fa fa-linkedin-square fa-2x mr-2"></i>
                            <span>LinkedIn</span>
                        </a>
                    </div>
                    <div class="single-icon mx-3">
                        <a href="#" class="text-white d-flex align-items-center">
                            <i class="fa fa-instagram fa-2x mr-2"></i>
                            <span>Instagram</span>
                        </a>
                    </div>
                    <div class="single-icon mx-3">
                        <a href="#" class="text-white d-flex align-items-center">
                            <i class="fa fa-vimeo fa-2x mr-2"></i>
                            <span>Vimeo</span>
                        </a>
                    </div>
                    <div class="single-icon mx-3">
                        <a href="#" class="text-white d-flex align-items-center">
                            <i class="fa fa-youtube-play fa-2x mr-2"></i>
                            <span>YouTube</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Bắt sự kiện khi nhấn vào tên người dùng
        document.getElementById("viewUserDetail").addEventListener("click", function () {
            const userId = this.getAttribute("data-id");

            // Hiển thị modal và thêm loader
            const modal = new bootstrap.Modal(document.getElementById("userDetailModal"));
            document.getElementById("userDetailContent").innerHTML = `
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                </div>
            `;
            modal.show();

            // Gửi request AJAX để lấy dữ liệu người dùng
            fetch(`/users/${userId}/profile`, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json",
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Cập nhật nội dung modal
                        document.getElementById("userDetailContent").innerHTML = `
                            <div class="text-center mb-3">
                                <img 
                                    src="${data.user.image}" 
                                    alt="Avatar" 
                                    class="img-thumbnail rounded-circle" 
                                    style="width: 100px; height: 100px;"
                                >
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Tên</th>
                                    <td>${data.user.name}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>${data.user.email}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại</th>
                                    <td>${data.user.phone ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td>${data.user.address ?? 'N/A'}</td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh</th>
                                    <td>${data.user.birthday ?? 'N/A'}</td>
                                </tr>
                            </table>
                        `;
                    } else {
                        document.getElementById("userDetailContent").innerHTML = `<p class="text-danger">Không thể tải thông tin người dùng.</p>`;
                    }
                })
                .catch(() => {
                    document.getElementById("userDetailContent").innerHTML = `<p class="text-danger">Đã xảy ra lỗi khi tải dữ liệu.</p>`;
                });
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
    const searchBtn = document.querySelector('.search_button .searchBtn');
    const searchForm = document.querySelector('.search-hidden-form');

    if (searchBtn && searchForm) {
        searchBtn.addEventListener('click', function (e) {
            e.preventDefault();
            searchForm.classList.toggle('active');
        });
    }
});


</script>
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