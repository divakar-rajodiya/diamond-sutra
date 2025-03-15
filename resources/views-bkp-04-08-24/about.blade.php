@extends('layouts.site')
@section('content')

<main>
    <div class="page-title">
        <div class="container">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
                        <li class="breadcrumb-item"><a href="#">about us</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>   

    <div class="about-us py-sm-5 py-4">
        <div class="container">
            <h3 class="mb-4">Welcome to Diamond Sutra where diamonds meet transparency and tradition!</h3>
            <p>Based in the vibrant city of gems, Jaipur, we are proud to be a third-generation jeweller with a mission to revolutionize the diamond jewelry industry. Here's why we stand out.</p>
        </div>
    </div>

    <div class="about-us">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <div class="about-us-left text-center text-lg-start">
                        <img src="{{url('public/assets/img/about-us.jpg')}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-us-right">
                        <div class="d-inline-block mb-2"><h5>Transparent Pricing</h5></div>
                        <p class="m-0">Tired of hidden mark-ups and opaque charges? So are we! That's why we've ditched the traditional brick-and-mortar model and brought our business online. By cutting out unnecessary overheads, we ensure that you get the fairest prices without compromising on quality.</p>
                        <hr class="my-4">
                        <div class="d-inline-block mb-2"><h5>Made-to-Order Magic</h5></div>
                        <p class="m-0">Say goodbye to one-size-fits-all jewellery! Unlike traditional jewellers who push their existing inventory onto customers, we believe in personalized perfection. With our made-to-order model, we offer free customization services, so you can create a piece that's uniquely yours, down to the smallest detail.</p>
                        <hr class="my-4">
                        <div class="d-inline-block mb-2"><h5>Hallmarked and Certified</h5></div>
                        <p class="m-0">Your trust means everything to us. That's why every piece of jewelry from Diamond Sutra is hallmarked and certified, guaranteeing the authenticity and quality of our diamonds.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <h3 class="mb-4">At Diamond Sutra we're not just selling jewelry</h3>
        <p>We're crafting experiences. Join us in our mission to bring transparency, customization, and authenticity back to the world of diamond jewelry. Because when you shop with us, you're not just buying a piece of jewelry; you're becoming a part of our legacy.</p>
    </div>

    <div class="py-4"></div>

    <!-- <div class="ads-video">
        <div class="video-play">
            <button type="button" class="btn video-btn" data-bs-toggle="modal" data-bs-target="#videoModal">
                <i class="fa-regular fa-circle-play"></i>
            </button>
        </div>
    </div> -->

    <!-- <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row gy-3">
                        <div class="col-sm-6 col-lg-4">
                            <div class="about-card">
                                <h3>01</h3>
                                <h4>Transparent Pricing</h4>
                                <p>Tired of hidden mark-ups and opaque charges? So are we! That's why we've ditched the traditional brick-and-mortar model and brought our business online. By cutting out unnecessary overheads, we ensure that you get the fairest prices without compromising on quality.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="about-card">
                                <h3>02</h3>
                                <h4>Made-to-Order Magic</h4>
                                <p>Say goodbye to one-size-fits-all jewellery! Unlike traditional jewellers who push their existing inventory onto customers, we believe in personalized perfection. With our made-to-order model, we offer free customization services, so you can create a piece that's uniquely yours, down to the smallest detail.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="about-card">
                                <h3>03</h3>
                                <h4>Hallmarked and Certified</h4>
                                <p>Your trust means everything to us. That's why every piece of jewellery from Diamond Sutra is hallmarked and certified, guaranteeing the authenticity and quality of our diamonds.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Ads Video Modal -->
    <!-- <div class="modal fade video-modal" id="videoModal" tabindex="-1" aria-labelledby="videoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                    <div class="embed-responsive">
                        <iframe src="https://www.youtube.com/embed/KkMVPUFrcFY?si=S9qiKL8RHel_w4iy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</main>

@stop
@section('footer')
@stop