@extends('layouts.site')
@section('content')

<main>
    <div class="page-title">
        <div class="container">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
                        <li class="breadcrumb-item"><a href="#">FAQS</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="about-us py-sm-5 py-4">
        <div class="container">
            <div class="row gy-4 align-items-center">
                <div class="col-lg-6">
                    <div class="about-us-left text-center text-lg-start">
                        <img src="{{url('public/assets/img/about-us.jpg')}}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-us-right">
                        <h3 class="mb-4">Welcome to Diamond Sutra where diamonds meet transparency and tradition!</h3>
                        <p>At Diamond Sutra we're not just selling jewellery; we're crafting experiences. Join us in our mission to bring transparency, customization, and authenticity back to the world of diamond jewellery. Because when you shop with us, you're not just buying a piece of jewellery; you're becoming a part of our legacy.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-us py-sm-5 py-4">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="p-2 bg-dark text-white d-inline-block">Transparent Pricing</div>
                    <hr>
                    <p>Tired of hidden mark-ups and opaque charges? So are we! That's why we've ditched the traditional brick-and-mortar model and brought our business online. By cutting out unnecessary overheads, we ensure that you get the fairest prices without compromising on quality.</p>
                </div>
                <div class="col-lg-4">
                    <div class="p-2 bg-dark text-white d-inline-block">Made-to-Order Magic</div>
                    <hr>
                    <p>Say goodbye to one-size-fits-all jewellery! Unlike traditional jewellers who push their existing inventory onto customers, we believe in personalized perfection. With our made-to-order model, we offer free customization services, so you can create a piece that's uniquely yours, down to the smallest detail.</p>
                </div>
                <div class="col-lg-4">
                    <div class="p-2 bg-dark text-white d-inline-block">Hallmarked and Certified</div>
                    <hr>
                    <p>Your trust means everything to us. That's why every piece of jewellery from Diamond Sutra is hallmarked and certified, guaranteeing the authenticity and quality of our diamonds.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="ads-video">
        <div class="video-play">
            <button type="button" class="btn video-btn" data-bs-toggle="modal" data-bs-target="#videoModal">
                <i class="fa-regular fa-circle-play"></i>
            </button>
        </div>
    </div>
    <!-- <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row gy-3">
                        <div class="col-sm-6 col-lg-4">
                            <div class="about-card">
                                <h3>01</h3>
                                <h4>Planing Stage</h4>
                                <p>Proin gravida otom lorem ipsum. Cons terra nika nibh vel veliauctor quis bibendum auctor.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="about-card">
                                <h3>02</h3>
                                <h4>Development</h4>
                                <p>Proin gravida otom lorem ipsum. Cons terra nika nibh vel veliauctor quis bibendum auctor.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="about-card">
                                <h3>03</h3>
                                <h4>Execution</h4>
                                <p>Proin gravida otom lorem ipsum. Cons terra nika nibh vel veliauctor quis bibendum auctor.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="about-card">
                                <h3>04</h3>
                                <h4>Arthur Wells</h4>
                                <p>Proin gravida otom lorem ipsum. Cons terra nika nibh vel veliauctor quis bibendum auctor.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="about-card">
                                <h3>05</h3>
                                <h4>Karen Franklin</h4>
                                <p>Proin gravida otom lorem ipsum. Cons terra nika nibh vel veliauctor quis bibendum auctor.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="about-card">
                                <h3>06</h3>
                                <h4>Daniel Jenkins</h4>
                                <p>Proin gravida otom lorem ipsum. Cons terra nika nibh vel veliauctor quis bibendum auctor.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Ads Video Modal -->
    <div class="modal fade video-modal" id="videoModal" tabindex="-1" aria-labelledby="videoModal" aria-hidden="true">
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
    </div>
</main>

@stop
@section('footer')
@stop