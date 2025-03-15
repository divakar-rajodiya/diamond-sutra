@extends('layouts.site')
@section('content')

<style>
    .instagram-img img,
    .instagram-img video {
        height: 380px;
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
<main>
    <div class="page-title mb-3">
        <div class="page-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
   
    <div class="container pt-4">
        <div class="row d-flex align-items-end mb-3">
            <div class="col-lg-4 col-md-4 col-12 mb-2">
                <label for="from_date">Order ID</label>
                <input class="date form-control bg-transparent" id="order_id" name="order_id" type="text" placeholder="Enter Order ID">
            </div>
            <div class="col-lg-4 col-md-4 col-12 mb-2">
                <label for="user_order_status">Order Status</label>
                <select class="form-select bg-transparent" name="user_order_status" id="user_order_status">
                    <option value="">All</option>
                    <option value="0">Order Received</option>
                    <option value="1">Getting It Ready</option>
                    <option value="2">Shipped</option>
                    <option value="3">Delivered</option>
                    <option value="4">Cancelled</option>
                    <option value="5">Initiated Return</option>
                    <option value="6">Returned</option>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-12 mb-2">
                <button type="button" id="upload-csv-btn" title="Orders Filter" class="add-cart-btn" onclick="submitData();"><i class="fa fa-filter" aria-hidden="true"></i></button>
                <button type="button" id="upload-csv-btn" title="Reset Filter" class="add-cart-btn" onclick="clearSearch();"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="wishlist-wrapper">
                <div class="table-responsive" id="order-table">
                </div>
                <nav aria-label="..." class="py-3">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
                <!-- <div class="share-product">
                        <h4 class="mb-0">Share on:</h4>
                        <ul class="share-social-media">
                            <li class="share-button">
                                <a target="_blank" class="facebook" href="#" title="Facebook"> <i class="fa-brands fa-facebook"></i> </a>
                            </li>

                            <li class="share-button">
                                <a target="_blank" class="twitter" href="#" title="Twitter"> <i class="fa-brands fa-twitter"></i> </a>
                            </li>

                            <li class="share-button">
                                <a target="_blank" class="pinterest" href="#"> <i class="fa-brands fa-pinterest"></i> </a>
                            </li>

                            <li class="share-button">
                                <a class="email" href="#" title="Email"> <i class="fa-regular fa-envelope"></i> </a>
                            </li>

                            <li class="share-button">
                                <a class="whatsapp" href="https://wa.me/+917990361072?text=https://dev.diamondsutra.in/" data-action="share/whatsapp/share" target="_blank" title="WhatsApp"> <i class="fa-brands fa-whatsapp"></i> </a>
                            </li>
                        </ul>
                    </div> -->

            </div>
        </div>
    </div>
    <!-- <section class="instagram-section wow fadeInUp overflow-hidden py-4 py-md-5 animated" style="visibility: visible; animation-name: fadeInUp;">
        <h1 class="text-center mb-4 mb-md-5">Follow Our Instagram</h1>
        <div class="row">
            <div class="col-4 col-sm-4 col-md-2 px-0">
                <div class="instagram-img">
                    <img src="{{url('public/assets/img/insta-1.png')}}" alt="img" class="img-fluid">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-2 px-0">
                <div class="instagram-img">
                    <img src="{{url('public/assets/img/insta-2.png')}}" alt="img" class="img-fluid">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-2 px-0">
                <div class="instagram-img">
                    <img src="{{url('public/assets/img/insta-3.png')}}" alt="img" class="img-fluid">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-2 px-0">
                <div class="instagram-img">
                    <img src="{{url('public/assets/img/insta-4.png')}}" alt="img" class="img-fluid">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-2 px-0">
                <div class="instagram-img">
                    <img src="{{url('public/assets/img/insta-5.png')}}" alt="img" class="img-fluid">
                </div>
            </div>
            <div class="col-4 col-sm-4 col-md-2 px-0">
                <div class="instagram-img">
                    <img src="{{url('public/assets/img/insta-1.png')}}" alt="img" class="img-fluid">
                </div>
            </div>
        </div>
    </section> -->
    @if(isset($body['contents']))
    <section class="instagram-section wow fadeInUp overflow-hidden py-4" style="visibility: visible; animation-name: fadeInUp;">
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
</main>
@stop

@section('footer')
<script>
    var OrderUrl = `{{url('user/orders-list')}}`;
    filters.itemPerPage = 5;
    filterData(OrderUrl, "order-table");

    function submitData(){
        filters.order_id = $('#order_id').val();
        filters.user_order_status = $('#user_order_status').val();
        filterData(OrderUrl, "order-table");
    }
    function clearSearch(){

        $('#order_id').val('');
        $('#user_order_status option[value=""]').attr("selected", "selected");
        filters.order_id = '';
        filters.user_order_status = '';

        filterData(OrderUrl, "order-table");
    }
</script>
@stop