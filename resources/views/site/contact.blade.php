@extends('site.master')

@section('title','Liên hệ')   
@section('body')
   <!-- ****** Breadcumb Area Start ****** -->
   <div class="breadcumb-area" style="background-image: url(/customer/img/bg-img/breadcumb.jpg);">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="bradcumb-title text-center">
                    <h2>Contact Us</h2>
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
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ****** Breadcumb Area End ****** -->

<!-- ****** Contatc Area Start ****** -->
<div class="contact-area section_padding_80">
    <div class="container">
        <!-- Contact Info Area Start -->
        <div class="contact-info-area section_padding_80_50">
            <div class="row">
                <!-- Single Contact Info -->
                <div class="col-12 col-md-4">
                    <div class="single-contact-info mb-30 text-center wow fadeInUp" data-wow-delay="0.3s">
                        <h4>France</h4>
                        <p>40 Baria Sreet 133/2 NewYork City, US <br> Email: info.contact@gmail.com <br> Phone: 123-456-7890</p>
                    </div>
                </div>
                <!-- Single Contact Info -->
                <div class="col-12 col-md-4">
                    <div class="single-contact-info mb-30 text-center wow fadeInUp" data-wow-delay="0.6s">
                        <h4>United States</h4>
                        <p>40 Baria Sreet 133/2 NewYork City, US <br> Email: info.contact@gmail.com <br> Phone: 123-456-7890</p>
                    </div>
                </div>
                <!-- Single Contact Info -->
                <div class="col-12 col-md-4">
                    <div class="single-contact-info mb-30 text-center wow fadeInUp" data-wow-delay="0.9s">
                        <h4>Viet Nam</h4>
                        <p>Phượng Hoàng, Trung Đô, Thành Phố Vinh <br> Email: pxinh3771@gmail.com <br> Phone: 035-669-4603</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form  -->
        <div class="contact-form-area">
            <div class="row">
                <!-- Sidebar Image -->
                <div class="col-12 col-md-5">
                    <div class="contact-form-sidebar item wow fadeInUpBig" data-wow-delay="0.3s" style="background-image: url({{ asset('customer/img/bg-img/a10.png') }});">
                    </div>
                </div>
                <!-- Contact Form -->
                <div class="col-12 col-md-7 item">
                    <div class="contact-form wow fadeInUpBig" data-wow-delay="0.6s">
                        <h2 class="contact-form-title mb-30">Nếu bạn có bất kỳ câu hỏi nào, hãy liên hệ với tôi ngay hôm nay!</h2>
                        <!-- Form -->
                        @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Họ và tên" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="5" placeholder="Tin nhắn" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </form>

                    </div>
                </div>
            </div>
        </div>
        

    </div>
</div>
<!-- ****** Contact Area End ****** -->
@endsection