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
</style>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
@stop
@section('content')

@php
$orderDetail = $body['orderDetail'];
@endphp
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<main>
    <div class="page-title mb-3">
        <div class="page-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Order Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div>
        <div class="container py-4">
            <div class="row gy-4">

                <div class="col-12">
                    <div class="wishlist py-0 position-sticky start-0 top-0">
                    <h5 class="fw-bold mb-3 text-capitalize">Product details</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="wishlist-wrapper table-responsive">
                                    <table class="order-detail-table w-100">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">Order ID</th>
                                                <th style="text-align:center">Image</th>
                                                <th style="text-align:center">Name</th>
                                                <th style="text-align:center">Color</th>
                                                @if($orderDetail['product_size'] != '')
                                                <th style="text-align:center">size</th>
                                                @endif
                                                @if($orderDetail['order_type'] == 'preset')
                                                <th style="text-align:center">solitaire</th>
                                                @endif
                                                <th style="text-align:center">Gold</th>
                                                <th style="text-align:center">Gold Weight</th>
                                                <th style="text-align:right">Total Price</th>
                                                <th style="text-align:center">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="order-id" style="text-align:center">
                                                    #{{$orderDetail['order_id']}}
                                                </td>
                                                <td class="product-thumbnail" style="text-align:center">
                                                    <img src="{{url('public/assets/img/product/').'/'.$orderDetail['product_sku'].'/'.$orderDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$orderDetail['product_color']).'1.jpg'}}" class="img-fluid" alt="">
                                                </td>

                                                @php
                                                $p_sku = $orderDetail['product_sku'];
                                                $p_color = $orderDetail['product_color'];
                                                @endphp

                                                <td class="product-name" style="text-align:center"><a target="_blank" href="{{url('product-detail?product='.$p_sku.'&col='.$p_color.'')}}">{{$orderDetail['product_sku']}}</a></td>


                                                <td class="product-color" style="text-align:center;text-transform: capitalize;">{{$orderDetail['product_color']}}</td>
                                                @if($orderDetail['product_size'] != '')
                                                <td class="product-size" style="text-align:center">{{$orderDetail['product_size']}}</td>
                                                @endif
                                                @if($orderDetail['order_type'] == 'preset')
                                                <td style="text-align:center">{{config('constant.'.$orderDetail['solitaire_preset_quality'])}} / {{$orderDetail['solitaire_preset_carat']}} / Qty : {{$orderDetail['solitaire_preset_qty']}} </td>
                                                @endif
                                                <td class="product-gold-quality" style="text-align:center">{{$orderDetail['product_gold_quality']}} K</td>
                                                <td class="product-gold-weight" style="text-align:center">{{$orderDetail['product_gold_weight']}} gm</td>
                                                @if($orderDetail['is_chain'] == 1)
                                                    @php  $chainDetail = json_decode($orderDetail['chain'],true); 
                                                          $chainPrice = $chainDetail['selected_buy_price']; @endphp
                                                    <td class="product-price" style="text-align:right">{{\General::currency_format($orderDetail['product_final_amount'] - $orderDetail['product_gst_amount'] - $chainPrice)}}</td>
                                                @elseif(isset($orderDetail['solitaire']))
                                                    @php
                                                    $solitaire = json_decode($orderDetail['solitaire'],true);
                                                    if($orderDetail['product_info']['category_id'] == 1 || $orderDetail['product_info']['category_id'] == 4){
                                                        $solitairePrice = $solitaire['Price'];
                                                    } else {
                                                        $solitairePrice = $solitaire['total_price'];
                                                    }
                                                    @endphp
                                                    <td class="product-price" style="text-align:right">{{\General::currency_format($orderDetail['product_final_amount'] - $orderDetail['product_gst_amount'] - $solitairePrice)}}</td>
                                                @else
                                                <td class="product-price" style="text-align:right">{{\General::currency_format($orderDetail['product_final_amount'] - $orderDetail['product_gst_amount'])}}</td>
                                                @endif
                                                <td class="product-qut" style="text-align:center">1</td>
                                                

                                            </tr>
                                            @if($orderDetail['is_chain'] == 1)
                                            @php  $chainDetail = json_decode($orderDetail['chain'],true);

                                            $SKU = $chainDetail['product_sku'];
                                            $COLOR = $chainDetail['selected_color'];

                                            @endphp
                                            <tr>
                                                <th style="padding: 10px;background-color: #e5e5e5;" colspan="8"> <p style="font-size: 18px; font-weight: bold;color: #000;margin: 0;">Chain</p></th>
                                            </tr>
                                            <!-- <tr>
                                                <th>Order Id</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Color</th>
                                                <th>Gold</th>
                                                <th>Gold Weight</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                            </tr> -->
                                            <tr>
                                                <td class="order-id" style="text-align:center">
                                                    #{{$orderDetail['order_id']}}
                                                </td>
                                                <td class="product-thumbnail" style="text-align:center">
                                                    <img src="{{url('public/assets/img/product/').'/'.$chainDetail['product_sku'].'/'.$chainDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$chainDetail['selected_color']).'1.jpg'}}" class="img-fluid" alt="">
                                                </td>
                                                <td class="product-name" style="text-align:center"><a target="_blank" href="{{url('product-detail?product='.$SKU.'&col='.$COLOR.'')}}">{{$chainDetail['product_sku']}}</a></td>
                                                <td class="product-color" style="text-align:center">{{$chainDetail['selected_color']}}</td>
                                                <td class="product-color" style="text-align:center">{{$chainDetail['selected_gold_carat']}} K</td>
                                                <td class="product-color" style="text-align:center">{{$chainDetail['selected_gold_weight']}} gm</td>
                                                <td class="product-price" style="text-align:right">{{\General::currency_format($chainDetail['selected_buy_price'])}}</td>
                                                <td class="product-qut" style="text-align:center">1</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($orderDetail['solitaire'] != '')
                    @php
                    $solitaire = json_decode($orderDetail['solitaire'],true);
                    $solitaire1 = null;
                    $solitaire2 = null;
                    if(isset($solitaire['RefNo'])){
                        $solitaire1 = $solitaire;
                    } elseif(isset($solitaire[0]['RefNo'])){
                        $solitaire1 = $solitaire[0];
                        $solitaire2 = $solitaire[1];
                    }
                    @endphp

                    <div class="col-lg-12 col-md-12 col-12">
                        <h5 class="fw-bold mb-3 text-capitalize">solitaire Details</h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="wishlist-wrapper table-responsive">
                                    <table class=" order-detail-table w-100">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center">Image</th>
                                                <th style="text-align:center">Carat</th>
                                                <th style="text-align:center">Color</th>
                                                <th style="text-align:center">Clarity</th>
                                                <th style="text-align:center">Cut</th>
                                                <th style="text-align:right">Price</th>
                                                <th style="text-align:center">Ceritificate</th>
                                                <th style="text-align:center">Ceritificate No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align:center">
                                                    <img class="" src="{{$solitaire1['ImageLink']}}" width="60" height="60">
                                                </td>
                                                <td style="text-align:center">
                                                    {{$solitaire1['Weight']}} Ct
                                                </td>
                                                <td style="text-align:center">
                                                    {{$solitaire1['Color']}}
                                                </td>
                                                <td style="text-align:center">
                                                    {{$solitaire1['Clarity']}}
                                                </td>
                                                <td style="text-align:center">
                                                    {{$solitaire1['DisplayCut']}}
                                                </td>
                                                <td style="text-align:right">
                                                    {{\General::currency_format($solitaire1['Price'])}}
                                                </td>
                                                <td style="text-align:center">
                                                    {{$solitaire1['Cert']}}
                                                </td>
                                                <td style="text-align:center">
                                                    <a style="text-decoration:underline;cursor:pointer;" href="{{$solitaire1['CertLink']}}" target="_blank" rel="noopener noreferrer">{{$solitaire1['CertNo']}}</a>
                                                </td>
                                            </tr>
                                            @if($solitaire2)                  
                                                <tr>
                                                    <td style="text-align:center">
                                                        <img class="" src="{{$solitaire2['ImageLink']}}" width="60" height="60">
                                                    </td>
                                                    <td style="text-align:center">
                                                        {{$solitaire2['Weight']}} Ct
                                                    </td>
                                                    <td style="text-align:center">
                                                        {{$solitaire2['Color']}}
                                                    </td>
                                                    <td style="text-align:center">
                                                        {{$solitaire2['Clarity']}}
                                                    </td>
                                                    <td style="text-align:center">
                                                        {{$solitaire2['DisplayCut']}}
                                                    </td>
                                                    <td style="text-align:right">
                                                        {{\General::currency_format($solitaire2['Price'])}}
                                                    </td>
                                                    <td style="text-align:center">
                                                        {{$solitaire2['Cert']}}
                                                    </td>
                                                    <td style="text-align:center">
                                                        <a style="text-decoration:underline;cursor:pointer;" href="{{$solitaire1['CertLink']}}" target="_blank" rel="noopener noreferrer">{{$solitaire2['CertNo']}}</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                    <div class="order-detail-od">
                        <div class="col-12">
                            <div class="row">
                                <!--Diamond Details  -->
                                @if(isset($orderDetail['product_diamond_quality']) && $orderDetail['product_diamond_quality'] != null)
                                <div class="col-md-4 col-lg-4 col-12 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold mb-4">Diamond Details</h5>
                                            <div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Quality :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{ config('constant.'.$orderDetail['product_diamond_quality']) }}</p>
                                                </div>
                                                @php
                                                $product = \App\Models\Admin\Product::where('product_sku',$orderDetail['product_sku'])->first();
                                                $diamond = json_decode($product->diamond);
                                                @endphp
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Weight :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{ $diamond[0]->carat  }} Ct</p>
                                                </div>

                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Quantity :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{ $diamond[0]->quantity  }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <!-- Summary -->
                                <div class="col-md-{{ ($orderDetail['product_diamond_quality'] != null ? 4 : 6); }} col-lg-{{ ($orderDetail['product_diamond_quality'] != null ? 4 : 6); }} col-12 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold mb-4">Summary</h5>
                                            <div>
                                                @if(isset($orderDetail['product_diamond_price']) && $orderDetail['product_diamond_price'] > 0)
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Diamond Price :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_diamond_price'])}}</p>
                                                </div>
                                                @endif
                                                @if($orderDetail['order_type'] == 'preset')
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Solitaire Price :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_solitaire_price'])}}</p>
                                                </div>
                                                @endif
                                                
                                                @if(isset($orderDetail['solitaire']))
                                                @php
                                                $solitaire = json_decode($orderDetail['solitaire'],true);
                                                if($orderDetail['product_info']['category_id'] == 1 || $orderDetail['product_info']['category_id'] == 4){
                                                    $solitairePrice = $solitaire['Price'];
                                                } else {
                                                    $solitairePrice = $solitaire['total_price'];
                                                }
                                                @endphp
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Solitaire Price :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{\General::currency_format($solitairePrice)}}</p>
                                                </div>
                                                
                                                @endif
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Gold Price :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_gold_price'])}}</p>
                                                </div>
                                                @if($orderDetail['is_chain'] == 1)
                                                    @php  $chainDetail = json_decode($orderDetail['chain'],true); 
                                                          $chainPrice = $chainDetail['selected_buy_price']; @endphp
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Chain Price :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{\General::currency_format($chainPrice)}}</p>
                                                </div>
                                                @endif
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Making Charges :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_making_charges'])}}</p>
                                                </div>
                                                @if($orderDetail['coupon_code'] != null)
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">Coupon Code ({{$orderDetail['coupon_code']}}):</p>
                                                    <p class="text-body-emphasis fw-semibold">- {{\General::currency_format($orderDetail['discount_amount'])}}</p>
                                                </div>
                                                @endif
                                                <div class="d-flex justify-content-between mb-2">
                                                    <p class="text-body fw-semibold">GST :</p>
                                                    <p class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_gst_amount'])}}</p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between border-top border-translucent border-dashed pt-4">
                                                <h5 class="fw-bold mb-0">Total :</h5>
                                                <h5 class="fw-bold mb-0">{{\General::currency_format($orderDetail['product_final_amount'])}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Status -->
                                <div class="col-md-{{ ($orderDetail['product_diamond_quality'] != null ? 4 : 6); }} col-lg-{{ ($orderDetail['product_diamond_quality'] != null ? 4 : 6); }} col-12 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <h6 class="fw-bold mb-2">Order Status</h6>
                                                <p class="mb-3">{{config('constant.ORDER_STATUS.'.$orderDetail['order_status'])}}</p>
                                                <!-- <h6 class="fw-bold mb-2">Payment status</h6>
                                                <p>{{config('constant.PAYMENT_STATUS.'.$orderDetail['order_status'])}}</p> -->
                                            </div>
                                            @if($orderDetail['cancel_reason'] != null)
                                            <div class="mb-4">
                                                <h6 class="fw-bold mb-2">Order Cancel Reason</h6>
                                                <p class="mb-3">{{ $orderDetail['cancel_reason'] }}</p>
                                            </div>
                                            @endif
                                            @if($orderDetail['return_reason'] != null)
                                            <div class="mb-4">
                                                <h6 class="fw-bold mb-2">Order Return Reason</h6>
                                                <p class="mb-3">{{ $orderDetail['return_reason'] }}</p>
                                            </div>
                                            @endif

                                            @if($orderDetail['review'] == '')
                                                @if(\Auth::guard('user')->check())
                                                <div class="mb-2" id="show-review-section">
                                                    <button type="button" class="btn primary-btn w-100" data-bs-toggle="modal" data-bs-target="#writeReview">Write
                                                        A Review</button>
                                                </div>
                                                @endif
                                            @endif

                                            <div class="mb-2" id="show-review-section">
                                                <a href="{{ asset('download-invoice').'/'.$orderDetail['order_id'] }}"><button type="button" class="btn primary-btn w-100">Download Invoice</button></a>
                                            </div>

                                            @if($orderDetail['order_tracking'] != null)
                                            <div class="mb-2">
                                                <a target="_blank" href="{{ $orderDetail['order_tracking'] }}"><button type="button" class="btn primary-btn w-100">Track Your Order</button></a>
                                            </div>
                                            @endif
                                            
                                            @if($orderDetail['product_final_amount'] < 200000)
                                                @if(in_array($orderDetail['order_status'],['0','1']))
                                                    <div class="mb-2" id="show-review-section">
                                                        <button type="button" class="btn primary-btn w-100" onclick="cancelOrder(`{{$orderDetail['order_id']}}`)">Cancel Order</button>
                                                    </div>
                                                @endif
                                            @elseif($orderDetail['order_type'] == 'product')
                                                @if(in_array($orderDetail['order_status'],['0','1']))
                                                    <div class="mb-2" id="show-review-section">
                                                        <button type="button" class="btn primary-btn w-100" onclick="cancelOrder(`{{$orderDetail['order_id']}}`)">Cancel Order</button>
                                                    </div>
                                                @endif
                                            @endif
                                            @if(in_array($orderDetail['order_status'],['3']))
                                                @php
                                                  $current_date = strtotime(date('Y-m-d H:i:s'));
                                                  $delivered_date = strtotime(date('Y-m-d H:i:s', strtotime($orderDetail['updated_at'] . " +14 days")));
                                                  if($current_date > $delivered_date)
                                                  {
                                                    $class="d-none";
                                                  }else{
                                                    $class="";
                                                  }    
                                                @endphp
                                                <div class="mb-2 {{ $class }}" id="show-review-section">
                                                    <button type="button" class="btn primary-btn w-100" onclick="returnOrder(`{{$orderDetail['order_id']}}`)">Initiate Return</button>
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-12 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="ship-detail">
                                                <h5 class="fw-bold mb-3 text-capitalize">Billing details</h5>
                                                <p class="fw-bold"><i class="fa fa-user" aria-hidden="true"></i> {{$orderDetail['billing_address']['first_name'].' '.$orderDetail['billing_address']['last_name']}}</p>
                                                <p class="mb-1"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$orderDetail['billing_address']['address']}}, {{$orderDetail['billing_address']['landmark']}} <br> {{$orderDetail['billing_address']['city']}}, {{$orderDetail['billing_address']['state']}}, {{$orderDetail['billing_address']['country']}}, {{$orderDetail['billing_address']['pincode']}} </p>
                                                <p class="mb-1"><i class="fa fa-phone" aria-hidden="true"></i> {{$orderDetail['billing_address']['mobile_no']}}</p>
                                                <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$orderDetail['billing_address']['email']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-12 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <div class="ship-detail">
                                                <h5 class="fw-bold mb-3 text-capitalize">Shipping details</h5>
                                                <p class="fw-bold"><i class="fa fa-user" aria-hidden="true"></i> {{$orderDetail['shipping_address']['first_name'].' '.$orderDetail['shipping_address']['last_name']}}</p>
                                                <p class="mb-1"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$orderDetail['shipping_address']['address']}}, {{$orderDetail['shipping_address']['landmark']}} <br> {{$orderDetail['shipping_address']['city']}}, {{$orderDetail['shipping_address']['state']}}, {{$orderDetail['shipping_address']['country']}}, {{$orderDetail['shipping_address']['pincode']}} </p>
                                                <p class="mb-1"><i class="fa fa-phone" aria-hidden="true"></i> {{$orderDetail['shipping_address']['mobile_no']}}</p>
                                                <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$orderDetail['shipping_address']['email']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <input type="hidden" name="order_id" id="order_id" value="{{$orderDetail['id']}}">
                        <div class="form-grop mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-transparent" name="title" id="reviewTitle" placeholder="Title" value="">
                                <label for="reviewTitle">Title</label>
                            </div>
                        </div>
                        <div class="form-grop mb-3">
                            <div class="form-floating">
                                <textarea class="form-control bg-transparent" id="reviewDisc" name="description" placeholder="Review Disc"></textarea>
                                <label for="reviewDisc">Review Disc</label>
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
          <button type="button" class="btn primary-btn d-none" id="cancel-approve" onclick="OrderCancel(`{{$orderDetail['order_id']}}`)">Yes Cancel <span id="cancel-order-spinner"
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
          <button type="button" class="btn primary-btn d-none" id="return-approve" onclick="Orderreturn(`{{$orderDetail['order_id']}}`)">Yes Return <span id="return-order-spinner"
            style="display:none"><i class="fas fa-spinner fa-spin"></i></span></button>
          <button type="button" class="btn primary-btn" onclick="CloseReturnOrder()">No</button>
      </div>
    </div>
  </div>
</div>

@stop
@section('footer')
<script>

    $('#cancel-yes').click(function(){

        $('#cancel-reason').removeClass('d-none');
        $('#cancel-yes').addClass('d-none');
        $('.content-text').addClass('d-none');
        $('#cancel-approve').removeClass('d-none');
    })
    $('#return-yes').click(function(){

        $('#return-reason').removeClass('d-none');
        $('#return-yes').addClass('d-none');
        $('.content-text-return').addClass('d-none');
        $('#return-approve').removeClass('d-none');
    })

    $(document).ready(function() {

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
                    // $("#add_review_btn").attr("disabled", false);
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

    function cancelOrder(order_id) {
        $('#cancelOrder').modal('show');
    }
    function OrderCancel(order_id) {

        var cancel_reason = $('#cancel_reason').val();
        if(cancel_reason.length == 0)
        {
            $('.cancel-error').removeClass('d-none');
            return false;
        }
        var token = $("#token").val();
        var formData = new FormData();
        formData.append('order_id', order_id);
        formData.append('cancel-reason', cancel_reason);
        formData.append('_token',token);
        $('#cancel-order-spinner').show();
        $("#cancel-approve").attr("disabled", true);
        $.ajax({
            url: "{{url('/cancel-order')}}",
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
                alert('Something Wrong Please contact to Admin');
            }
        });
    }

    function returnOrder(order_id) {

        $('#returnOrder').modal('show');
    }

    function Orderreturn(order_id)
    {

        var return_reason = $('#return_reason').val();
        if(return_reason.length == 0)
        {
            $('.return-error').removeClass('d-none');
            return false;
        }
        var token = $("#token").val();
        var formData = new FormData();
        formData.append('order_id', order_id);
        formData.append('return-reason', return_reason);
        formData.append('_token',token);
        // Make AJAX call
        $('#return-order-spinner').show();
        $("#return-approve").attr("disabled", true);
        $.ajax({
            url: "{{url('/return-order')}}",
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

    function CloseCancelOrder()
    {
        $('#cancel_reason').val();
        $('#cancelOrder').modal('hide'); 
    }
    function CloseReturnOrder()
    {
        $('#return_reason').val();
        $('#returnOrder').modal('hide'); 
    }
</script>
@stop
