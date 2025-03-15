@extends('layouts.site')
<style>
    .about-img-div {
        position: relative;
    }

    .about-img-div img {
        max-width: 100%;
        display: block;
        /* position: absolute -200px; */
        transition: transform 1s ease;
    }

    .ring-img {
        top: 0;
        left: 0;
    }

    .diamond-img {
        transform: translateY(-70px);
        bottom: 0;
        left: 0;
        transition: transform 1s ease;
    }

    .star {
        color: rgb(208 213 10) !important;
    }

    .instagram-img img,
    .instagram-img video {
        height: 380px;
    }

    /* Media query for mobile devices */
    @media only screen and (max-width: 769px) {
        .diamond-img {
            transition: transform 2s ease !important; /* Slower duration for mobile (3s) */
        }
    }


    @media only screen and (max-width: 1025px) {

        .instagram-img img,
        .instagram-img video {
            height: 250px;
        }
    }

    @media only screen and (max-width: 769px) {

        .instagram-img img,
        .instagram-img video {
            height: 300px;
        }
    }

    @media only screen and (max-width: 599px) {

        .instagram-img img,
        .instagram-img video {
            height: 280px;
        }
    }

    @media only screen and (max-width: 425px) {

        .instagram-img img,
        .instagram-img video {
            height: 240px;
        }
    }

    @media only screen and (max-width: 375px) {

        .instagram-img img,
        .instagram-img video {
            height: 200px;
        }
    }
</style>
@section('content')

@php
$carousel_image = app('carousel_image');
$banner_image = app('banner');
@endphp

<section class="banner-section">
    <div class="home-carousel owl-carousel owl-theme">
        @foreach ($banner_image as $banner)
        <div class="item">
            <a href="{{ $banner['link'] }}" class="banner-div">
                <!-- <div class="banner-content text-center">
                        <h2 class="section-title mb-4 text-white">Exquisite Designer Rings</h2>
                        <p class="mb-4 text-white">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="btn-div btn primary-btn large-btn"> Shop Now</div>
                    </div> -->
                <img src="{{ $banner['image'] }}" alt="slider">
            </a>
        </div>
        @endforeach
    </div>
</section>

<section class="engagement-slider-section wow fadeInUp py-5">
    <div class="title-div text-center">
        <h2 class="section-title">New Arrivals</h2>
    </div>
    <div class="engagement-slider-div mx-5 mx-sm-0">
        <div class="engagement-carousel owl-carousel owl-theme">
            @foreach ($carousel_image as $image)
            @php
            $colorCode = config('constant.COLOR_CODE.' . $image['default_color']);
            @endphp
            <div class="item">
                <div class="engagement-img-box">
                    <a href="{{url('').'/'.$image['category']['name'].'/'.$image['product_sku'].'/'.$image['default_color'].'-gold'.'/'.str_replace(' ', '-',$image['name'])}}" class="engagment-img-div">
                        <img src="{{ url('public/assets/img/product/') . '/' . $image['product_sku'] . '/' . $image['product_sku'] . '_' . $colorCode . '1.webp' }}" alt="img" class="img-fluid">
                    </a>
                    <div class="product-name-div text-center">
                        <h5>{{ $image['name'] }}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="animation-container" class="about-section pt-5 animation-container">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-5">
                <div class="about-content wow fadeInLeft">
                    <h2 class="section-title">About Diamond Sutra</h2>
                    <p class="mb-4">Diamond Sutra offers certified natural diamond jewelry and hallmarked gold at affordable prices, exclusively online. Our collection features elegant office-wear jewelry, modern ring and necklace designs, and stylish gold rings for women—perfect for any occasion. 
                    <br><br>
                        With three generations of expertise, we combine quality and style, ensuring you receive high-quality diamond and gold jewelry without the traditional markups. Discover Diamond Sutra’s affordable and contemporary designs that seamlessly blend with your daily style, making luxury jewelry accessible across India.</p>
                    <!-- <p class="mb-4">Our online platform eliminates unnecessary markups, ensuring fair prices for exquisite pieces tailored to your preferences. Upholding the highest standards of authenticity and excellence. Meticulously crafting every piece of jewelry with care and precision. Ensuring certification for each item, reflecting our commitment to quality and transparency. Offering a hassle-free return policy, providing peace of mind with every purchase.</p> -->
                    <!-- <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item ps-0">Our online platform eliminates unnecessary markups, ensuring fair prices for exquisite pieces tailored to your preferences.</li>
                            <li class="list-group-item ps-0">Upholding the highest standards of authenticity and excellence.</li>
                            <li class="list-group-item ps-0">Meticulously crafting every piece of jewelry with care and precision.</li>
                            <li class="list-group-item ps-0">Ensuring certification for each item, reflecting our commitment to quality and transparency.</li>
                            <li class="list-group-item ps-0">Offering a hassle-free return policy, providing peace of mind with every purchase.</li>
                        </ul> -->

                    <div class="about-btn-div">
                        <a href="{{ url('about') }}" class="btn btn-outline-dark large-btn">Know More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-7">
                <div class="about-img-div position-relative">
                    <div class="rd-img" data-wow-duration="2s">
                        <img src="{{ url('public/assets/img/diamond.png') }}" alt="img" class="diamond-img">
                    </div>
                    <img src="{{ url('public/assets/img/ring.png') }}" alt="img" class="img-fluid" class="ring-img">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="category-section overflow-hidden pb-5">
    <div class="container">
        <div class="row g-4">
            <div class="wow col-md-12">
                <div class="category-img">
                    <a href="{{url('/jewellery')}}"><img src="{{ url('public/assets/img/diamondsutra_percentage_off.png') }}" alt="img" class="img-fluid"></a>
                    <!-- <div class="content-box">
                            <h2 class="section-title">Diamond Studs</h2>
                            <p>Lorem ipsum dolor sit amet</p>
                        </div> -->
                </div>
            </div>
            <div class="wow col-md-4">
                <div class="category-img">
                    <a href="{{url('/jewellery?c=Pendants')}}"><img src="{{ url('public/assets/img/diamondsutra_pendants.png') }}" alt="img" class="img-fluid"></a>
                    <!-- <div class="content-box">
                            <h3>Tennis Bracelets</h3>
                            <p>Lorem ipsum dolor sit amet</p>
                        </div> -->
                </div>
            </div>
            <div class="wow col-md-4">
                <div class="category-img">
                    <a href="{{url('/jewellery?c=Earrings')}}"><img src="{{ url('public/assets/img/diamondsutra_earrings.png') }}" alt="img" class="img-fluid"></a>
                    <!-- <div class="content-box">
                            <h3>Diamond Pendants</h3>
                            <p>Lorem ipsum dolor sit amet</p>
                        </div> -->
                </div>
            </div>
            <div class="wow col-md-4">
                <div class="category-img">
                    <a href="{{url('/jewellery?c=Bracelets')}}"><img src="{{ url('public/assets/img/diamondsutra_bracelets.png') }}" alt="img" class="img-fluid"></a>
                    <!-- <div class="content-box">
                            <h3>Anniversary Rings</h3>
                            <p>Lorem ipsum dolor sit amet</p>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <section class="engagement-slider-section wow fadeInUp py-5">
    <div class="title-div text-center">
        <h2 class="section-title">Best Selling Product</h2>
    </div>
    <div class="engagement-slider-div mx-5 mx-sm-0">
        <div class="engagement-carousel owl-carousel owl-theme">
            @foreach ($carousel_image as $image)
            @php
            $colorCode = config('constant.COLOR_CODE.' . $image['default_color']);
            @endphp
            <div class="item">
                <div class="engagement-img-box">
                    <div class="engagement-img-box">
                        <a href="{{url('').'/'.$image['category']['name'].'/'.$image['product_sku'].'/'.$image['default_color'].'-gold'.'/'.str_replace(' ', '-',$image['name'])}}" class="engagment-img-div">
                            <img src="{{ url('public/assets/img/product/') . '/' . $image['product_sku'] . '/' . $image['product_sku'] . '_' . $colorCode . '1.jpg' }}" alt="img" class="img-fluid">
                        </a>
                        <div class="product-name-div text-center">
                            <h5>{{ $image['name'] }}</h5>
                            <!-- <p>{{ $image['description'] }}</p> -->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> --}}
<section class="detail-section py-5">
    <div class="container">
        <h2 class="section-title text-center">Personalized Brilliance</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="detail-box-div dbd-1">
                    <div class="db-img wow fadeInUp">
                        <a href="{{url('/jewellery?c=Rings')}}"><img src="{{ url('public/assets/img/personalized_ring.png') }}" alt="img" class="img-fluid"></a>
                    </div>
                    <div class="db-content">
                        <p>Craft your dream engagement ring by handpicking from our vast collection of solitaires and
                            choosing the perfect setting reflecting your unique style.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-box-div dbd-2">
                    <div class="db-content">
                        <p>Discover your ideal diamond with confidence by exploring close-up videos and certificates,
                            ensuring you know exactly what your diamond will looks like.</p>
                    </div>
                    <div class="db-img wow fadeInDown">
                        <a href="{{url('/design-your-own-solitaire-ring?cat=ring')}}"><img src="{{ url('public/assets/img/personalized_diamond.png') }}" alt="img" class="img-fluid"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-5 bg-light text-center">
    <div class="container">
        <h2 class="section-title">Diamond Sutra Promises</h2>
        <div class="row g-4 align-items-center justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="promise-panel  wow fadeInDown py-5 px-2 border position-relative overflow-hidden">
                    <img src="{{ url('public/assets/img/dp-certificate.png') }}" alt="diamond-promise" class="mb-4">
                    <h5 class="m-0">100% certified jewelry</h5>
                    <div class="promise-hover-content position-absolute bg-white start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="p-4 fs-14">
                            <p class="mb-3 text-black">Our jewellery is hallmarked for gold authenticity, and diamonds
                                come with certifications from respected laboratories such as GIL, SGL, IGI, and GIA</p>
                            <a href="{{ asset('our-certifications') }}" class="text-uppercase text-black fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="promise-panel  wow fadeInDown py-5 px-2 border position-relative overflow-hidden">
                    <img src="{{ url('public/assets/img/dp-money-back-guarantee.png') }}" alt="diamond-promise" class="mb-4">
                    <h5 class="m-0">15-day refund policy</h5>
                    <div class="promise-hover-content position-absolute bg-white start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="p-4 fs-14">
                            <p class="mb-3 text-black">Our 15-day money back policy ensures your satisfaction. Upon
                                return of the product within this timeframe (*excluding solitaires above INR 2 lakh),
                                subject to quality checks, a full refund will be promptly credited to your account.</p>
                            <a href="{{ asset('returns-policy') }}" class="text-uppercase text-black fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="promise-panel  wow fadeInDown py-5 px-2 border position-relative overflow-hidden">
                    <img src="{{ url('public/assets/img/dp-exchange.png') }}" alt="diamond-promise" class="mb-4">
                    <h5 class="m-0">Lifetime Exchange & Buyback</h5>
                    <div class="promise-hover-content position-absolute bg-white start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="p-4 fs-14">
                            <p class="mb-3 text-black">We offer Lifetime Exchange & Buy Back on all purchases*. The
                                exchange/buy back value will be calculated as per the current market value on the day
                                the exchange request is raised. Click here to Know more</p>
                            <a href="{{ asset('lifetime-exchange-buy-back-policy') }}" class="text-uppercase text-black fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="promise-panel  wow fadeInDown py-5 px-2 border position-relative overflow-hidden">
                    <img src="{{ url('public/assets/img/dp-delivered.png') }}" alt="diamond-promise" class="mb-4">
                    <h5 class="m-0">Free Shipping & Insurance</h5>
                    <div class="promise-hover-content position-absolute bg-white start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="p-4 fs-14">
                            <p class="mb-3 text-black">We provide free delivery/shipping on all items within India. All
                                goods will be fully insured by Diamond Sutra until they reach you, so your purchase is
                                100% safe.
                            </p><a href="{{ asset('returns-policy/#free-shipping-section') }}" class="text-uppercase text-black fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="promise-panel  wow fadeInDown py-5 px-2 border position-relative overflow-hidden">
                    <img src="{{ url('public/assets/img/dp-size.png') }}" alt="diamond-promise" class="mb-4">
                    <h5 class="m-0">Complementary Resizing</h5>
                    <div class="promise-hover-content position-absolute bg-white start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="p-4 fs-14">
                            <p class="mb-3 text-black">We offer one time complimentary resizing services for all items
                                purchased from us. Simply contact our customer service team, and they will assist you in
                                determining the appropriate size adjustment for your ring. </p>
                            <a href="{{ asset('why-buy-from-us/#resize-section') }}" class="text-uppercase text-black fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" id="home-testimonial">
                <div class="promise-panel  wow fadeInDown py-5 px-2 border position-relative overflow-hidden">
                    <img src="{{ url('public/assets/img/dp-best-price.png') }}" alt="diamond-promise" class="mb-4">
                    <h5 class="m-0">Transparent Pricing</h5>
                    <div class="promise-hover-content position-absolute bg-white start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="p-4 fs-14">
                            <p class="mb-3 text-black">At Diamond Sutra, we believe in providing our customers with
                                complete transparency in pricing, ensuring you know exactly what you're paying for. With
                                us, you can trust that every aspect of our pricing is clear and fair.</p>
                            <a href="{{ asset('why-buy-from-us/#transperant-section') }}" class="text-uppercase text-black fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonial-section wow fadeInUp pt-5 pb-md-5 pb-4" id="home-testimonial">
    <div class="testimonials-clean">
        <div class="container">
            <div class="intro">
                <h2 class="section-title text-center">Testimonials</h2>
            </div>
            <div class="row people">
                <div class="testimonial-carousel owl-carousel owl-theme">
                    @foreach ($body['data'] as $testimonal)
                    <div class="item">
                        <div class="promise-panel testimonial-panel py-2 px-2 position-relative">
                            <img src="{{ $testimonal['testimonial_image'] }}" alt="diamond-promise" class="w-100 mw-100 m-0">
                            <div class="promise-hover-content position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                <div class="p-4 fs-14">
                                    <p class="mb-3 text-black">{{ $testimonal['msg'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="author">
                            <img class="rounded-circle" src="{{ $testimonal['testimonial_image'] }}">
                            <div>
                                <h5 class="name">{{ $testimonal['client_name'] }}
                                    <div class="tc-stars">
                                        <p>
                                            @for ($i = 0; $i < $testimonal['rating']; $i++) <i class="fa fa-star star"></i>
                                                @endfor
                                        </p>
                                    </div>
                                </h5>
                                <p class="title">{{ $testimonal['designation'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="item">
                        <div class="promise-panel testimonial-panel py-2 px-2 position-relative">
                            <img src="{{url('public/assets/img/rign-img-1.jpg')}}" alt="diamond-promise" class="w-100 mw-100 m-0">
                    <div class="promise-hover-content position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="p-4 fs-14">
                            <p class="mb-3 text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Et ligula ullamcorper malesuada proin libero nunc
                                tempor incididunt ut labore et dolore magna aliqua. Et ligula ullamcorper malesuada proin libero nunc
                                consequat.</p>
                        </div>
                    </div>
                </div>
                <div class="author">
                    <img class="rounded-circle" src="{{url('public/assets/img/t1.png')}}">
                    <div>
                        <h5 class="name">Carl Kent</h5>
                        <p class="title">Founder of Style Co.</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="promise-panel testimonial-panel py-2 px-2 position-relative">
                    <img src="{{url('public/assets/img/rign-img-1.jpg')}}" alt="diamond-promise" class="w-100 mw-100 m-0">
                    <div class="promise-hover-content position-absolute start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="p-4 fs-14">
                            <p class="mb-3 text-black">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Et ligula ullamcorper malesuada proin libero nunc
                                tempor incididunt ut labore et dolore magna aliqua. Et ligula ullamcorper malesuada proin libero nunc
                                consequat.</p>
                        </div>
                    </div>
                </div>
                <div class="author">
                    <img class="rounded-circle" src="{{url('public/assets/img/t1.png')}}">
                    <div>
                        <h5 class="name">Emily Clark</h5>
                        <p class="title">Owner of Creative Ltd.</p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    </div>
    </div>
</section> 
@php

@endphp
@if(isset($body['contents']))
<section class="instagram-section wow fadeInUp overflow-hidden py-5">
    <h2 class="section-title text-center">Follow Our Instagram</h2>
    <div class="instagram-carousel owl-carousel owl-theme">
            @foreach ($body['contents']['data'] as $post)
            @php
            $username = isset($post['username']) ? $post['username'] : '';
            $caption = isset($post['caption']) ? $post['caption'] : '';
            $media_url = isset($post['media_url']) ? $post['media_url'] : '';
            $permalink = isset($post['permalink']) ? $post['permalink'] : '';
            $media_type = isset($post['media_type']) ? $post['media_type'] : '';
            @endphp
            <div class="item">
                <div class="instagram-img">
                    <a href="{{ $permalink }}" target="_blank" class="engagment-img-div">
                        @if ($media_type == 'VIDEO')
                        <video controls style='width:100%; display: block !important;'>
                            <source src='{{ $media_url }}' type='video/mp4'>
                            Your browser does not support the video tag.
                        </video>
                        @else
                        <img src="{{ $media_url }}" alt="{{ $caption }}" class="img-fluid">
                        @endif
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endif
@stop
@section('footer')
<script>
    $(document).ready(function() {
        $('.diamond-img').css('transform', 'translateY(-70px)');
        $(window).on('scroll', function() {
            var container = document.getElementById('animation-container');
            var scrollTop = $(window).scrollTop();
            var scrollDirection = scrollTop > $(this).data('scroll-position') ? 'down' : 'up';
            if (scrollTop >= $(container).height()) {
                $(this).data('scroll-position', scrollTop);

                if (scrollDirection === 'down') {
                    $('.diamond-img').css('transform', 'translateY(0)');
                } else {
                    $('.diamond-img').css('transform', 'translateY(-70px)');
                }
            }
        });
    });
</script>
@stop