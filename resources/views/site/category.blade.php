@extends('site.master')

@section('body')
<div class="breadcumb-area" style="background-image: url(/customer/img/bg-img/breadcumb.jpg);">
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
                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" style="width: 80px; height: 70px;">
                        <div class="catagory-title">
                            <a href="#">
                                <h5>{{ $category->name }}</h5>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
