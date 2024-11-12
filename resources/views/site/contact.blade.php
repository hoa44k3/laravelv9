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
                        <p>40 Baria Sreet 133/2 NewYork City, US <br> Email: info.contact@gmail.com <br> Phone: 123-456-7890</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form  -->
        <div class="contact-form-area">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="contact-form-sidebar item wow fadeInUpBig" data-wow-delay="0.3s" style="background-image: url(/customer/img/bg-img/contact.jpg);">
                    </div>
                </div>
                <div class="col-12 col-md-7 item">
                    <div class="contact-form wow fadeInUpBig" data-wow-delay="0.6s">
                        <h2 class="contact-form-title mb-30">If You Have Any Question Contact Me Today !</h2>
                        <!-- Contact Form -->
                        <form action="#" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="contact-name" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="contact-email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="contact-website" placeholder="Website">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                            </div>
                            <button type="submit" class="btn contact-btn">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- ****** Contact Area End ****** -->
@endsection