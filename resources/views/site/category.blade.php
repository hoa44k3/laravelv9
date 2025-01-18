@extends('site.master')

@section('body')
<style>
 
.categories_area .single_catagory {
    position: relative;
    overflow: hidden; 
}

.catagory-img-wrapper {
    position: relative;
    width: 100%;
    height: 300px; 
}

.catagory-img {
    width: 100%;
    height: 100%;
    object-fit: cover; 
    transition: transform 0.3s ease, opacity 0.3s ease; 
}

.catagory-title {
    position: absolute;
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%); 
    background-color: rgba(0, 0, 0, 0.5); 
    color: white;
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
    text-align: center; 
    display: none; 
    transition: opacity 0.3s ease;
}

.catagory-img-wrapper:hover .catagory-img {
    transform: scale(1.1); 
    opacity: 0.8;
}

.catagory-img-wrapper:hover .catagory-title {
    display: block;
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
