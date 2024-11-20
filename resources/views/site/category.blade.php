@extends('site.master')

@section('body')
<style>
 /* Style cho khu vực danh mục */
.categories_area .single_catagory {
    position: relative;
    overflow: hidden; /* Đảm bảo nội dung không tràn ra ngoài */
}

/* Wrapper cho ảnh và tiêu đề */
.catagory-img-wrapper {
    position: relative;
    width: 100%;
    height: 300px; /* Cố định chiều cao cho ảnh */
}

/* Cách chỉnh ảnh lớn hơn và căn chỉnh */
.catagory-img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Giữ tỉ lệ ảnh, không bị méo */
    transition: transform 0.3s ease, opacity 0.3s ease; /* Hiệu ứng di chuyển và làm mờ ảnh */
}

/* Tiêu đề danh mục */
.catagory-title {
    position: absolute;
    top: 50%; /* Đặt tiêu đề ở giữa ảnh theo chiều dọc */
    left: 50%; /* Đặt tiêu đề ở giữa ảnh theo chiều ngang */
    transform: translate(-50%, -50%); /* Dịch chuyển tiêu đề để căn giữa chính xác */
    background-color: rgba(0, 0, 0, 0.5); /* Nền tối cho tiêu đề */
    color: white;
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
    text-align: center; /* Đặt tiêu đề vào giữa */
    display: none; /* Tiêu đề sẽ ẩn khi không di chuột vào ảnh */
    transition: opacity 0.3s ease;
}

/* Hiệu ứng khi di chuột vào ảnh */
.catagory-img-wrapper:hover .catagory-img {
    transform: scale(1.1); /* Phóng to ảnh một chút */
    opacity: 0.8; /* Làm mờ ảnh */
}

.catagory-img-wrapper:hover .catagory-title {
    display: block; /* Hiển thị tiêu đề khi di chuột vào ảnh */
}



</style>
<div class="breadcumb-area" style="background-image: url(/customer/img/ne2.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="bradcumb-title text-center">
                    <h2>Danh mục </h2>
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
                        <li class="breadcrumb-item active" aria-current="page">Danh mục </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="categories_area clearfix" id="about">
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single_catagory wow fadeInUp" data-wow-delay=".3s">
                        <!-- Container for image and title -->
                        <div class="catagory-img-wrapper">
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="catagory-img">
                            <div class="catagory-title">
                                <a href="#">
                                    <h5>{{ $category->name }}</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


@endsection
