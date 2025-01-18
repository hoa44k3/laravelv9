@extends('site.master')

@section('title','Hướng dẫn')   
@section('body')
<div class="breadcumb-area" style="background-image: url(/customer/img/ne2.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="bradcumb-title text-center">
                    <h2>Hướng dẫn</h2>
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
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Hướng dẫn</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ****** Breadcumb Area End ****** -->
<!-- ****** Search Bar Start ****** -->
{{-- <section class="search_area section_padding_80">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h2 class="section-title">Tìm kiếm bài viết</h2>
                <form action="#" method="GET">
                    <input type="text" name="query" placeholder="Tìm kiếm bài viết..." class="form-control" required>
                    <button type="submit" class="btn btn-primary mt-3">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div>
</section> --}}
<!-- ****** Search Bar End ****** -->

<!-- ****** Archive Area Start ****** -->
<section class="archive-area section_padding_80">
    <div class="container">
        <div class="row">

            @foreach($guides as $guide)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-post wow fadeInUp" data-wow-delay="0.1s">
                    <!-- Post Thumb -->
                    <div class="post-thumb">
                        <img src="{{ asset('storage/' . ltrim($guide->image, 'http://127.0.0.1:8000/')) }}" alt="">
                    </div>
                    <!-- Post Content -->
                    <div class="post-content">
                        <div class="post-meta d-flex">
                            <div class="post-author-date-area d-flex">
                                <!-- Post Author -->
                                <div class="post-author">
                                    <a href="#">By {{ $guide->user->name ?? 'Không có tác giả' }}</a>
                                </div>
                                <!-- Post Date -->
                                <div class="post-date">
                                    <a href="#">{{ $guide->created_at->format('M d, Y') }}</a>
                                </div>
                            </div>
                            <!-- Post Comment & Share Area -->
                            <div class="post-comment-share-area d-flex">
                                <!-- Post Share -->
                                <div class="post-share">
                                    <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        {{-- <a href="{{ route('guides') }}">
                            <h4 class="post-headline">{{ $guide->title }}</h4>
                        </a> --}}
                        <a href="{{ route('guidesdetail', $guide->id) }}" class="post-title">
                            <h4 class="post-headline mt-3">{{ $guide->title }}</h4>
                            {!! \Illuminate\Support\Str::limit(strip_tags($guide->content, '<p><br><strong><em>'), 100) !!}

                        </a>
                    </div>
                </div>
            </div>
        @endforeach
            <div class="col-12">
                <div class="pagination-area d-sm-flex mt-15">
                    <nav aria-label="#">
                        <ul class="pagination">
                            <li class="page-item active">
                                <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="page-status">
                        <p>Page 1 of 60 results</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ****** Archive Area End ****** -->
@endsection
