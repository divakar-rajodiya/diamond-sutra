@extends('layouts.site')
@section('content')

@php
$product = $body['product'];
@endphp
<main>
  <div class="page-title mb-3">
    <div class="page-breadcrumb">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Chain Details</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-6">
        <div class="d-flex align-items-center justify-content-between">
          <div></div>
          <div>

          </div>
        </div>
        <div>

          <input type="hidden" id="gold-price-list" value="{{json_encode($product['gold_price_list'])}}">
          <input type="hidden" id="gold-weight-list" value="{{json_encode($product['gold_weight_list'])}}">
          <input type="hidden" id="making-charge-list" value="{{json_encode($product['making_charge_list'])}}">
          <input type="hidden" id="diamond-price-list" value="{{json_encode($product['diamond_price_list'])}}">
          <input type="hidden" id="color-code-list" value="{{json_encode($product['color_code_list'])}}">
          <input type="hidden" id="color-list" value="{{json_encode($product['color_list'])}}">
          <input type="hidden" id="diamond-quality-display-list" value="{{json_encode($product['diamond_quality_display_list'])}}">
          <input type="hidden" id="solitaire_preset" value="{{$product['is_solitaire']}}">
          <input type="hidden" id="is_diamond" value="{{$product['is_diamond']}}">
          <input type="hidden" id="solitaire-price-list" value="{{json_encode($product['solitaire_price_list'])}}">
          <input type="hidden" id="stone-price" value="{{$product['stone_price']}}">

          <input type="hidden" id="product-default-image-url" value="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku']}}">
          <input type="hidden" id="default-product-color-code" value="{{config('constant.COLOR_CODE.'.$product['default_color'])}}">
          <input type="hidden" id="default-product-color" value="{{$product['default_color']}}">
          <input type="hidden" id="default-diamond-quality" value="{{$product['default_diamond_quality']}}">
          <input type="hidden" id="product-size-chart" value="{{json_encode($product['size_chart'])}}">


          <input type="hidden" id="14K_gold_price" value="{{$product['14K_gold_price']}}">
          <input type="hidden" id="18K_gold_price" value="{{$product['18K_gold_price']}}">
          <input type="hidden" id="14K_gold_weight" value="{{$product['gold_weight_14k']}}">
          <input type="hidden" id="18K_gold_weight" value="{{$product['gold_weight_18k']}}">
          <input type="hidden" id="diamond_price" value="{{$product['price_IJ_SI']}}">
          <input type="hidden" id="default-making-charge" value="{{$product['making_charges']}}">

          <!-- selecte data fields -->
          <input type="hidden" id="product-sku" value="{{$product['product_sku']}}">
          <input type="hidden" id="selected-product-color" value="{{config('constant.COLOR_CODE.'.$product['default_color'])}}">
          <input type="hidden" id="selected-product-size" value="{{$product['default_size']}}">
          <input type="hidden" id="selected-product-shape" value="">
          <input type="hidden" id="selected-diamond-quality" value="{{$product['selected_diamond_quality']}}">
          <input type="hidden" id="selected-gold-carat" value="{{$product['default_gold_quality']}}">
          <input type="hidden" id="selected-gold-weight" value="">
          <input type="hidden" id="selected-solitaire" value="{{$product['solitaire_default_quality']}}">
          <input type="hidden" id="selected-solitaire-carat" value="{{$product['solitaire_default_carat']}}">


          <div class="slider-content">
            <div class="xzoom-container h-100">
              <a data-fancybox-trigger="gallery" href="javascript:;">
                <img class="xzoom h-100 w-100 image-1" id="xzoom-default" src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_W1.jpg'}}" xoriginal="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_W1.jpg'}}" />
              </a>
            </div>
          </div>
          
          <div class="slider-thumb">
            <!-- <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_W1.jpg'}}" alt="" class="img-fluid thumb-image thumb-image-1"></div>
            <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_W2.jpg'}}" alt="" class="img-fluid thumb-image thumb-image-2"></div> -->

            @if($product['images']['image1'])
            <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_W1.jpg'}}" alt="" class="img-fluid thumb-image thumb-image-1"></div>
            @endif
            @if($product['images']['image2'])
            <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_W2.jpg'}}" alt="" class="img-fluid thumb-image thumb-image-2"></div>
            @endif
            @if($product['images']['image3'])
            <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_W3.jpg'}}" alt="" class="img-fluid thumb-image thumb-image-3"></div>
            @endif
            @if($product['images']['image4'])
            <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_W4.jpg'}}" alt="" class="img-fluid thumb-image thumb-image-4"></div>
            @endif
            @if($product['images']['model_image'])
            <div class="slide"><img src="{{url('public/assets/img/product/').'/'.$product['product_sku'].'/'.$product['product_sku'].'_Model_W.jpg'}}" alt="" class="img-fluid thumb-image thumb-model-image"></div>
            @endif
          </div>
          <div class="certification">
            <p class="my-2 fw-bold text-capitalize fs-6 pb-2 border-bottom">100% certified Jewelry</p>
            <ul class="d-flex flex-wrap align-items-center gap-2 gap-lg-3 list-unstyled">
              <li class=""><span class="small text-uppercase">Certified By</span></li>
              
              <li class="sgl">
                <a href="https://www.bis.gov.in/" class="d-inline-block" target="_blank">
                  <img src="{{url('public/assets/img/certificate-2.png')}}" class="img-fluid" alt="">
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="product-info-panel">
          <div class="product-rating">
            <ul class="d-flex list-unstyled mb-0">
              <li>
                <i class="fa-solid fa-star"></i>
              </li>
              <li>
                <i class="fa-solid fa-star"></i>
              </li>
              <li>
                <i class="fa-solid fa-star"></i>
              </li>
              <li>
                <i class="fa-solid fa-star"></i>
              </li>
              <li>
                <i class="fa-regular fa-star"></i>
              </li>
              <li>
                <span>1043 Reviews</span>
              </li>
            </ul>
            <!-- <span class="like-btn" data-id="{{$product['product_sku']}}">
              <i class="fa-regular fa-heart"></i>
            </span> -->
          </div>
          <h3 class="product-info-title">{{$product['name']}}</h3>
          <div class="product-info-price">
            <span class="subtotal-price">{{\General::currency_format($product['default_buy_price'])}}</span><span class="disc-price"></span>
          </div>

          <div class="mb-2 mb-lg-3 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
            <div class="title small">Gold :</div>
            <div>
              <label class="form-check-label"><input type="radio" class="form-check-input me-1 carat-filter" name="goldCrt" value="14" @if($product['default_gold_quality']==14) checked="checked" @endif> 14K</label>
            </div>
            <div>
              <label class="form-check-label"><input type="radio" class="form-check-input me-1 carat-filter" name="goldCrt" value="18" @if($product['default_gold_quality']==18) checked="checked" @endif> 18K</label>
            </div>
          </div>

          <div class="total-weight mb-3">
            <span class="gold-quality-title">{{$product['default_gold_quality']}}K {{$product['default_color']}} Gold</span>
            <div class="gold-quality">
              <div></div>
              <ul class="d-flex list-unstyled">
                @foreach($product['all_colors'] as $color)
                <li class="color-filter">
                  <label class="form-label" for="color-14-{{$color['color_code']}}">
                    <input type="radio" class="btn" id="color-14-{{$color['color_code']}}" name="flexRadioDefault" value="{{$color['color_code']}}">
                    <span class="color-14-{{$color['color']}}" data-crt="14" data-color="{{$color['color']}}">{{$color['color_code']}}</span>
                  </label>
                </li>
                @endforeach
              </ul>
            </div>
          </div>

          @if($product['size_chart'] != null)
          <div class="mb-2 mb-lg-3 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
            <div class="dropdown-wrapper ring-size-wrapper">
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="size-chart" data-bs-toggle="dropdown" aria-expanded="false">{{$product['size_chart_name']}} size</button>
                <ul class="dropdown-menu" style="max-height: 200px;overflow-y: auto;" aria-labelledby="size-chart">
                  @foreach($product['size_chart'] as $size)
                  <li><a data-size="{{$size}}" class="dropdown-item ring-size-filter @if($size == $product['default_size']) {{'active'}} @endif" href="javascript:void(0)">{{$size}}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          @endif
          <div class="cart-btn-group my-4">
            <button id="btn-select-chain" class="btn primary-btn large-btn w-100 mb-3">Select Chain</button>
          </div>
          <div class="shipping-detail">
            <div class="mb-2 d-flex flex-wrap gap-2">
              <p class="m-0">Estimated Shipping:</p>
              <input type="text" class="form-control w-auto" id="pincode" placeholder="Enter Pincode">
              <button class="btn btn-dark" id="checkEstimatedDeliveryBtn">Check</button>
            </div>

            <p id="estimated-date" class="my-2"></p>

            <div class="d-flex flex-wrap align-items-center gap-2 ms-auto mb-2 question-reach-out">
              <p class="m-0 fw-bold me-2">If you have any questions, reach out to us</p>
              <div class="d-flex align-items-center gap-2">
                <a href="#" class="fs-4 text-success p-1"><i class="fa-solid fa-phone"></i></a>
                <span class="mx-1 fw-bold mb-0">or</span>
                <a href="#" class="fs-4 text-success p-1"><i class="fa-brands fa-whatsapp"></i></a>
              </div>
            </div>

            <div class="diamondsutra-promises border bg-light d-inline-block py-3 px-4 fs-12">
              <p class="mb-2 pb-2 d-block text-uppercase fw-bold border-bottom fs-12" style="letter-spacing: 2px;">Diamond Sutra Promises</p>
              <div class="d-flex flex-wrap gap-3">
                <ul class="list-unstyled m-0">
                  <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-certificate me-2 text-center" style="width:16px"></i> 100% certified jewelry</li>
                  <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-hand-holding-dollar me-2 text-center" style="width:16px"></i> 15-day refund policy</li>
                  <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-repeat me-2 text-center" style="width:16px"></i> Lifetime Exchange & Buyback</li>
                </ul>
                <ul class="list-unstyled m-0">
                  <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-truck-fast me-2 text-center" style="width:16px"></i> Free Shipping and Insurance</li>
                  <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-money-bill-wave me-2 text-center" style="width:16px"></i> Transparent Pricing</li>
                  <li class="p-2 ps-0 fw-bold fs-12"><i class="fa-solid fa-compress me-2 text-center" style="width:16px"></i> Complementary Resizing</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="product-description-pd">
        <h3>PRODUCT DESCRIPTION</h3>
        <span class="sku">{{$product['product_sku']}}</span>
        <p>{{$product['description']}}</p>

        <div class="accordion" id="accordionExample">
          @if(isset($product['dimension']) && $product['dimension'] != '')
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">PRODUCT DETAIL</button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <div>
                  <!-- <h6>PRODUCT INFORMATION</h6> -->
                  <table class="product-info-table">
                    <tr>
                      <td>Height <i class="fa fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Height can vary in the final product."></i></td>
                      <td>{{$product['dimension']['height']}} <span style="text-transform: lowercase;">mm</span></td>
                    </tr>
                    <tr>
                      <td>Width <i class="fa fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Width can vary in the final product."></i></td>
                      <td>{{$product['dimension']['width']}} <span style="text-transform: lowercase;">mm</span></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          @endif
          @if($product['is_diamond'] == 'yes')
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">DIAMOND DETAILS</button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="product-info-table">
                  <tr>
                    <td>Diamond Quality</td>
                    <td class="display-diamond-quality-info">{{$product['diamond_quality_display_list'][$product['default_diamond_quality']]}}</td>
                  </tr>
                  <tr>
                    <td>Total Weight <i class="fa fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="The final invoice amount will be adjusted in case of variation in weight."></i></td>
                    <td>{{round($product['diamond'][0]['carat'],2)}} Ct</td>
                  </tr>
                  <tr>
                    <td>Total Diamonds</td>
                    <td>{{$product['diamond'][0]['quantity']}}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          @endif
          @if($product['is_stone'] == 'yes')
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingStone">
              <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStone" aria-expanded="true" aria-controls="collapseStone">STONE DETAILS</button>
            </h2>
            <div id="collapseStone" class="accordion-collapse collapse show" aria-labelledby="headingStone" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="product-info-table">
                  <tr>
                    <td>Stone</td>
                    <td>{{$product['stone'][0]['type']}}</td>
                  </tr>
                  <tr>
                    <td>Color</td>
                    <td>{{$product['stone'][0]['color']}}</td>
                  </tr>
                  <tr>
                    <td>Shape</td>
                    <td>{{$product['stone'][0]['shape']}}</td>
                  </tr>
                  <tr>
                    <td>Carat </td>
                    <td>{{round($product['stone'][0]['carat'],2)}} Ct</td>
                  </tr>
                  <tr>
                    <td>Total Stones</td>
                    <td>{{$product['stone'][0]['quantity']}}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          @endif
          @if($product['is_solitaire'] == 'yes')
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingSolitaire">
              <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">SOLITAIRE DETAILS</button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingSolitaire" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="product-info-table">
                  <tr>
                    <td>Solitaire Quality</td>
                    <td class="display-solitaire-quality-info">{{$product['diamond_quality_display_list'][$product['solitaire_default_quality']]}}</td>
                  </tr>
                  <tr>
                    <td>Total Weight</td>
                    <td class="display-solitaire-weight">{{$product['solitaire_default_carat']}}</td>
                  </tr>
                  <tr>
                    <td>Total No. of Solitaires</td>
                    <td>{{$product['solitaire_quantity']}}</td>
                  </tr>
                  <tr>
                    <td>Shape</td>
                    <td>Round</td>
                  </tr>
                  <tr>
                    <td>Cut-Polish-Symmetry</td>
                    <td>Min. VG - VG - VG</td>
                  </tr>
                  <tr>
                    <td>Fluorescence</td>
                    <td>NONE</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          @endif
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">MATEL DETAILS</button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="product-info-table">
                  <tr>
                    <td>Type</td>
                    <td class="metal-type-info">GOLD</td>
                  </tr>
                  <tr>
                    <td>Total Weight <i class="fa fa-exclamation-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="The final invoice amount will be adjusted in case of variation in weight."></i></td>
                    <td id="selected-metal-weight-info"></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">PRICE BREAKUP</button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="product-info-table">
                  <tr>
                    <td>Gold</td>
                    <td class="gold-price-info"></td>
                  </tr>
                  @if($product['is_diamond'] == 'yes')
                  <tr>
                    <td>Diamond</td>
                    <td class="diamond-price-info"></td>
                  </tr>
                  @endif
                  @if($product['is_solitaire'] == 'yes')
                  <tr>
                    <td>Solitaire</td>
                    <td class="solitaire-price-info"></td>
                  </tr>
                  @endif
                  @if($product['is_stone'] == 'yes')
                  <tr>
                    <td>Stone</td>
                    <td class="stone-price-info">{{$product['stone_price']}}</td>
                  </tr>
                  @endif
                  <tr>
                    <td>Making Charges</td>
                    <td class="making-charges-info"></td>
                  </tr>
                  <tr>
                    <td>GST</td>
                    <td class="gst-price-info"></td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td class="total-price-info"></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="item-review mb-4 mb-md-5 mt-5">
     
    </div>
  </div>
</main>

@stop
@section('footer')
<script>
  var format = new Intl.NumberFormat('hi-IN', {
    style: 'currency',
    currency: 'INR',
    minimumFractionDigits: 0,
  });
  var base_url = $('#base_url').val();
  var token = $('#token').val();
  var defaultImagePath = $('#product-default-image-url').val();
  var selectedColorCode = $('#default-product-color-code').val();
  var selectedColor = $('#default-product-color').val();
  var selectedCarat = $('#selected-gold-carat').val();
  var selectedDiamond = $('#selected-diamond-quality').val();
  var diamondQualityChart = JSON.parse($('#diamond-quality-display-list').val());
  var displayDiamondQuality = diamondQualityChart[selectedDiamond];
  var selectedSize = $('#selected-product-size').val();
  var defaultMakingCharge = $('#default-making-charge').val();
  var selectedSolitaireQuality = $('#selected-solitaire').val();
  var selectedSolitaireDisplay;
  var selectedSolitaireCarat = $('#selected-solitaire-carat').val();

  var goldPriceList = JSON.parse($('#gold-price-list').val());
  var goldWeightList = JSON.parse($('#gold-weight-list').val());
  var makingChargeList = JSON.parse($('#making-charge-list').val());
  var diamondPriceList = JSON.parse($('#diamond-price-list').val());
  var solitairePriceList = JSON.parse($('#solitaire-price-list').val());

  var goldPrice;
  var goldWeight;
  var makingCharge;
  var diamondBuyPrice = 0;
  var diamondDiscount = 0;
  var diamondBasePrice = 0;
  var gst;
  var totalAmount;
  var diamondDiscountAmount;
  var buyPrice;
  var finalBuyPriceWithGst;
  var solitairePresetPrice = 0;

  $(document).ready(function() {
    updateData();
    // updateCaratPrice();
    updateProductPrice();

    $('.accordion-collapse').addClass('show');
    $('.accordion-button').click(function() {
      var targetCollapse = $(this).attr('data-bs-target');
      var isExpanded = $(this).attr('aria-expanded') === 'true';
      if (isExpanded) {
        $(targetCollapse).removeClass('show');
      }
    });
  });
  $('.color-filter').on('click', function() {
    selectedColorCode = $(this).children('label').find('input[type="radio"]').val();
    selectedColor = $(this).children('label').children('span').data('color');
    updateData();
    // updateCaratPrice();
    updateProductPrice();
  });

  $('.carat-filter').on('click', function() {
    selectedCarat = $(this).val();
    console.log('carat', selectedCarat);
    $('.metal-type-info').text(selectedCarat + 'K Gold');
    // updateCaratPrice();

    // new code 
    $('.metal-type-info').text(selectedCarat + 'K Gold');
    updateProductPrice();
  });

  $('.ring-size-filter').on('click', function() {
    $('.ring-size-filter').removeClass('active');
    $(this).addClass('active');
    selectedSize = $(this).data('size');
    // updateCaratPrice();
    updateProductPrice();
  });

  $('.solitaire-carat-filter').on('click', function() {
    $('.solitaire-carat-filter').removeClass('active');
    $(this).addClass('active');
    selectedSolitaireCarat = $(this).data('carat');
    // updateCaratPrice();
    updateProductPrice();
  });

  $('.diamond-filter').on('click', function() {
    selectedDiamond = $(this).data('diamond');
    displayDiamondQuality = $(this).data('display');
    // updateCaratPrice();
    updateProductPrice();
  });

  $('.solitaire-quality-filter').on('click', function() {
    selectedSolitaireQuality = $(this).data('diamond');
    selectedSolitaireDisplay = $(this).data('display');
    console.log('selected : ', selectedDiamond);
    console.log('display : ', displayDiamondQuality);
    updateProductPrice();
  });


  function updateData() {
    console.log('update data called')
    let goldPrice = $('#' + selectedCarat + 'K_gold_price').val();

    $('.metal-type-info').text(selectedCarat + 'K Gold');
    $('.display-diamond-quality-info').text(displayDiamondQuality);
    $('.display-solitaire-weight').text(selectedSolitaireCarat);
    $('.display-solitaire-quality-info').text(selectedSolitaireDisplay);
    $('#color-' + selectedCarat + '-' + selectedColorCode).prop('checked', true);
    $('.gold-quality-title').text(selectedCarat + 'K ' + selectedColor + ' gold');
    $('#xzoom-default').attr('src', defaultImagePath + '_' + selectedColorCode + '1.jpg');
    $('#xzoom-default').attr('xoriginal', defaultImagePath + '_' + selectedColorCode + '1.jpg');

    $('.thumb-image-1').attr('src', defaultImagePath + '_' + selectedColorCode + '1.jpg');
    $('.thumb-image-2').attr('src', defaultImagePath + '_' + selectedColorCode + '2.jpg');
    $('.thumb-image-3').attr('src', defaultImagePath + '_' + selectedColorCode + '3.jpg');
    $('.thumb-model-image').attr('src', defaultImagePath + '_Model_' + selectedColorCode + '.jpg');

    $('#selected-metal-info').text(selectedCarat + 'K Gold');
    
  }

  $(document).on('click', '#checkEstimatedDeliveryBtn', function() {
    let pincode = $('#pincode').val();
    let base_url = $('#base_url').val();
    $.ajax({
      type: 'GET',
      url: base_url + '/check-estimated-delivery/' + pincode,
      // data: {
      //   pincode: pincode,
      //   _token: $('#token').val()
      // },
      success: function(res) {
        console.log(res);
        if (res.flag === 1) {
          $('#estimated-date').html('<b>Estimated Delivery by date: </b>' + res.data);
        } else {
          $('#estimated-date').html('');
          Toast(res.msg, 3000, res.flag);
        }
      },
    });
  });

  $(document).on('click', '#btn-select-chain', () => {
    // Fetch all the hidden field values
    const productSku = $('#product-sku').val();
    const selectedProductColor = $('#selected-product-color').val();
    const selectedProductSize = $('#selected-product-size').val();
    const selectedProductShape = $('#selected-product-shape').val();
    const selectedGoldCarat = $('#selected-gold-carat').val();
    const productGoldPrice = $('#product-gold-price').val();
    const productMakingCharges = $('#product-making-charges').val();
    const productGstAmount = $('#product-gst-amount').val();
    const productNetAmount = $('#product-net-amount').val();
    const productFinalAmount = $('#product-final-amout').val();
    const productGoldWeight = $('#selected-gold-weight').val();

    // Prepare the data object
    var cartProduct = [];
    const productData = {
      product_sku: productSku,
      color: selectedProductColor,
      size: selectedProductSize,
      goldCarat: selectedGoldCarat,
      goldWeight: productGoldWeight,
      goldPrice: productGoldPrice,
      makingCharges: productMakingCharges,
      gstAmount: productGstAmount,
      netAmount: productNetAmount,
      product_type: 'product',
      finalAmount: productFinalAmount
    };
    cartProduct.push(productData);

    // Send the data to the server using AJAX
    $.ajax({
      type: 'POST',
      url: base_url + '/select-chain', // Replace with your endpoint
      data: {
        _token: token,
        productData: cartProduct
      },
      success: function(res) {
        // Redirect the user to the checkout page
        if (res.flag === 1) {
          window.location.href = base_url + '/checkout';
        } else {
          Toast(res.msg, 3000, res.flag);
        }
      },
      error: function(xhr, status, error) {
        // Handle errors if the AJAX request fails
        console.error(error);
        // Show an error message to the user or retry the action
      }
    });
  })

  $(document).on('click', '.thumb-image', function() {
    $('.slider-content').removeClass('d-none');
    let src = $(this).attr('src');
    $('#xzoom-default').attr('src', src);
    $('#xzoom-default').attr('xoriginal', src);
  })

  function updateProductPrice() {
    updateData();
    var stonePrice = 0;
    if($('#stone-price').val() != '')
      stonePrice = $('#stone-price').val();
    
    if ($('#product-size-chart').val() == 'null') {
      goldPrice = goldPriceList[selectedCarat];
      goldWeight = goldWeightList[selectedCarat];
      makingCharge = makingChargeList[selectedCarat];
    } else {
      goldPrice = goldPriceList[selectedCarat][selectedSize];
      goldWeight = goldWeightList[selectedCarat][selectedSize];
      makingCharge = makingChargeList[selectedCarat][selectedSize];
    }
    let solitairePreset = $('#solitaire_preset').val();
    let is_diamond = $('#is_diamond').val();
    if (solitairePreset === 'yes') {
      solitairePresetPrice = solitairePriceList[selectedSolitaireQuality][selectedSolitaireCarat];
    }
    if (is_diamond === 'yes') {
      diamondBuyPrice = diamondPriceList[selectedDiamond]['diamond_buy_price'];
      diamondDiscount = diamondPriceList[selectedDiamond]['diamond_discount'];
      diamondBasePrice = diamondPriceList[selectedDiamond]['diamond_base_price'];
    }
    gst = Math.round(((Math.round(parseFloat(goldPrice)) + Math.round(parseFloat(stonePrice)) + Math.round(parseFloat(diamondBuyPrice)) + Math.round(parseFloat(makingCharge)) + Math.round(parseFloat(solitairePresetPrice))) * 3) / 100);
    totalAmount = (Math.round(parseFloat(goldPrice)) + Math.round(parseFloat(stonePrice)) + Math.round(parseFloat(diamondBasePrice)) + Math.round(parseFloat(makingCharge)) + Math.round(parseFloat(solitairePresetPrice)));
    buyPrice = (Math.round(parseFloat(goldPrice)) + Math.round(parseFloat(stonePrice)) + Math.round(parseFloat(diamondBuyPrice)) + Math.round(parseFloat(makingCharge)) + Math.round(parseFloat(solitairePresetPrice)));
    finalBuyPriceWithGst = buyPrice + gst;

    $('#' + selectedCarat + 'K_gold_weight').val(goldWeight);
    $('#selected-metal-weight-info').text(goldWeight + ' gm');

    if (diamondDiscount == 0) {
      $('.disc-price').addClass('d-none');
      $('.disc-percentage').addClass('d-none');
      $('.discount-text').addClass('d-none');
    } else {
      $('.disc-price').removeClass('d-none');
      $('.disc-percentage').removeClass('d-none');
      $('.discount-text').removeClass('d-none');
    }

    $('.subtotal-price').text(format.format(buyPrice + gst) + '/-');
    $('.disc-price').text(format.format(totalAmount + gst) + '/-');
    $('.gold-price-info').text(format.format(goldPrice) + '/-');
    $('.diamond-price-info').text(format.format(diamondBuyPrice) + '/-');
    $('.solitaire-price-info').text(format.format(Math.round(parseFloat(solitairePresetPrice))) + '/-');
    $('.making-charges-info').text(format.format(makingCharge) + '/-');
    $('.gst-price-info').html(format.format(gst) + '/-');
    $('.total-price-info').html(format.format(buyPrice + gst) + '/-');
    $('.stone-price-info').html(format.format(stonePrice) + '/-');

    $('#selected-gold-weight').val(goldWeight);
    $('#selected-product-color').val(selectedColorCode);
    $('#selected-solitaire').val(selectedSolitaireQuality);
    $('#selected-solitaire-carat').val(selectedSolitaireCarat);
    $('#selected-product-size').val(selectedSize);
    $('#selected-diamond-quality').val(selectedDiamond);
    $('#selected-gold-carat').val(selectedCarat);

  }
</script>

@stop