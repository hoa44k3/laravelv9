@extends('site.master')

@section('title','Hướng dẫn')   
@section('body')
    <!-- ****** Breadcumb Area Start ****** -->
    <div class="breadcumb-area" style="background-image: url(/customer/img/ne2.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>Chi tiết hướng dẫn</h2>
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
                            <li class="breadcrumb-item"><a href="{{route('blog')}}">Hướng dẫn</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết hướng dẫn</li>
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
                <div class="col-12 col-lg-8">
                    <div class="row no-gutters">

                        <!-- Single Post Share Info -->
                        <div class="col-2 col-sm-1">
                            <div class="single-post-share-info mt-100">
                                <a href="#" class="facebook" title="Chia sẻ trên Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#" class="twitter" title="Chia sẻ trên Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#" class="googleplus" title="Chia sẻ trên Google Plus"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                <a href="#" class="instagram" title="Chia sẻ trên Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#" class="pinterest" title="Chia sẻ trên Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            </div>
                        </div>

                        <!-- Single Post -->
                        <div class="col-10 col-sm-11">
                            <div class="single-post">
                                <!-- Post Thumb -->
                                <div class="post-thumb mb-4">
                                    <img src="{{ asset('storage/' . ltrim($guide->image, 'http://127.0.0.1:8000/')) }}" alt="" class="img-fluid rounded shadow-lg">
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex mb-4">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author text-muted">
                                                <a href="#">By {{ $guide->user->name ?? 'Không có tác giả' }}</a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date text-muted ms-3">
                                                <a href="#">{{ $guide->created_at->format('M d, Y') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h2 class="post-headline text-dark">{{ $guide->title }}</h2>
                                    <p>{!! nl2br(e($guide->content)) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
