@extends('layouts.site')
@section('header')
<style>
    .rating {
        unicode-bidi: bidi-override;
        display: flex;
        justify-content: end;
        direction: rtl;
    }

    .rating>input {
        display: none;
    }

    .rating>label:before {
        content: "\2605";
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
    }

    .rating>label {
        display: inline-block;
        margin-right: 10px;
    }

    .rating>input:checked~label:before,
    .rating>input:checked~label~label:before {
        color: #ffcc00;
    }

    .item-image-block .img-thumbnail {
        border: 0;
        width: 150px;
    }

    .item-price-info-block {
        text-align: right;
        font-weight: 600;
        font-size: 18px;

    }

    .item-attr-table {
        margin-bottom: 5px;
    }

    .item-attr-table tr td {
        font-size: 14px;
        padding: 5px 10px;
        font-weight: 600;
    }

    .item-attr-table tr:last-child td {
        border: 0;
    }

    .item-attr-table tr td:first-child {
        background-color: #f6f6f6;
    }

    .item-attr-table select {
        width: 50px;
        border: 0;
    }

    .item-attr-table select:hover {
        cursor: pointer;
    }

    .remove-item-btn {
        padding-left: 0px;
        font-weight: 500;
    }

    .item-button-block {
        display: flex;
        margin-top: 5px;
        margin-bottom: 5px;
        flex-wrap: wrap;
        justify-content: flex-start;
        column-gap: 15px;
    }

    @media only screen and (max-width: 768px) {
        .item-button-block {
            flex-direction: column;
            align-content: space-around;
        }

        .item-price-info-block {
            text-align: left;
            font-size: 16px;
        }
    }

    .browse-chain-btn {
        border: 1px solid;
    }

    .browse-chain-btn:hover {
        background-color: #000;
        color: #fff;
    }

    .item-summary-block {
        display: flex;
        -webkit-box-pack: justify;
        padding-top: 7px;
        justify-content: space-between;
        padding-bottom: 7px;
        border-bottom: 1px dotted;
    }

    .item-summary-block span:last-child {
        font-weight: 700;
    }

    .item-contact-block {
        margin-top: 10px;
    }

    .cart-summart-block-main {
        position: -webkit-sticky;
        position: sticky;
        top: 120px;
        height: fit-content;
    }

    .bill-detail h5,
    .ship-detail h5 {
        font-size: 18px;
    }

    .bill-detail {
        border-bottom: 1px dotted;
        padding-bottom: 10px;
        margin-bottom: 10px;
        margin-top: 20px;
    }

    /* Start Rating Start*/
    .rating {
        unicode-bidi: bidi-override;
        display: flex;
        justify-content: end;
        direction: rtl;
    }

    .rating>input {
        display: none;
    }

    .rating>label:before {
        content: "\2605";
        font-size: 30px;
        color: #ccc;
        cursor: pointer;
    }

    .rating>label {
        display: inline-block;
        margin-right: 10px;
    }

    .rating>input:checked~label:before,
    .rating>input:checked~label~label:before {
        color: #ffcc00;
    }

    /* Start Rating End*/

    /* Price Breakup start */
    .popover-content {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 90%;
        z-index: 1000;
        transform: translateY(10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .popover-content p{
        font-size: 14px;
        font-weight: 500;
    }

    .popover-content p span{
        display: inline-block;
        min-width: 110px;
        font-weight: 400;
    }


    .popover-content.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .popover-content::before {
        content: '';
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 0 10px 10px 10px;
        border-style: solid;
        border-color: transparent transparent #fff transparent;
        z-index: -1;
    }

    .popover-content::after {
        content: '';
        position: absolute;
        top: -11px;
        left: 50%;
        transform: translateX(-50%);
        border-width: 0 11px 11px 11px;
        border-style: solid;
        border-color: transparent transparent #ccc transparent;
        z-index: -2;
    }

    /* Price Breakup end */
</style>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
@stop
@section('content')

@php
$order = $body['orderData'];
@endphp
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<main>
    <div class="page-title mb-3">
        <div class="page-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5">
            <div class="col-12 col-sm-7 col-md-8 col-lg-8 mb-3">
                <h5>ORDERED ITEMS</h5>

                @foreach($order['order_detail'] as $orderDetail)
                @if($orderDetail['product_sku'] != null)

                <div class="cart-item shadow p-2 mb-3">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="item-image-block text-center">
                                <img src="{{url('public/assets/img/product/').'/'.$orderDetail['product_sku'].'/'.$orderDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$orderDetail['product_color']).'1.webp'}}" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                            <div class="item-title-block">
                                <div class="row pt-2 pb-2">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-title-info-block">
                                            <h5>{{$orderDetail['product_sku']}}</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-price-info-block">
                                            {{\General::currency_format($orderDetail['product_buy_price'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="item-attribute-block">
                                    <table class="table table-hover item-attr-table">
                                        <tr>
                                            <td width="30%">Quantity </td>
                                            <td>{{$orderDetail['quantity']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Metal</td>
                                            <!-- <td>18KT Rose Gold, 3.06 gram</td> -->
                                            <td>{{$orderDetail['product_gold_quality']}}KT {{$orderDetail['product_color']}} gold, {{$orderDetail['product_gold_weight']}} gm</td>
                                        </tr>
                                        @if($orderDetail['product_diamond_price'] > 0)
                                        @php
                                        $diamondDetail = json_decode($orderDetail['product_info']['diamond'], true);
                                        $diamondDetail = $diamondDetail[0];
                                        @endphp
                                        <tr>
                                            <td width="30%">Diamond</td>
                                            <td>{{$diamondDetail['quantity']}} Diamond, {{$diamondDetail['carat']}} Carat, {{ config('constant.'.$orderDetail['product_diamond_quality']) }}</td>
                                        </tr>
                                        @endif
                                        @if($orderDetail['product_size'] != null)
                                        <tr>
                                            <td width="30%">Size</td>
                                            <td>{{ $orderDetail['product_size'] }}</td>
                                        </tr>
                                        @endif

                                        @if($orderDetail['solitaire_preset_qty'] > 0)
                                        <tr>
                                            <th>Solitaire Details
                                            <th>
                                        </tr>
                                        <tr>
                                            <td width="30%">Shape</td>
                                            <td>Round</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Carat</td>
                                            <td>{{$orderDetail['solitaire_preset_carat']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Quality</td>
                                            <td>{{ config('constant.'.$orderDetail['solitaire_preset_quality']) }}</td>
                                        </tr>
                                        @endif

                                        @if($orderDetail['product_stone_price'] > 0)
                                        @php
                                        $stoneDetail = json_decode($orderDetail['product_info']['stone'], true);
                                        $stoneDetail = $stoneDetail[0];
                                        @endphp
                                        <tr>
                                            <th>Stone Details</th>
                                        </tr>
                                        <tr>
                                            <td width="30%">Type</td>
                                            <td>{{$stoneDetail['type']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Shape</td>
                                            <td>{{$stoneDetail['shape']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Color</td>
                                            <td>{{$stoneDetail['color']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Carat</td>
                                            <td>{{$stoneDetail['carat']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Quantity</td>
                                            <td>{{ $stoneDetail['quantity'] }}</td>
                                        </tr>
                                        @endif

                                    </table>
                                </div>
                                <div class="item-button-block">
                                    <button type="button" class="btn"> 
                                    @if($orderDetail['dispatch_status'] == -1)
                                    <span class="text-danger fw-bold"> cancelled </span>
                                    @elseif($orderDetail['dispatch_status'] == 0)
                                    <span class="fw-bold text-success"> Order Placed </span>
                                    @elseif($orderDetail['dispatch_status'] == 1)
                                    <span class="fw-bold text-warning"> Getting Ready </span>
                                    @elseif($orderDetail['dispatch_status'] == 2)
                                    <span class="fw-bold text-warning"> Shipped </span>
                                    @elseif($orderDetail['dispatch_status'] == 3)
                                    <i class="fa-solid fa-truck-fast"></i><span class="fw-bold text-sucecss"> Delivered </span>
                                    @elseif($orderDetail['dispatch_status'] == 4)
                                    <span class="text-danger fw-bold"> Return Initiated </span>
                                    @elseif($orderDetail['dispatch_status'] == 4)
                                    <span class="text-success fw-bold"> Return Processed </span>
                                    @endif
                                    </button>
                                    @if($orderDetail['review'] == null)
                                    <button type="button" class="btn" data-bs-toggle="modal" data-order-id="{{$orderDetail['id']}}" data-bs-target="#writeReview"><i class="fa-solid fa-user-pen"></i> Write a Review </button>
                                    @endif
                                   {{-- <button type="button" class="btn popover-button">Price Breakup <i class="fa fa-info-circle" aria-hidden="true"></i></button>
                                    <div id="popoverContent" class="popover-content">
                                        <p><span>Gold :</span> {{\General::currency_format($orderDetail['product_gold_price'])}} </p>
                                        <p><span>GST :</span> {{\General::currency_format($orderDetail['product_gst_amount'])}} </p>
                                        @if($orderDetail['product_making_charges'] > 0)
                                        <p><span>Making Charge :</span> {{\General::currency_format($orderDetail['product_making_charges'])}} </p>
                                        @endif
                                        @if($orderDetail['product_diamond_price'] > 0)
                                        <p><span>Diamond :</span> {{\General::currency_format($orderDetail['product_diamond_price'])}} </p>
                                        @endif
                                        @if($orderDetail['preset_solitaire_price'] > 0)
                                        <p><span>Solitaire :</span> {{\General::currency_format($orderDetail['preset_solitaire_price'])}} </p>
                                        @endif
                                        @if($orderDetail['product_stone_price'] > 0)
                                        <p><span>Stone :</span> {{\General::currency_format($orderDetail['product_stone_price'])}} </p>
                                        @endif
                                    </div> --}}
                                    @if($orderDetail['product_type'] == 0)
                                    @if($orderDetail['dispatch_status'] == 0 || $orderDetail['dispatch_status'] == 1)
                                    <button type="button" class="btn" onclick="cancelOrder(`{{$order['order_id']}}`,`{{$orderDetail['id']}}`)"><i class="fa-regular fa-circle-xmark"></i> Cancel Item</button>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @elseif($orderDetail['solitaire_cert_no'] != null)
                @php
                $solitaireDetail = json_decode($orderDetail['solitaire'],true);
                @endphp
                <div class="cart-item shadow p-2 mb-3">
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                            <div class="item-image-block text-center">
                                <img src="{{$solitaireDetail['ImageLink']}}" class="img-thumbnail">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
                            <div class="item-title-block">
                                <div class="row pt-2 pb-2">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-title-info-block">
                                            <h5>{{$solitaireDetail['Weight']}} Carat {{$solitaireDetail['DisplayShape']}} Diamond</h5>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="item-price-info-block">
                                            {{\General::currency_format($orderDetail['product_buy_price'])}}
                                        </div>
                                    </div>
                                </div>
                                <div class="item-attribute-block">
                                    <table class="table table-hover item-attr-table">
                                        <tr>
                                            <td width="30%">Shape </td>
                                            <td>{{$solitaireDetail['DisplayShape']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Carat</td>
                                            <td>{{$solitaireDetail['Weight']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Clarity</td>
                                            <td>{{$solitaireDetail['Clarity']}}</td>
                                        </tr>
                                        <tr>
                                            <td width="30%">Color</td>
                                            <td>{{$solitaireDetail['Color']}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="item-button-block">
                                <button type="button" class="btn"> 
                                    @if($orderDetail['dispatch_status'] == -1)
                                    <span class="text-danger fw-bold"> cancelled </span>
                                    @elseif($orderDetail['dispatch_status'] == 0)
                                    <span class="fw-bold text-success"> Order Placed </span>
                                    @elseif($orderDetail['dispatch_status'] == 1)
                                    <span class="fw-bold text-warning"> Getting Ready </span>
                                    @elseif($orderDetail['dispatch_status'] == 2)
                                    <span class="fw-bold text-warning"> Shipped </span>
                                    @elseif($orderDetail['dispatch_status'] == 3)
                                    <i class="fa-solid fa-truck-fast"></i><span class="fw-bold text-sucecss"> Delivered </span>
                                    @elseif($orderDetail['dispatch_status'] == 4)
                                    <span class="text-danger fw-bold"> Return Initiated </span>
                                    @elseif($orderDetail['dispatch_status'] == 4)
                                    <span class="text-success fw-bold"> Return Processed </span>
                                    @endif
                                    </button>
                                    <!-- <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#writeReview"><i class="fa-solid fa-user-pen"></i> Write a Review</button> -->
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach

                <div class="diamondsutra-promises border bg-light py-3 px-4 fs-12">
                    <p class="mb-2 pb-2 d-block text-uppercase fw-bold border-bottom fs-12" style="letter-spacing: 2px;">Diamond Sutra Promises</p>
                    <div class="row">
                        <div class="col-lg-6 col-6 col-12">
                            <ul class="list-unstyled m-0">
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-certificate me-2 text-center" style="width:16px"></i> 100% certified jewelry</li>
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-hand-holding-dollar me-2 text-center" style="width:16px"></i> 15-day refund policy</li>
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-repeat me-2 text-center" style="width:16px"></i> Lifetime Exchange &amp; Buyback</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-6 col-12">
                            <ul class="list-unstyled m-0">
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-truck-fast me-2 text-center" style="width:16px"></i> Free Shipping and Insurance</li>
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-money-bill-wave me-2 text-center" style="width:16px"></i> Transparent Pricing</li>
                                <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-compress me-2 text-center" style="width:16px"></i> Complementary Resizing</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12 col-sm-5 col-md-4 col-lg-4 mb-3">
                <div class="cart-summart-block-main">
                    <h5>ORDER SUMMARY</h5>
                    <div class="item-order-summary shadow p-3">
                        <div class="item-summary-block">
                            <span>Order Id: </span>
                            <span>#{{$order['order_id']}}</span>
                        </div>
                        <div class="item-summary-block">
                            <span>Order Date: </span>
                            <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($orderDetail['created_at']))->format('d M Y') }}</span>
                        </div>
                        <div class="item-summary-block">
                            <span>Expected Delivery Date: </span>
                            <span>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($order['expected_delivery_date']))->format('d M Y') }}</span>
                        </div>
                        <div class="item-summary-block">
                            <span>Total ({{$order['item_quantity']}} Items):</span>
                            <span>{{\General::currency_format($order['item_total'])}}</span>
                        </div>
                        @if($order['discount_total'] > 0)
                        <div class="item-summary-block">
                            <span class="text-success">Discount :</span>
                            <span class="text-success">{{\General::currency_format($order['discount_total'])}}</span>
                        </div>
                        @endif
                        <div class="item-summary-block">
                            <span>Order Total:</span>
                            <span>{{\General::currency_format($order['order_total'])}}</span>
                        </div>
                        <div class="bill-detail">
                            <h5 class="fw-bold mb-3 text-capitalize">Billing details</h5>
                            <p class="fw-bold mb-2"><i class="fa fa-user" aria-hidden="true"></i> {{$order['billing_address']['first_name'].' '.$order['billing_address']['last_name']}}</p>
                            <p class="mb-2"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$order['billing_address']['address']}}, {{$order['billing_address']['landmark']}} <br> {{$order['billing_address']['city']}}, {{$order['billing_address']['state']}}, {{$order['billing_address']['country']}}, {{$order['billing_address']['pincode']}} </p>
                            <p class="mb-2"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$order['billing_address']['mobile_no']}}">{{$order['billing_address']['mobile_no']}}</a></p>
                            <p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$order['billing_address']['email']}}">{{$order['billing_address']['email']}}</a></p>
                        </div>

                        <div class="ship-detail">
                            <h5 class="fw-bold mb-3 text-capitalize">Shipping details</h5>
                            <p class="fw-bold mb-2"><i class="fa fa-user" aria-hidden="true"></i> {{$order['shipping_address']['first_name'].' '.$order['shipping_address']['last_name']}}</p>
                            <p class="mb-2"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$order['shipping_address']['address']}}, {{$order['shipping_address']['landmark']}} <br> {{$order['shipping_address']['city']}}, {{$order['shipping_address']['state']}}, {{$order['shipping_address']['country']}}, {{$order['shipping_address']['pincode']}} </p>
                            <p class="mb-2"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$order['shipping_address']['mobile_no']}}">{{$order['shipping_address']['mobile_no']}}</a></p>
                            <p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$order['shipping_address']['email']}}">{{$order['shipping_address']['email']}}</a></p>
                        </div>
                        <div class="mb-2 mt-2" id="">
                            <a href="{{ asset('download-invoice').'/'.$order['order_id'] }}"><button type="button" class="btn primary-btn w-100">Download Invoice</button></a>
                        </div>
                        @if($order['order_total'] < 200000)
                            @if(in_array($order['order_status'],['0','1']))
                            <div class="mb-2" id="show-review-section">
                            <button type="button" class="btn primary-btn w-100" onclick="cancelOrder(`{{$order['order_id']}}`)">Cancel Order</button>
                    </div>
                    @endif
                    
                    @endif

                    <div class="item-contact-block">
                        <p>Any Questions?</p>
                        <p>Please call us at <b><a href="tel:+919799975281">+91 9799975281</a></b> or Chat with us <a href="https://api.whatsapp.com/send?phone=919799975281&amp;text=Hi! Need information on the product | https://diamondsutra.in" class="fs-4 text-success p-1"><i class="fa-brands fa-whatsapp"></i></a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
    <div class="modal fade" id="writeReview" tabindex="-1" aria-labelledby="writeReviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="writeReviewLabel">Write your Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-3">Select the rating</p>
                    <form action="{{url('/user/add-review')}}" id="review-form" class="faq-form" method="post" enctype="multipart/form-data" onsubmit="return false;">
                        @csrf
                        <div class="form-grop mb-3">
                            <div class="form-floating">
                                <div class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" />
                                    <label for="star5"></label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label for="star4"></label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label for="star3"></label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label for="star2"></label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label for="star1"></label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="order_id" id="order_id" value="{{$order['id']}}">
                        <div class="form-grop mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-transparent" name="title" id="reviewTitle" placeholder="Title" value="">
                                <label for="reviewTitle">Title *</label>
                            </div>
                        </div>
                        <div class="form-grop mb-3">
                            <div class="form-floating">
                                <textarea class="form-control bg-transparent" id="reviewDisc" name="description" placeholder="Description"></textarea>
                                <label for="reviewDisc">Description</label>
                            </div>
                        </div>

                        <div class="form-grop mb-3">
                            <div class="form-floating">
                                <input type="file" class="form-control bg-transparent h-auto ps-4 py-3" id="image1" name="image1" placeholder="Image 1" value="">
                                <!-- <label for="image1">Image 1</label> -->
                            </div>
                        </div>
                        <div class="form-grop mb-3">
                            <div class="form-floating">
                                <input type="file" class="form-control bg-transparent h-auto ps-4 py-3" id="image2" name="image2" placeholder="Image 2" value="">
                                <!-- <label for="image2">Image 2</label> -->
                            </div>
                        </div>
                        <button type="button" id="add_review_btn" class="btn btn-dark w-100 py-2">Submit <span id="review-spinner" style="display:none"><i class="fas fa-spinner fa-spin"></i></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-labelledby="cancelOrderTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cancel Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CloseCancelOrder()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="content-text">Are you want to cancel this order?</p>
                <div class="form-group d-none" id="cancel-reason">
                    <label for="message-text" class="col-form-label">Cancel Reason</label>
                    <textarea class="form-control" name="cancel-reason" id="cancel_reason"></textarea>
                    <span class="text-danger d-none cancel-error">Please Enter Cancel Reason</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn primary-btn" id="cancel-yes">Yes</button>
                <button type="button" class="btn primary-btn d-none" data-order-id="" data-cancel-id="" id="cancel-approve" onclick="OrderCancel()">Yes Cancel <span id="cancel-order-spinner"
                        style="display:none"><i class="fas fa-spinner fa-spin"></i></span></button>
                <button type="button" class="btn primary-btn" onclick="CloseCancelOrder()">No</button>
            </div>
        </div>
    </div>
</div>
<!-- Return Modal -->
<div class="modal fade" id="returnOrder" tabindex="-1" role="dialog" aria-labelledby="returnOrderTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Return Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CloseReturnOrder()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="content-text-return">Do you want to return this order?</p>
                <div class="form-group d-none" id="return-reason">
                    <label for="message-text" class="col-form-label">Return Reason</label>
                    <textarea class="form-control" name="return-reason" id="return_reason"></textarea>
                    <span class="text-danger d-none return-error">Please Enter Return Reason</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn primary-btn" id="return-yes">Yes</button>
                <button type="button" class="btn primary-btn d-none" id="return-approve" onclick="Orderreturn(`{{$order['order_id']}}`)">Yes Return <span id="return-order-spinner"
                        style="display:none"><i class="fas fa-spinner fa-spin"></i></span></button>
                <button type="button" class="btn primary-btn" onclick="CloseReturnOrder()">No</button>
            </div>
        </div>
    </div>
</div>

@stop
@section('footer')
<script>
    $(document).on('click', '.popover-button', function(event) {
        event.stopPropagation(); // Prevent the event from bubbling up
        var popover = $(this).next('.popover-content');
        var rect = this.getBoundingClientRect();
        var top = rect.bottom + window.scrollY;
        var left = rect.left + (rect.width / 2) - (popover.outerWidth() / 2) + window.scrollX;

        popover.css({
            top: top + 'px',
            left: Math.max(10, Math.min(left, $(window).width() - popover.outerWidth() - 10)) + 'px'
        }).toggleClass('show').not(':visible').siblings('.popover-content').removeClass('show');
    });

    $(document).click(function(event) {
        if (!$(event.target).closest('.popover-button, .popover-content').length) {
            $('.popover-content').removeClass('show');
        }
    });

    $(window).resize(function() {
        $('.popover-content').removeClass('show');
    });

    $('#cancel-yes').click(function() {

        $('#cancel-reason').removeClass('d-none');
        $('#cancel-yes').addClass('d-none');
        $('.content-text').addClass('d-none');
        $('#cancel-approve').removeClass('d-none');
    })
    $('#return-yes').click(function() {

        $('#return-reason').removeClass('d-none');
        $('#return-yes').addClass('d-none');
        $('.content-text-return').addClass('d-none');
        $('#return-approve').removeClass('d-none');
    })

    $(document).ready(function() {

        $('#writeReview').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var orderId = button.data('order-id');
            $('#order_id').val(orderId);
        });

        $("#add_review_btn").click(function() {
            // Serialize form data
            var formData = new FormData($('#review-form')[0]);

            // Append star rating value
            var rating = $("input[name='rating']:checked").val();
            if (rating == undefined) rating = '';
            formData.append('rating', rating);

            $('#review-spinner').show();
            $("#add_review_btn").attr("disabled", true);
            // Make AJAX call
            $.ajax({
                url: "{{url('/user/add-review')}}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    // Handle success response
                    Toast(res.msg, 3000, res.flag);
                    console.log(res);
                    $('#review-spinner').hide();
                    $("#add_review_btn").attr("disabled", false);
                    if (res.flag == 1) {
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                        // $('#review-form').trigegr('reset');
                        // $('#show-review-section').hide();
                        // $('#writeReview').modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error
                    $('#review-spinner').hide();
                    $("#add_review_btn").attr("disabled", false);
                    console.error(xhr.responseText);
                }
            });
        });
    });

    function cancelOrder(order_id,cancel_id) {
        $("#cancel-approve").data("order-id",order_id);
        $("#cancel-approve").data("cancel-id",cancel_id);
        $('#cancelOrder').modal('show');
    }

    function OrderCancel() {

        var cancel_id = $("#cancel-approve").data("cancel-id");
        var order_id = $("#cancel-approve").data("order-id");
        var cancel_reason = $('#cancel_reason').val();

        if (cancel_reason.length == 0) {
            $('.cancel-error').removeClass('d-none');
            return false;
        }
        var token = $("#token").val();
        var formData = new FormData();
        formData.append('order_id', order_id);
        formData.append('cancel_id', cancel_id);
        formData.append('cancel-reason', cancel_reason);
        formData.append('_token', token);
        $('#cancel-order-spinner').show();
        $("#cancel-approve").attr("disabled", true);
        $.ajax({
            url: "{{url('/user/cancel-order')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.flag == 1) {
                    $('#cancel-order-spinner').hide();
                    $("#cancel-approve").attr("disabled", false);
                    Toast(res.msg, 3000, res.flag);
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                alert('Sorry! we are not able to cancle item this time, Please Contact on support.');
            }
        });
    }

    function returnOrder(order_id) {

        $('#returnOrder').modal('show');
    }

    function Orderreturn(order_id) {

        var return_reason = $('#return_reason').val();
        if (return_reason.length == 0) {
            $('.return-error').removeClass('d-none');
            return false;
        }
        var token = $("#token").val();
        var formData = new FormData();
        formData.append('order_id', order_id);
        formData.append('return-reason', return_reason);
        formData.append('_token', token);
        // Make AJAX call
        $('#return-order-spinner').show();
        $("#return-approve").attr("disabled", true);
        $.ajax({
            url: "{{url('/user/return-order')}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.flag == 1) {
                    Toast(res.msg, 3000, res.flag);
                    $('#return-order-spinner').hide();
                    $("#return-approve").attr("disabled", false);
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }

            },
            error: function(xhr, status, error) {
                // Handle error
                alert('Something Wrong Please contact to Admin');
                // Swal.fire("Something Wrong Please contact to Admin", "", "info");
            }
        });
    }

    function CloseCancelOrder() {
        $('#cancel_reason').val();
        $('#cancelOrder').modal('hide');
    }

    function CloseReturnOrder() {
        $('#return_reason').val();
        $('#returnOrder').modal('hide');
    }
</script>
@stop