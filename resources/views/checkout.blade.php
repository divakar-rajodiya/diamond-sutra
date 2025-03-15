@extends('layouts.site')
@section('content')
@php
$checkoutProduct = $body['checkoutProduct'];
$productDetail = $body['productDetail'];
$user_info = $body['user_info'];
@endphp
<main>
  <div class="page-title">
    <div class="container">
      <div class="page-breadcrumb">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
            <li class="breadcrumb-item"><a href="#">Order Summary</a></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <div class="wishlist">
    <div class="container">
      <div class="row gy-4">
        <!-- <div class="col-lg-7">
          <h4 class="mb-3">YOUR CONTACT EMAIL</h4>
          <div class="p-4 border">
            <div class="row justify-content-between gy-3">
              <div class="col-md-6">
                <form action="#" class="">
                  <div class="mb-3">
                    <a href="{{url('login')}}?redirect=checkout">
                      <h5 class="fw-bold">SIGN IN</h5>
                    </a>
                  </div>
                  <div class="mb-3">
                    <h5 class="fw-bold">GUEST CHECKOUT</h5>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="account" id="guestAc" checked>
                      <label class="form-check-label" for="guestAc">Continue as guest</label>
                    </div>
                  </div>
                  <button class="btn primary-btn continue-checkout-btn">continue</button>
                </form>
              </div>
            </div>
          </div>
        </div> -->
        <!-- <h4 class="mb-3">ORDER SUMMARY</h4> -->
        <div class="col-12">
          <div class="row">
            <div class="col-md-6 col-lg-3">
              <div class="table-responsive order-summery-panel">
                <table class="w-100">
                  <tbody>
                    @foreach($checkoutProduct as $ck)
                    <tr>
                      <th class="p-1 border-bottom"><strong>PRODUCT DETAILS</strong></th>
                      <td class="p-1 text-end border-bottom"><strong></strong></td>
                    </tr>
                    <tr>
                      <th class="p-1">Image</th>
                      <td class="p-1 text-end"><img class="img-thumbnail" src="{{url('public/assets/img/product/').'/'.$ck['product_sku'].'/'.$ck['product_sku'].'_'.$ck['selected_color_code'].'1.jpg'}}" width="60" height="60"></td>
                    </tr>
                    <tr>
                      <th class="p-1">Name </th>
                      <td class="p-1 text-end">{{$ck['product_sku']}}</td>
                    </tr>
                    @if(isset($ck['color']))
                    <tr>
                      <th class="p-1">Color </th>
                      <td class="p-1 text-end">{{config('constant.COLOR.'.$ck['selected_color_code'])}}</td>
                    </tr>
                    @endif
                    @php
                    
                    @endphp
                    @if(isset($ck['selected_product_size']))
                    <tr>
                      <th class="p-1">Size </th>
                      @if($ck['category_id'] == 5)
                      <td class="p-1 text-end">2-{{$ck['selected_product_size']}}(2 {{$ck['selected_product_size']}}/16")</td>
                      @else
                      <td class="p-1 text-end">{{$ck['selected_product_size']}}</td>
                      @endif
                    </tr>
                    @endif
                    @if(isset($ck['size']))
                    <tr>
                      <th class="p-1">Size </th>
                      @if($ck['category_id'] == 5)
                      <td class="p-1 text-end">2-{{$ck['size']}}(2 {{$ck['size']}}/16")</td>
                      @else
                      <td class="p-1 text-end">{{$ck['size']}}</td>
                      @endif
                    </tr>
                    @endif
                    @if(isset($ck['selected_gold_carat']))
                    <tr>
                      <th class="p-1">Gold </th>
                      <td class="p-1 text-end">{{$ck['selected_gold_carat']}} K</td>
                    </tr>
                    @endif
                    @if(isset($ck['selected_gold_weight']))
                    <tr>
                      <th class="p-1">Gold Weight</th>
                      <td class="p-1 text-end">{{$ck['selected_gold_weight']}} gm</td>
                    </tr>
                    @endif
                    @if(isset($ck['stone_price']))
                    <tr>
                      <th class="p-1">Stone</th>
                      <td class="p-1 text-end">{{$ck['stone'][0]['type']}}</td>
                    </tr>

                    @endif

                  </tbody>
                </table>
              </div>
              @if($ck['diamond'][0]['quantity'] != 0)
              <div class="table-responsive order-summery-panel">
                <table class="w-100">
                  <tbody>
                    <tr>
                      <th class="p-1 border-bottom"><strong>DIAMOND DETAILS</strong></th>
                      <td class="p-1 text-end border-bottom"><strong></strong></td>
                    </tr>
                    <tr>
                      <th class="p-1">Quality</th>
                      <td class="p-1 text-end">{{config('constant.'.$ck['selected_diamond_quality'])}}</td>
                    </tr>
                    <tr>
                      @foreach($ck['diamond'] as $d)
                      @if($d['quantity'] != 0)
                    <tr>
                      <th class="p-1">Weight</th>
                      <td class="p-1 text-end">{{round($d['carat'],2)}} Ct</td>
                    </tr>
                    <tr>
                      <th class="p-1">Quantity</th>
                      <td class="p-1 text-end">{{$d['quantity']}}</td>
                    </tr>

                    <!-- <hr> -->
                    @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endif

              @endforeach
            </div>
            @if(isset($ck['selected_solitaire_quantity']))
            <div class="col-md-6 col-lg-3">
              <div class="table-responsive order-summery-panel">
                <table class="w-100">
                  <tbody>
                    @foreach($checkoutProduct as $ck)
                    <!-- diamond section from here added in product detail section  -->
                    @if(isset($ck['selected_solitaire_quantity']))
                    <tr>
                      <th class="p-1 border-bottom"><strong>SOLITAIRE DETAILS</strong></th>
                      <td class="p-1 text-end border-bottom"><strong></strong></td>
                    </tr>
                    <tr>
                      <th class="p-1">Cut Clarity</th>
                      <td class="p-1 text-end">{{config('constant.'.$ck['selected_solitaire_quality'])}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Weight</th>
                      <td class="p-1 text-end">{{round($ck['selected_solitaire_carat'],2)}} Ct</td>
                    </tr>
                    <tr>
                      <th class="p-1">Quantity</th>
                      <td class="p-1 text-end">{{$ck['selected_solitaire_quantity']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Shape</th>
                      <td class="p-1 text-end">{{$ck['selected_solitaire_shape']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Cut-Polish-Symmetry</th>
                      <td class="p-1 text-end">{{$ck['selected_soliraire_sym']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Fluorescence</th>
                      <td class="p-1 text-end">{{$ck['selected_solitaire_FL']}}</td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            @endif

            @if($ck['is_chain'] == 'yes')
            @php $ck['chain'] = json_decode($ck['chain'],true); @endphp
            <div class="col-md-6 col-lg-3">
              <div class="table-responsive order-summery-panel">
                <table class="w-100">
                  <tbody>
                    <tr>
                      <th class="p-1 border-bottom"><strong>CHAIN</strong></th>
                      <td class="p-1 text-end border-bottom"><strong></strong></td>
                    </tr>
                    <tr>
                      <th class="p-1">Image</th>
                      <td class="p-1 text-end"><img class="img-thumbnail" src="{{url('public/assets/img/product/').'/'.$ck['chain']['product_sku'].'/'.$ck['chain']['product_sku'].'_'.$ck['chain']['selected_color_code'].'1.jpg'}}" width="60" height="60"></td>
                    </tr>
                    <tr>
                      <th class="p-1">Color</th>
                      <td class="p-1 text-end">{{config('constant.COLOR.'.$ck['chain']['selected_color_code'])}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Gold Carat </th>
                      <td class="p-1 text-end">{{$ck['chain']['selected_gold_carat']}} K</td>
                    </tr>
                    <tr>
                      <th class="p-1">Gold Weight</th>
                      <td class="p-1 text-end">{{$ck['chain']['selected_gold_weight']}} gm</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            @endif

            @if(isset($checkoutProduct[0]['solitaire']))
            @if($checkoutProduct[0]['category_id'] == 1 || $checkoutProduct[0]['category_id'] == 4)
            <div class="col-md-6 col-lg-3">
              <div class="table-responsive order-summery-panel">
                <table class="w-100">
                  <tbody>
                    @foreach($checkoutProduct as $ck)
                    <tr>
                      <th class="p-1 border-bottom"><strong>SOLITAIRE DETAILS</strong></th>
                      <td class="p-1 text-end border-bottom"><strong></strong></td>
                    </tr>
                    <tr>
                      <th class="p-1">Image</th>
                      <td class="p-1 text-end"><img class="img-thumbnail" src="{{$ck['solitaire']['ImageLink']}}" width="60" height="60"></td>
                    </tr>
                    <tr>
                      <th class="p-1">Shape</th>
                      <td class="p-1 text-end">{{$ck['solitaire']['DisplayShape']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Weight</th>
                      <td class="p-1 text-end">{{$ck['solitaire']['Weight']}} Ct</td>
                    </tr>
                    <tr>
                      <th class="p-1">Color</th>
                      <td class="p-1 text-end">{{$ck['solitaire']['Color']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Cut</th>
                      <td class="p-1 text-end">{{$ck['solitaire']['DisplayCut']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Clarity</th>
                      <td class="p-1 text-end">{{$ck['solitaire']['Clarity']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Ceritificate</th>
                      <td class="p-1 text-end">{{$ck['solitaire']['Cert']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Ceritificate No</th>
                      <td class="p-1 text-end"><a href="{{$ck['solitaire']['CertLink']}}" target="_blank" rel="noopener noreferrer">{{$ck['solitaire']['CertNo']}}</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            @elseif($checkoutProduct[0]['category_id'] == 3)
            @foreach($checkoutProduct as $ck)
            @php
            $tempsol[] = $ck['solitaire'][0];
            $tempsol[] = $ck['solitaire'][1];
            @endphp
            @foreach($tempsol as $key => $sol)
            <div class="col-md-6 col-lg-3">
              <div class="table-responsive order-summery-panel">
                <table class="w-100">
                  <tbody>
                    <tr>
                      <th class="p-1 border-bottom"><strong>SOLITAIRE DETAILS {{$key + 1}}</strong></th>
                      <td class="p-1 text-end border-bottom"><strong></strong></td>
                    </tr>
                    <tr>
                      <th class="p-1">Image</th>
                      <td class="p-1 text-end"><img class="img-thumbnail" src="{{$sol['ImageLink']}}" width="60" height="60"></td>
                    </tr>
                    <tr>
                      <th class="p-1">Shape</th>
                      <td class="p-1 text-end">{{$sol['DisplayShape']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Weight</th>
                      <td class="p-1 text-end">{{$sol['Weight']}} Ct</td>
                    </tr>
                    <tr>
                      <th class="p-1">Color</th>
                      <td class="p-1 text-end">{{$sol['Color']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Cut</th>
                      <td class="p-1 text-end">{{$sol['DisplayCut']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Clarity</th>
                      <td class="p-1 text-end">{{$sol['Clarity']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Ceritificate</th>
                      <td class="p-1 text-end">{{$sol['Cert']}}</td>
                    </tr>
                    <tr>
                      <th class="p-1">Ceritificate No</th>
                      <td class="p-1 text-end"><a href="{{$sol['CertLink']}}" target="_blank" rel="noopener noreferrer">{{$sol['CertNo']}}</a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            @endforeach
            @endforeach
            @endif
            @endif
            <div class="col-md-6 col-lg-3">
              <div class="table-responsive order-summery-panel">
                <table class="w-100">
                  <tbody>
                    @foreach($checkoutProduct as $ck)
                    @php @endphp
                    <tr>
                      <th class="p-1 border-bottom"><strong>PRICE DETAILS</strong></th>
                      <td class="p-1 text-end border-bottom"><strong></strong></td>
                    </tr>
                    
                    
                    @if(isset($ck['solitaire']))
                      @if($ck['category_id'] == 1 || $ck['category_id'] == 4)
                      <tr>
                        <th class="p-1">Solitaire Price </th>
                        <td class="p-1 text-end"><b>{{\General::currency_format($ck['solitaire']['Price'])}}</b></td>
                      </tr>
                      @else
                      <tr>
                        <th class="p-1">Solitaire Price </th>
                        <td class="p-1 text-end"><b>{{\General::currency_format($ck['solitaire']['total_price'])}}</b></td>
                      </tr>
                      @endif
                    @endif

                    @if(isset($ck['selected_solitaire_quantity']))
                    <tr>
                      <th class="p-1">Solitaire Price </th>
                      <td class="p-1 text-end"><b>{{\General::currency_format($ck['selected_solitaire_price'])}}</b></td>
                    </tr>
                    @endif

                    @if(isset($ck['selected_diamond_quality']))
                    <tr>
                      <th class="p-1">Diamond Price </th>
                      <td class="p-1 text-end"><b>{{\General::currency_format($ck['selected_diamond_price'])}}</b><span class="disc-price"><b>{{\General::currency_format($ck['diamond_price_list'][$ck['selected_diamond_quality']]['diamond_base_price'])}}</b></span></td>
                    </tr>
                    @endif


                    @if(isset($ck['selected_gold_price']))
                    <tr>
                      <th class="p-1">Gold Price </th>
                      <td class="p-1 text-end"><b>{{\General::currency_format($ck['selected_gold_price'])}}</b></td>
                    </tr>
                    @endif
                    @if($ck['is_chain'] == 'yes')
                      @php
                      $ck['chain'] = json_decode($ck['chain'],true);
                      @endphp
                      <tr>
                        <th class="p-1">Chain Price </th>
                        <td class="p-1 text-end"><b>{{\General::currency_format($checkoutProduct[0]['chain_price'])}}</b></td>
                      </tr>
                    @endif
                    @if(isset($ck['is_stone']))
                    @if($ck['is_stone'] == 'yes')
                    <tr>
                      <th class="p-1">Stone Price </th>
                      <td class="p-1 text-end"><b>{{\General::currency_format($ck['stone_price'])}}</b></td>
                    </tr>
                    @endif
                    @endif
                    @if(isset($ck['selected_making_charge']))
                    <tr>
                      <th class="p-1">Making Charges </th>
                      <td class="p-1 text-end"><b>{{\General::currency_format($ck['selected_making_charge'])}}</b></td>
                    </tr>
                    @endif

                    @if(isset($checkoutProduct[0]['coupon_code']))
                    <tr>
                      <th class="p-1"><strong class="selected_coupon_code">Coupon Discount ({{$checkoutProduct[0]['coupon_code']}})</strong> </th>
                      <td class="p-1 text-end">- <b class="selected_coupon_amount">{{\General::currency_format($checkoutProduct[0]['coupon_discount_amount'])}}</b></td>
                    </tr>
                    @endif
                    @if(isset($ck['gst_amount']))
                    <tr>
                      <th class="p-1">GST </th>
                      <td class="p-1 text-end"><b>{{\General::currency_format($ck['gst_amount'])}}</b></td>
                    </tr>
                    @endif
                    @if(isset($ck['selected_diamond_price']['diamond_discount_amount']))
                    <tr>
                      <th class="p-1">Discount </th>
                      <td class="p-1 text-end"><b>{{\General::currency_format($ck['selected_diamond_price']['diamond_discount_amount'])}}</b></td>
                    </tr>
                    @endif
                    <tr class="border-top">
                      <th class="p-1"><strong> TOTAL </strong></th>
                      <td class="p-1 text-end"><b>{{\General::currency_format($body['finalAmount'])}}</b></td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Browse Chain Option -->

        @if($productDetail[0]['category_id'] == 4 && $productDetail[0]['is_solitaire'] == 'no' && $productDetail[0]['solitaire_setting'] == 'no')
        @if($productDetail[0]['with_chains'] == 'no')
        <div class="mb-4">
          <a href="{{url('/chains')}}" class="btn primary-btn col-3">Browse Chain</a>
        </div>
        @endif
        @endif
        <div class="col-12">
          <hr class="m-0">
        </div>

        <!-- Apply Coupon code -->
        <div class="col-lg-6">
          <label for="coupanfield" class="form-label">If you have a coupon code, please apply it below.</label>
          <form class="d-flex align-items-center gap-2 border p-2 fs-12">
            <input type="text" class="form-control bg-transparent border-0 shadow-none" id="coupanfield" placeholder="Enter coupon code here.." value="">
            <button type="button" id="applu-coupon-btn" class="btn bg-black rounded-0 text-white fs-12 p-3"><i class="fa-solid fa-arrow-right"></i></button>
          </form>
          <div class="d-flex align-items-center gap-2 mt-1 question-reach-out">
            <p class="m-0 fw-bold me-2">If you have any questions, reach out to us</p>
            <div>
              <a href="tel:+919799975281" class="text-success p-1"><i class="fa-solid fa-phone"></i></a>
              <span class="mx-1 fw-bold mb-0">or</span>
              <a href="https://api.whatsapp.com/send?phone=919799975281&amp;text=Hi! Need information on the product | https://diamondsutra.in" class="text-success p-1"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
          </div>
        </div>

        <!-- Cart Total -->
        <div class="col-lg-6">
          <div class="table-responsive order-summery-panel m-0">
            <table class="w-100">
              <tbody id="price-detail-div">
                <tr>
                  <th class="p-2"><strong>CART SUBTOTAL</strong></th>
                  @if(isset($checkoutProduct[0]['coupon_code']))
                  <td class="p-2 text-end" id="cart-total" data-amount="{{$body['finalAmount'] + $checkoutProduct[0]['coupon_discount_amount']}}">
                    <strong>{{\General::currency_format($body['finalAmount'] + $checkoutProduct[0]['coupon_discount_amount'])}}</strong>
                  </td>
                  @else
                  <td class="p-2 text-end">{{\General::currency_format($body['finalAmount'])}}</td>
                  @endif
                </tr>
                <tr id="shippind-detail-div">
                  <th class="p-2"><strong>SHIPPING</strong></th>
                  <td class="p-2 text-end"><strong>FREE SHIPPING</strong></td>
                </tr>
                @if(isset($checkoutProduct[0]['coupon_code']))
                <tr id="shippind-detail-div">
                  <th class="p-2"><strong>Coupon Discount ({{$checkoutProduct[0]['coupon_code']}})</strong></th>
                  <td class="p-2 text-end"><strong class="selected_coupon_amount">{{\General::currency_format($checkoutProduct[0]['coupon_discount_amount'])}}</strong></td>
                </tr>
                @endif
                <tr>
                  <th class="p-2 border-top"><strong>ORDER TOTAL PRICE</strong></th>
                  <td class="p-2 text-end border-top" id="final_amount"><strong>{{\General::currency_format($body['finalAmount'])}}</strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        @php
        @endphp

        <div class="col-12">
          <hr class="m-0">
        </div>
        <div class="col-12">
          <div class="row gy-3">
            <div class="col-md-6">
              <h5 class="mb-3">BILLING ADDRESS</h5>
              <form id="checkout-form" action="{{url('make-checkout')}}" method="post" onsubmit="return false;">
                @csrf
                @if($checkoutProduct[0]['product_type'] == 'solitaire')
                <input type="hidden" id="solitaire" name="solitaire" value="{{json_encode($checkoutProduct[0]['solitaire'])}}">
                @endif
                <input type="hidden" id="product-sku" name="product_sku" value="{{$checkoutProduct[0]['product_sku']}}">
                <input type="hidden" id="selected-product-color" name="color" value="{{$checkoutProduct[0]['selected_color_code']}}">
                <input type="hidden" id="selected-product-size" name="size" value="{{$checkoutProduct[0]['selected_product_size']}}">
                <input type="hidden" id="selected-gold-weight" name="gold_weight" value="{{$checkoutProduct[0]['selected_gold_weight']}}">
                <input type="hidden" id="product-type" name="order_type" value="{{$checkoutProduct[0]['product_type']}}">
                <input type="hidden" id="selected-solitaire-price" name="selected_solitaire_price" value="{{$checkoutProduct[0]['selected_solitaire_price']}}">
                @if(isset($checkoutProduct[0]['selected_solitaire_quality']))
                <input type="hidden" id="solitaire-preset-quality" name="selected_solitaire_preset" value="{{$checkoutProduct[0]['selected_solitaire_quality']}}">
                <input type="hidden" id="solitaire-preset-carat" name="selected_solitaire_carat" value="{{$checkoutProduct[0]['selected_solitaire_carat']}}">
                <input type="hidden" id="solitaire-preset-quantity" name="selected_solitaire_quantity" value="{{$checkoutProduct[0]['selected_solitaire_quantity']}}">
                @endif
                <input type="hidden" id="selected-diamond-quality" name="diamond_quality" value="{{$checkoutProduct[0]['selected_diamond_quality']}}">
                <input type="hidden" id="selected-gold-carat" name="gold_carat" value="{{$checkoutProduct[0]['selected_gold_carat']}}">
                <input type="hidden" id="product-diamond-price" name="diamond_price" value="{{isset($checkoutProduct[0]['selected_diamond_price']) ? $checkoutProduct[0]['selected_diamond_price'] : 0}}">
                <input type="hidden" id="product-gold-price" name="gold_price" value="{{$checkoutProduct[0]['selected_gold_price']}}">
                <input type="hidden" id="product-making-charges" name="making_charges" value="{{$checkoutProduct[0]['selected_making_charge']}}">
                <input type="hidden" id="product-gst-amount" name="gst" value="{{$checkoutProduct[0]['gst_amount']}}">
                <input type="hidden" id="product-net-amount" name="net_amount" value="{{$checkoutProduct[0]['selected_base_price']}}">
                <input type="hidden" name="login_type" id="login_type" value="{{$body['login_type']}}">
                <input type="hidden" id="is_chain" name="is_chain" value="{{$checkoutProduct[0]['is_chain']}}">
                <input type="hidden" id="chain" name="chain" value="{{$checkoutProduct[0]['chain']}}">
                <input type="hidden" name="coupan_applied" id="selected_coupan" value="<?php isset($checkoutProduct[0]['coupon_code']) ? $checkoutProduct[0]['coupon_code'] : '' ?>">
                <input type="hidden" name="coupon_discount_amount" id="coupon_discount_amount">
                <input type="hidden" id="product-final-amount" name="final_amount" value="{{$body['finalAmount']}}">
                <input type="hidden" id="expected_delivery_date" name="expected_delivery_date" value="">
                @php

                if(empty($user_info))
                {
                  $email = "";
                  $phone_number = "";
                  $name = "";
                }else{
                  $email = $user_info['email'];
                  $phone_number = $user_info['number'];
                  $name = $user_info['name'];

                  $pieces = explode(" ", $name);
                }
                @endphp
                <div class="row gy-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="text" class="form-control bg-transparent" id="b-fname" name="b_fname" placeholder="First Name" value="{{ (isset($pieces[0]) ? $pieces[0] : '') }}">
                        <label for="b-fname">First Name</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="text" class="form-control bg-transparent" id="b-lname" name="b_lname" placeholder="Last Name" value="{{ (isset($pieces[1]) ? $pieces[1] : '') }}">
                        <label for="b-Lname">Last Name</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="number" class="form-control bg-transparent" id="b-phone_number" name="b_phone_number" placeholder="Mobile No." value="{{ $phone_number }}">
                        <label for="b-phone_number">Mobile No.</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="text" class="form-control bg-transparent" id="b-email" name="b_email" placeholder="Email " value="{{ $email }}">
                        <label for="b-email">Email</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="text" class="form-control bg-transparent" id="b-address" name="b_address" placeholder="Address" value="">
                        <label for="b-address">Address</label>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-6">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="text" class="form-control bg-transparent" id="b-landmark" name="b_landmark" placeholder="landmark" value="">
                        <label for="b-landmark">Landmark</label>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="text" class="form-control bg-transparent pincode-check" id="b-pincode" name="b_pincode" placeholder="pincode / ZIP" value="">
                        <label for="b-pincode">Pincode / ZIP</label>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="text" class="form-control bg-transparent" id="b-state" name="b_state" placeholder="state" value="">
                        <!-- <select name="b_state" id="b-state" class="form-control bg-transparent">
                          <option value="" selected disabled>Select State</option>
                          @foreach($body['states'] as $state)
                          <option value="{{$state['state']}}">{{$state['state']}}</option>
                          @endforeach
                        </select> -->
                        
                        <!-- <input type="text" class="form-control bg-transparent" id="b-state" name="b_state" placeholder="state / country" value=""> -->
                        <label for="b-state">State</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="text" class="form-control bg-transparent" id="b-city" name="b_city" placeholder="city" value="">
                        <label for="b-city">City</label>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="col-6">
                    <div class="form-group">
                      <div class="form-floating">
                        <input type="text" class="form-control bg-transparent" id="b-country" name="b_country" placeholder="country / country" value="">
                        <label for="b-country">Country</label>
                      </div>
                    </div>
                  </div> -->
                  
                  <div class="col-12">
                    <div class="form-group">
                      <div class="form-floating d-none shipping-display fs-14" id="b-shipping-date-section">
                        <b>Estimated delivery by </b>
                        <span id="b-date">10-12-2024 </span>
                      </div>
                    </div>
                  </div>
                  @if($body['finalAmount'] >= 200000)
                  <div class="col-12">
                    <div class="form-group">
                      <label for="pannumber" class="form-label"><strong>As per the Govt of India rules, PAN is
                          mandatory for all orders worth RS. 2 lakhs or above.</strong></label>
                      <input type="text" class="form-control bg-transparent p-3" id="pannumber" name="pannumber" placeholder="Enter your PAN number here">
                    </div>
                  </div>
                  @endif
                  <div class="col-12">
                    <div class="form-check">
                      <!-- <div class="form-floating"> -->
                      <input type="checkbox" class="form-check-input" id="same-as-billing-check" name="same_shipping" placeholder="Same shipping address" value="1" checked>
                      <label class="form-check-label" for="same-as-billing-check">Ship Items To The Above Billing Address</label>
                      <!-- </div> -->
                    </div>
                  </div>
                </div>
                <!-- </form> -->
            </div>
            <div class="col-md-6">
              <h5 class="mb-3">SHIPPING ADDRESS</h5>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" id="shipping-address-btn" disabled type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Your Shipping
                      Address Details</button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                    <div class="accordion-body">
                      <!-- <form action="#"> -->
                      <div class="row gy-3">
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control bg-transparent" id="s-fname" name="s_fname" placeholder="First Name" value="">
                              <label for="s-fname">First Name</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control bg-transparent" id="s-lname" name="s_lname" placeholder="Last Name" value="">
                              <label for="s-Lname">Last Name</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="number" class="form-control bg-transparent" id="s-phone_number" name="s_phone_number" placeholder="Mobile No." value="">
                              <label for="s-phone_number">Mobile No.</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control bg-transparent" id="s-email" name="s_email" placeholder="company " value="">
                              <label for="s-email">Email</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control bg-transparent" id="s-address" name="s_address" placeholder="Address" value="">
                              <label for="s-address">Address</label>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="col-6">
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control bg-transparent" id="s-landmark" name="s_landmark" placeholder="landmark" value="">
                              <label for="s-landmark">Landmark</label>
                            </div>
                          </div>
                        </div> -->
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control bg-transparent pincode-check" id="s-pincode" name="s_pincode" placeholder="pincode / ZIP" value="">
                              <label for="s-pincode">Pincode / ZIP</label>
                            </div>
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group">
                            <div class="form-floating">
                            <input type="text" class="form-control bg-transparent" id="s-state" name="s_state" placeholder="state" value="">
                              <!-- <select name="s_state" id="s-state" class="form-control bg-transparent">
                                <option value="" selected disabled>Select State</option>
                                @foreach($body['states'] as $state)
                                <option value="{{$state['state']}}">{{$state['state']}}</option>
                                @endforeach
                              </select> -->
                              <!-- <input type="text" class="form-control bg-transparent" id="s-state" name="s_state" placeholder="state / country" value=""> -->
                              <label for="s-state">State</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control bg-transparent" id="s-city" name="s_city" placeholder="city" value="">
                              <label for="s-city">City</label>
                            </div>
                          </div>
                        </div>

                        <!-- <div class="col-6">
                          <div class="form-group">
                            <div class="form-floating">
                              <input type="text" class="form-control bg-transparent" id="s-country" name="s_country" placeholder="country / country" value="">
                              <label for="s-country">Country</label>
                            </div>
                          </div>
                        </div> -->
                        
                        <div class="col-6">
                          <div class="form-group">
                            <div class="form-floating d-none shipping-display" id="s-shipping-date-section">
                              <b>Estimated delivery by : </b>
                              <span id="s-date">10-12-2024 </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <button id="make-checkout" class="btn btn-dark ">Procced to payment <span id="checkout" style="display:none"><i class="fa fa-spinner fa-spin"></i></span></button>
        </div>
      </div>
    </div>
  </div>
</main>
@stop
@section('footer')
<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
<script>
  /* The redirect to autoplay page function */
  function redirect(){
        window.location.href = `{{ asset('/') }}`;
    }
    var initial=setTimeout(redirect,1800000);
    console.log(initial);
    $(document).click(function(event) { 
        clearTimeout( initial );
        initial=setTimeout(redirect,1800000); 
    });
  $(document).ready(function() {
    $('.pincode-check').on('input', function() {
      let display;
      if ($("#same-as-billing-check").is(":checked"))
        display = 'b';
      else
        display = 's';
      var pincode = $('#' + display + '-pincode').val();
      var state = $('#' + display + '-state').val();

      if (pincode.length === 6) {
        var base_url = $('#base_url').val();
        $.ajax({
          url: base_url + '/pincode/check',
          method: 'POST',
          data: {
            pincode: pincode,
            state: state,
            _token: $('#token').val()
          },
          success: function(res) {
            if (res.flag === 1) {
              $('#expected_delivery_date').val(res.data)
              $('#make-checkout').removeAttr('disabled');
              $('.shipping-display').addClass('d-none');
              $('#' + display + '-date').text(res.data);
              $('#' + display + '-shipping-date-section').removeClass('d-none');
              $('#b-state').val(res.state);
              $('#b-city').val(res.city);
              $('#b-state').attr('readonly', true);
              $('#b-city').attr('readonly', true);
              $('#s-state').val(res.state);
              $('#s-city').val(res.city);
              $('#s-state').attr('readonly', true);
              $('#s-city').attr('readonly', true);
            } else {
              $('#expected_delivery_date').val()
              $('#make-checkout').attr('disabled', true);
              $('#b-date').text('');
              $('#s-date').text('');
              $('#s-shipping-date-section').addClass('d-none');
              $('#b-shipping-date-section').addClass('d-none');
              Toast(res.msg, 3000, res.flag);
            }
          },
          error: function(xhr, status, error) {
            // Handle error
            console.error(xhr.responseText);
          }
        });
      }
    });


  });
</script>
@stop