@extends('site.master')

@section('title', 'Tuyển dụng')   

@section('body')
<!-- ***** Breadcumb Area Start ***** -->
<div class="breadcumb-area" style="background: linear-gradient(to right, #f06, #48c6ef); padding: 100px 0;">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 text-center">
                <div class="bradcumb-title">
                    <h2 class="text-white">Chi tiết tuyển dụng</h2>
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
                        <li class="breadcrumb-item"><a href="#" class="text-dark"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-dark">Tuyển dụng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chi tiết tuyển dụng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ***** Breadcumb Area End ***** -->

<!-- ***** Single Blog Area Start ***** -->
<section class="single_blog_area section_padding_80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="row no-gutters">
                    <!-- Single Post Share Info -->
                    <div class="col-2 col-sm-1">
                        <div class="single-post-share-info mt-100">
                            <a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" class="googleplus"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            <a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" class="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <!-- Single Post -->
                    <div class="col-10 col-sm-11">
                        <div class="single-post border rounded shadow-sm p-4">
                            <!-- Post Thumb -->
                            <div class="post-thumb mb-4">
                                <img src="{{ asset('storage/' . ltrim($job->image, 'http://127.0.0.1:8000/')) }}" alt="" class="img-fluid rounded" style="width: 100%; height: 400px; object-fit: cover;">
                            </div>
                            
                            <!-- Post Content -->
                            <div class="post-content">
                                <div class="post-meta d-flex mb-3">
                                    <div class="post-author-date-area d-flex">
                                        <!-- Post Author -->
                                        <div class="post-author">
                                            <a href="#" class="font-weight-bold">By Marian</a>
                                        </div>
                                        <!-- Post Date -->
                                        <div class="post-date text-muted">
                                            <a href="#">{{ \Carbon\Carbon::parse($job->job_date)->format('M d, Y') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="post-headline mb-4 text-primary font-weight-bold">{{ $job->title }}</h2>
                                
                                <p>{!! nl2br(e($job->description)) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Single Blog Area End ***** -->
@endsection
