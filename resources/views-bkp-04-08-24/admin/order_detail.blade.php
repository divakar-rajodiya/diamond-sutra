@extends('layouts.admin')

@section('header')
<style>
    .rating {
        unicode-bidi: bidi-override;
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
@stop
@section('content')

@php
$orderDetail = $body['orderDetail'];
@endphp



<div class="layout-sidenav-content">
    <div class="p-4 p-md-5">

        <div class="row gy-4">
            <div class="col-12">
                <div class="wishlist py-0 position-sticky start-0 top-0">
                    <div class="wishlist-wrapper table-responsive">
                        <table class=" order-detail-table w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>image</th>
                                    <th>sku</th>
                                    <th>Color</th>
                                    <th>Gold</th>
                                    <th>Gold Weight</th>
                                    @if($orderDetail['product_size'] != '')
                                    <th>size</th>
                                    @endif
                                    @if($orderDetail['order_type'] == 'preset')
                                    <th>solitaire</th>
                                    @endif
                                    <th>price</th>
                                    <th>qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="order-id">
                                        #{{$orderDetail['order_id']}}
                                    </td>
                                    <td class="product-thumbnail">
                                        <img src="{{url('public/assets/img/product/').'/'.$orderDetail['product_sku'].'/'.$orderDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$orderDetail['product_color']).'1.jpg'}}" class="img-fluid" alt="{{$orderDetail['product_sku']}}" width="100px">
                                    </td>
                                    <td class="product-name">{{$orderDetail['product_sku']}}</td>
                                    <td class="product-color">{{$orderDetail['product_color']}}</td>
                                    <td class="product-color" style="">{{$orderDetail['product_gold_quality']}} K</td>
                                    <td class="product-gold-weight">{{$orderDetail['product_gold_weight']}} gm</td>
                                    @if($orderDetail['product_size'] != '')
                                    <td class="product-size">{{$orderDetail['product_size']}}</td>
                                    @endif
                                    @if($orderDetail['order_type'] == 'preset')
                                    <td>{{config('constant.'.$orderDetail['solitaire_preset_quality'])}} / {{$orderDetail['solitaire_preset_carat']}} / Qty : {{$orderDetail['solitaire_preset_qty']}} </td>
                                    @endif
                                    @if($orderDetail['is_chain'] == 1)
                                        @php $chainDetail = json_decode($orderDetail['chain'],true);
                                        $chainPrice = $chainDetail['selected_buy_price']; @endphp
                                        <td class="product-price">{{\General::currency_format($orderDetail['product_final_amount']- $orderDetail['product_gst_amount']-$chainPrice)}}</td>
                                    @elseif(isset($orderDetail['solitaire']))
                                        @php
                                        $solitaire = json_decode($orderDetail['solitaire'],true);
                                        if($orderDetail['product_info']['category_id'] == 1 || $orderDetail['product_info']['category_id'] == 4){
                                            $solitairePrice = $solitaire['Price'];
                                        } else {
                                            $solitairePrice = $solitaire['total_price'];
                                        }
                                        @endphp
                                        <td class="product-price">{{\General::currency_format($orderDetail['product_final_amount'] - $orderDetail['product_gst_amount'] - $solitairePrice)}}</td>
                                    @else
                                    <td class="product-price">{{\General::currency_format($orderDetail['product_final_amount']- $orderDetail['product_gst_amount'])}}</td>
                                    @endif
                                    <td class="product-qut">1</td>
                                </tr>

                                @if($orderDetail['is_chain'] == 1)
                                @php $chainDetail = json_decode($orderDetail['chain'],true);

                                $SKU = $chainDetail['product_sku'];
                                $COLOR = $chainDetail['selected_color'];

                                @endphp
                                <tr>
                                    <th style="padding: 10px;background-color: #e5e5e5;" colspan="8">
                                        <p style="font-size: 18px; font-weight: bold;color: #000;margin: 0;">Chain</p>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="order-id">
                                        #{{$orderDetail['order_id']}}
                                    </td>
                                    <td class="product-thumbnail">
                                        <img src="{{url('public/assets/img/product/').'/'.$chainDetail['product_sku'].'/'.$chainDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$chainDetail['selected_color']).'1.jpg'}}" class="img-fluid" alt="" width="100px">
                                    </td>

                                    <td class="product-name" style=""><a target="_blank" href="{{url('product-detail?product='.$SKU.'&col='.$COLOR.'')}}">{{$chainDetail['product_sku']}}</a></td>
                                    <td class="product-color" style="">{{$chainDetail['selected_color']}}</td>
                                    <td class="product-color" style="">{{$chainDetail['selected_gold_carat']}} K</td>
                                    <td class="product-color" style="">{{$chainDetail['selected_gold_weight']}} gm</td>
                                    <td class="product-price">{{\General::currency_format($chainDetail['selected_buy_price'])}}</td>
                                    <td class="product-qut" style="">1</td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="order-detail-od">
                    <div class="row g-3">
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
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="ship-detail">
                                        <h5 class="fw-bold mb-3 text-capitalize">Billing details</h5>
                                        <p class="fw-bold"><i class="fa fa-user" aria-hidden="true"></i> {{$orderDetail['billing_address']['first_name'].' '.$orderDetail['billing_address']['last_name']}}</p>
                                        <p class="mb-1"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$orderDetail['billing_address']['address']}}, {{$orderDetail['billing_address']['landmark']}} <br> {{$orderDetail['billing_address']['city']}}, {{$orderDetail['billing_address']['state']}}, {{$orderDetail['billing_address']['country']}}, {{$orderDetail['billing_address']['pincode']}} </p>
                                        <p class="mb-1"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$orderDetail['billing_address']['mobile_no']}}">{{$orderDetail['billing_address']['mobile_no']}}</a></p>
                                        <p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$orderDetail['billing_address']['email']}}">{{$orderDetail['billing_address']['email']}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="ship-detail">
                                        <h5 class="fw-bold mb-3 text-capitalize">Shipping details</h5>
                                        <p class="fw-bold"><i class="fa fa-user" aria-hidden="true"></i> {{$orderDetail['shipping_address']['first_name'].' '.$orderDetail['shipping_address']['last_name']}}</p>
                                        <p class="mb-1"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$orderDetail['shipping_address']['address']}}, {{$orderDetail['shipping_address']['landmark']}} <br> {{$orderDetail['shipping_address']['city']}}, {{$orderDetail['shipping_address']['state']}}, {{$orderDetail['shipping_address']['country']}}, {{$orderDetail['shipping_address']['pincode']}} </p>
                                        <p class="mb-1"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$orderDetail['shipping_address']['mobile_no']}}">{{$orderDetail['shipping_address']['mobile_no']}}</a></p>
                                        <p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$orderDetail['shipping_address']['email']}}">{{$orderDetail['shipping_address']['email']}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-4">Summary</h5>
                                    <div>
                                        @if(isset($orderDetail['product_diamond_price']) && $orderDetail['product_diamond_price'] > 0)
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-body fw-semibold">Diamond Price :</span>
                                            <span class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_diamond_price'])}}</span>
                                        </div>
                                        @endif
                                        @if($orderDetail['order_type'] == 'preset')
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-body fw-semibold">Solitaire Price :</span>
                                            <span class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_solitaire_price'])}}</span>
                                        </div>
                                        @endif
                                        @if(isset($orderDetail['solitaire']))
                                        @php
                                        $solitaire = json_decode($orderDetail['solitaire'],true);
                                        @endphp
                                        @if($orderDetail['product_info']['category_id'] == 1 || $orderDetail['product_info']['category_id'] == 4)
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-body fw-semibold">Solitaire Price :</span>
                                            <span class="text-body-emphasis fw-semibold">{{\General::currency_format($solitaire['Price'])}}</span>
                                        </div>
                                        @else
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-body fw-semibold">Solitaire Price :</span>
                                            <span class="text-body-emphasis fw-semibold">{{\General::currency_format($solitaire['total_price'])}}</span>
                                        </div>
                                        @endif
                                        @endif
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-body fw-semibold">Gold Price :</span>
                                            <span class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_gold_price'])}}</span>
                                        </div>
                                        @if($orderDetail['is_chain'] == 1)
                                        @php $chainDetail = json_decode($orderDetail['chain'],true);
                                        $chainPrice = $chainDetail['selected_buy_price']; @endphp
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-body fw-semibold">Chain Price :</span>
                                            <span class="text-body-emphasis fw-semibold">{{\General::currency_format($chainPrice)}}</span>
                                        </div>
                                        @endif
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-body fw-semibold">Making Charges :</span>
                                            <span class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_making_charges'])}}</span>
                                        </div>
                                        @if($orderDetail['coupon_code'] != null)
                                        <div class="d-flex justify-content-between mb-2">
                                            <p class="text-body fw-semibold">Coupon Code ({{$orderDetail['coupon_code']}}):</p>
                                            <p class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['discount_amount'])}}</p>
                                        </div>
                                        @endif
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-body fw-semibold">GST :</span>
                                            <span class="text-body-emphasis fw-semibold">{{\General::currency_format($orderDetail['product_gst_amount'])}}</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between border-top border-translucent border-dashed pt-2">
                                        <h5 class="fw-bold mb-0">Total :</h5>
                                        <h5 class="fw-bold mb-0">{{\General::currency_format($orderDetail['product_final_amount'])}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-2">Order Status</h6>
                                        <p class="mb-3">{{config('constant.ORDER_STATUS.'.$orderDetail['order_status'])}}</p>
                                        <h6 class="fw-bold mb-2">Payment status</h6>
                                        <p>
                                            @if($orderDetail['payment_status'] == 0)
                                            Pending
                                            @elseif($orderDetail['payment_status'] == 1)
                                            Success
                                            @elseif($orderDetail['payment_status'] == 2)
                                            Failed
                                            @endif
                                        </p>
                                        @if($orderDetail['cancel_reason'] != null)
                                        <h6 class="fw-bold mb-2">Cancel Order Reason</h6>
                                        <p>{{ $orderDetail['cancel_reason'] }}</p>
                                        @endif
                                        @if($orderDetail['return_reason'] != null)
                                        <h6 class="fw-bold mb-2">Return Order Reason</h6>
                                        <p>{{ $orderDetail['return_reason'] }}</p>
                                        @endif
                                    </div>
                                    <!-- <div class="mb-2">
                                            <button class="btn primary-btn w-100">print invoice</button>
                                        </div> -->
                                    <!-- <div>
                                            <button class="btn primary-btn w-100">cancel order</button>
                                        </div> -->
                                    <!-- <div class="mb-2">
                                            <button type="button" class="btn primary-btn w-100" data-bs-toggle="modal" data-bs-target="#writeReview">Write
                                                A Review</button>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    @stop
    @section('footer')
    @stop