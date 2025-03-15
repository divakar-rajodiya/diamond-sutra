@extends('layouts.site')

@section('header')
<style>

        .thank-thumb {
            width: 150px;
        }

        .order-product-table .product-detail {
            width: max-content;
        }

        .order-product-table .product-img img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .thank-you-img{
            animation: thank-you-img infinite ease-in-out alternate 1s;
            width:100%;
        }

        @keyframes thank-you-img {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }

        @media (max-width: 576px) {
            .thank-thumb {
                width: 100px;
            }
        }
    </style>
@stop

@section('content')
@php
$order = $body['orderDetail'];
@endphp


<main>
    <div>
        <div class="container-fluid py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xxl-8">
                    <div class="order-success-wrapper">
                        
                        <h1 class="text-center text-uppercase section-title">Thank You</h1>
                        <h2 class="text-center">Your Order <a href="{{url('user/order-detail').'/'.$order['order_id']}}">#{{$order['order_id']}}</a> is confirmed</h2>
                        <div class="mb-4 mb-md-5 text-center mt-4">
                            <h4>Order Total {{count($order['order_detail'])}} Items: {{\General::currency_format($order['order_total'])}}</h4>
                           
                        </div>
                        <center><p class="mb-4"><a href="{{url('user/order-detail').'/'.$order['order_id']}}" class="btn btn-dark">View Order Details</a></p></center>
                        <div class="mb-4">
                           
                        </div>
                        
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="ship-detail text-start">
                                            <h5 class="fw-bold mb-3 text-capitalize">Shipping details</h5>
                                            <p class="mb-1"><span class="fw-bold">Custome Name:{{$order['shipping_address']['first_name'].' '.$order['shipping_address']['last_name']}}</span></p>
                                            <p class="mb-1"><span class="fw-bold">Address:</span>{{ $order['shipping_address']['address'] }},{{ $order['shipping_address']['city'] }},{{ $order['shipping_address']['state'] }},{{ $order['shipping_address']['pincode'] }}</p>
                                            <p class="mb-1"><span class="fw-bold">Phone:</span>{{ $order['shipping_address']['mobile_no'] }}</p>
                                            <p><span class="fw-bold">Email:</span>{{ $order['shipping_address']['email'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body py-4 bg-light d-flex flex-column text-left">
                                        <p class="fw-bold text-capitalize mb-3">Need Help? Call Our Customer Service</p>
                                        <h6 class="fw-bold"><a href="tel:9799975281"><i class="fa-sharp fa-solid fa-phone"></i> +91 9799975281</a></h6>
                                        <h6 class="fw-bold"><a target="_blank" href="https://api.whatsapp.com/send?phone=919799975281&amp;text=Hi! Need information on the product | https://diamondsutra.in" class="text-black"><i class="fa-brands fa-whatsapp"></i>&nbsp;&nbsp; WhatsApp</a></h6>
                                        <h6 class="fw-bold"><a href="mailto:info@diamondsutra.in" class="text-dark"><i class="fa-solid fa-envelope"></i>&nbsp; info@diamondsutra.in</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@stop
@section('footer')

@stop