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
$orderDetail = $body['orderDetail'];
@endphp


<main>
    <div>
        <div class="container-fluid py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xxl-8">
                    <div class="order-success-wrapper">
                        
                        <h1 class="text-center text-uppercase section-title">Thank You</h1>
                        <h2 class="text-center">Your Order <a href="{{url('order-detail').'/'.$orderDetail['order_id']}}">#{{$orderDetail['order_id']}}</a> is confirmed</h2>
                        <div class="mb-4 mb-md-5 text-center mt-4">
                            <!-- <p class="mb-2"><span class="fw-bold">OrderId</span> : <span id="order_id">{{$orderDetail['order_id']}}</span></p>
                            <p class="mb-2"><span class="fw-bold">Date</span> : <span>{{  date('Y-m-d',strtotime($orderDetail['created_at'])) }}</span></p>
                            <p class="mb-2"><span class="fw-bold">Total</span> : <span>{{\General::currency_format($orderDetail['product_final_amount'])}}</span></p> -->
                        </div>
                        <center><p class="mb-4"><a href="{{url('order-detail').'/'.$orderDetail['order_id']}}" class="btn btn-dark">View Order Details</a></p></center>
                        <div class="mb-4">
                            <h4 class="fw-bold text-uppercase mb-3">Order Details</h4>
                            <div class="overflow-auto">

                                <table class="w-100 order-product-table border">
                                    <thead class="border">
                                        <tr>
                                            <th class="text-capitalize fw-bold p-2 pb-2" style="text-align:center;">Image</th>
                                            <th class="text-capitalize fw-bold p-2 pb-2" style="text-align:center;">Product</th>
                                            <th class="text-capitalize fw-bold p-2 pb-2" style="text-align:center;">Order Date</th>
                                            <th class="text-capitalize fw-bold p-2 pb-2" style="text-align:right;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-2 py-3" style="text-align:center;">
                                                <img src="{{url('public/assets/img/product/').'/'.$orderDetail['product_sku'].'/'.$orderDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$orderDetail['product_color']).'1.jpg'}}" class="img-fluid" alt="{{$orderDetail['product_sku']}}" style="width: 100px; height:100px;"/>
                                            </td>
                                            <td class="px-2 py-3" style="text-align:center;"><h6>{{$orderDetail['product_sku']}}</h6></td>
                                            <td class="px-2 py-3" style="text-align:center;">{{ date('d-m-Y H:i:s',strtotime($orderDetail['created_at'])) }}</td>
                                            @if($orderDetail['is_chain'] == 1)
                                                @php  $chainDetail = json_decode($orderDetail['chain'],true); 
                                                        $chainPrice = $chainDetail['selected_buy_price']; @endphp
                                                <td class="px-2 py-3" style="text-align:right;">{{\General::currency_format($orderDetail['product_final_amount'] - $chainPrice)}}</td>
                                            @elseif(isset($orderDetail['solitaire']))
                                                @php
                                                $solitaire = json_decode($orderDetail['solitaire'],true);
                                                if($orderDetail['product_info']['category_id'] == 1 || $orderDetail['product_info']['category_id'] == 4){
                                                    $solitairePrice = $solitaire['Price'];
                                                } else {
                                                    $solitairePrice = $solitaire['total_price'];
                                                }
                                                @endphp
                                                <td class="px-2 py-3" style="text-align:right;">{{\General::currency_format($orderDetail['product_final_amount'] - $solitairePrice)}}</td>
                                            @else
                                            <td class="px-2 py-3" style="text-align:right;">{{\General::currency_format($orderDetail['product_final_amount'])}}</td>
                                            @endif
                                            
                                        </tr>
                                        @if($orderDetail['is_chain'] == 1)
                                            @php  $chainDetail = json_decode($orderDetail['chain'],true);
                                            $SKU = $chainDetail['product_sku'];
                                            $COLOR = $chainDetail['selected_color'];

                                            @endphp
                                            <tr>
                                                <td class="px-2 py-3" style="text-align:center;">
                                                    <img src="{{url('public/assets/img/product/').'/'.$chainDetail['product_sku'].'/'.$chainDetail['product_sku'].'_'.config('constant.COLOR_CODE.'.$chainDetail['selected_color']).'1.jpg'}}" class="img-fluid" alt="{{$chainDetail['product_sku']}}" style="width: 100px; height:100px;"/>
                                                </td>
                                                <td class="px-2 py-3" style="text-align:center;"><h6>{{$chainDetail['product_sku']}}</h6></td>
                                                <td class="px-2 py-3" style="text-align:center;">{{ date('d-m-Y H:i:s',strtotime($orderDetail['created_at'])) }}</td>
                                                <td class="px-2 py-3" style="text-align:right;">{{\General::currency_format($chainDetail['selected_buy_price'])}}</td>
                                            </tr>
                                        @endif


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

                                            @if($solitaire1)
                                            <tr>
                                                <td class="px-2 py-3" style="text-align:center;">
                                                    <img src="{{$solitaire1['ImageLink']}}" class="img-fluid" alt="solitaire1" style="width: 100px; height:100px;"/>
                                                </td>
                                                <td class="px-2 py-3" style="text-align:center;"><h6>{{$solitaire1['CertNo']}}</h6></td>
                                                <td class="px-2 py-3" style="text-align:center;">{{ date('d-m-Y H:i:s',strtotime($orderDetail['created_at'])) }}</td>
                                                <td class="px-2 py-3" style="text-align:right;">{{\General::currency_format($solitaire1['Price'])}}</td>
                                            </tr>
                                            @endif
                                            @if($solitaire2)
                                            <tr>
                                                <td class="px-2 py-3" style="text-align:center;">
                                                <img src="{{$solitaire2['ImageLink']}}" class="img-fluid" alt="solitaire1" style="width: 100px; height:100px;"/>
                                                </td>
                                                <td class="px-2 py-3" style="text-align:center;"><h6>{{$solitaire2['CertNo']}}</h6></td>
                                                <td class="px-2 py-3" style="text-align:center;">{{ date('d-m-Y H:i:s',strtotime($orderDetail['created_at'])) }}</td>
                                                <td class="px-2 py-3" style="text-align:right;">{{\General::currency_format($solitaire2['Price'])}}</td>
                                            </tr>
                                            @endif

                                        @endif

                                    </tbody>
                                    <tfoot>
                                        
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="ship-detail text-start">
                                            <h5 class="fw-bold mb-3 text-capitalize">Shipping details</h5>
                                            <p class="mb-1"><span class="fw-bold">Custome Name:{{$orderDetail['shipping_address']['first_name'].' '.$orderDetail['shipping_address']['last_name']}}</span></p>
                                            <p class="mb-1"><span class="fw-bold">Address:</span>{{ $orderDetail['shipping_address']['address'] }},{{ $orderDetail['shipping_address']['city'] }},{{ $orderDetail['shipping_address']['state'] }},{{ $orderDetail['shipping_address']['pincode'] }}</p>
                                            <p class="mb-1"><span class="fw-bold">Phone:</span>{{ $orderDetail['shipping_address']['mobile_no'] }}</p>
                                            <p><span class="fw-bold">Email:</span>{{ $orderDetail['shipping_address']['email'] }}</p>
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