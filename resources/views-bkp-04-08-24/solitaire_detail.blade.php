@extends('layouts.site')
@section('content')

@php
$solitaire = $body['solitaire'];
@endphp

<main>
  <div class="page-title mb-3">
    <div class="page-breadcrumb">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Solitaire Detail</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row gy-3 gy-md-4">
      <div class="col-lg-6">
        <div class="d-flex align-items-center justify-content-between">
          <div></div>
          <div>
            <!-- Button trigger modal -->
            <!-- <a href="#" class="btn hint-btn bg-transparent" data-bs-toggle="modal" data-bs-target="#hintModal">
                Drop a Hint <img src="{{url('public/assets/img/hint-icon.png')}}" alt="">
              </a> -->
            <!-- Hint Modal -->
            <div class="modal fade hint-modal" id="hintModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h2>DROP A HINT</h2>
                    <p>Don't leave your friends or loved ones guessing what you want. Help them out and drop a hint!
                    </p>
                    <div class="row share-social">
                      <a href="#" class="d-flex align-items-center gap-1">
                        <span class="social-icon"><i class="fa-brands fa-facebook-f"></i></span>
                        <span>Facebook</span>
                      </a>
                      <a href="#" class="d-flex align-items-center gap-1">
                        <span class="social-icon"><i class="fa-brands fa-twitter"></i></span>
                        <span>Twitter</span>
                      </a>
                      <a href="#" class="d-flex align-items-center gap-1">
                        <span class="social-icon"><i class="fa-brands fa-pinterest-p"></i></span>
                        <span>Pinterest</span>
                      </a>
                      <a href="#" class="d-flex align-items-center gap-1">
                        <span class="social-icon"><i class="fa-solid fa-envelope"></i></span>
                        <span>Mail</span>
                      </a>
                      <a href="#" class="d-flex align-items-center gap-1">
                        <span class="social-icon"><i class="fa-solid fa-link"></i></span>
                        <span>Copy Link</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <div class="slider-content">
            <div class="xzoom-container h-100">
              <a data-fancybox-trigger="gallery" href="javascript:;">
                <img class="xzoom h-100 w-100 image-1" id="xzoom-default" src="{{$solitaire['ImageLink']}}" xoriginal="{{$solitaire['ImageLink']}}" />
              </a>
            </div>
          </div>
          <div class="video-play-section w-100 h-100 d-flex justify-content-center d-none">
            <video id="video1" class="w-100 h-100 " width="520" height="240" controls autoplay muted loop playsinline>
              <source id="video-source-1" src="{{$solitaire['VideoLink']}}" type="video/mp4">
              <source id="video-source-2" src="{{$solitaire['VideoLink']}}" type="video/ogg">
              Your browser does not support the video tag.
            </video>
          </div>
          <div class="slider-thumb">
            <div class="slide"><img src="{{$solitaire['ImageLink']}}" alt="" class="img-fluid thumb-image thumb-image-1"></div>
            @if($solitaire['VideoLink'] != '')
            <div class="slide"><img src="{{url('public/assets/img/video-thumb.png')}}" alt="" class="img-fluid video-thumb-image"></div>
            @endif
            @if($solitaire['Cert'] == 'GIA')
            <div class="slide"><a target="_blank" href="{{$solitaire['CertLink']}}"><img src="{{url('public/assets/img/gia-certificate.jpg')}}" alt="" class="img-fluid"></a></div>
            @elseif($solitaire['Cert'] == 'IGI')
            <div class="slide"><a target="_blank" href="{{$solitaire['CertLink']}}"><img src="{{url('public/assets/img/igi-certificate.png')}}" alt="" class="img-fluid"></a></div>
            @endif
          </div>
          <!-- <div class="certification mt-4 mt-lg-5">
            <ul class="d-flex flex-wrap align-items-center gap-2 gap-lg-3 list-unstyled">
              <li class=""><span class="small text-uppercase">Certified By</span></li>
              <li class="sgl">
                <a href="#" class="d-inline-block">
                  <img src="{{url('public/assets/img/gsi.png')}}" class="img-fluid" alt="">
                </a>
              </li>
              <li class="sgl">
                <a href="#" class="d-inline-block">
                  <img src="{{url('public/assets/img/certificate-2.png')}}" class="img-fluid" alt="">
                </a>
              </li>
              <li class="sgl">
                <a href="#" class="d-inline-block">
                  <img src="{{url('public/assets/img/certificate-3.png')}}" class="img-fluid" alt="">
                </a>
              </li>
            </ul>
          </div> -->
        </div>
      </div>
      <div class="col-lg-6">
        <div class="product-info-panel">
          <!-- <div class="product-rating">
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
            <span class="like-btn">
              <i class="fa-regular fa-heart"></i>
            </span>
          </div> -->
          <h3 class="product-info-title" style="text-transform:uppercase">{{$solitaire['Weight'] . ' CARAT ' .$solitaire['DisplayShape'] .' DIAMOND'}}</h3>
          <div class="mb-3 d-flex gap-2">
            <span>{{$solitaire['Color']}} Color</span><span>|</span>
            <span>{{$solitaire['Clarity']}} Clarity</span>
          </div>
          <div class="product-info-price mb-3">
            <span class="subtotal-price">{{\General::currency_format($solitaire['Price'])}}</span>
          </div>
          <!-- <div class="mb-2 mb-lg-3 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
              <div class="title small">Diamond :</div>
              <div>
                <label class="form-check-label"><input type="radio" class="form-check-input me-1" name="diamondQuality"
                    value="SI IJ" checked="checked">
                  SI IJ</label>
              </div>
              <div>
                <label class="form-check-label"><input type="radio" class="form-check-input me-1" name="diamondQuality"
                    value="SI GH"> SI GH</label>
              </div>
              <div>
                <label class="form-check-label"><input type="radio" class="form-check-input me-1" name="diamondQuality"
                    value="VS GH"> VS GH</label>
              </div>
              <div>
                <label class="form-check-label"><input type="radio" class="form-check-input me-1" name="diamondQuality"
                    value="VVS EF"> VVS EF</label>
              </div>
            </div>
            <div class="mb-2 mb-lg-3 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
              <div class="title small">color :</div>
              <div>
                <label class="form-check-label"><input type="radio" class="form-check-input me-1" name="diamondCrt"
                    value="14K" checked="checked">
                  14K</label>
              </div>
              <div>
                <label class="form-check-label"><input type="radio" class="form-check-input me-1" name="diamondCrt"
                    value="18K"> 18K</label>
              </div>
            </div>
            <div class="mb-3 mb-lg-4 d-flex flex-wrap align-items-center gap-2 gap-lg-3">
              <div class="title small">color :</div>
              <div>
                <label class="form-check-label"><input type="checkbox" class="form-check-input me-1" name="diamondClr1"
                    value="yellow" checked="checked">
                  Yellow</label>
              </div>
              <div>
                <label class="form-check-label"><input type="checkbox" class="form-check-input me-1" name="diamondClr2"
                    value="white"> white</label>
              </div>
            </div> -->
          <div class="cart-btn-group my-4">
            <button class="btn primary-btn large-btn w-100 mb-2 mb-sm-3" id="select-diamond">select this diamond</button>
            <a href="javascript:history. back()" class="btn large-btn w-100 btn-outline-dark">Select Another Solitaire</a>
          </div>
          <!-- <div class="shipping-detail">
            <div class="d-flex mb-2 align-items-center justify-content-between gap-2">
              <p class="mb-0">3 Interest-Free Payments of $726.67.</p>
              <div class="d-flex align-items-center gap-2">
                <a href="#" class="btn fs-4 text-success p-1"><i class="fa-solid fa-phone"></i></a>
                <a href="#" class="btn fs-4 text-success p-1"><i class="fa-brands fa-whatsapp"></i></a>
              </div>
            </div>
            <p>
              Ships as a loose diamond by: <span><strong>Friday, November 3</strong> </span>
            </p>
            <div class="mb-2">
              <img src="{{url('public/assets/img/Free_Fast_Shipping_img.png')}}" style="max-height: 39px" alt="">
            </div>
            <p>Varies when mounted into a setting</p>
            <p><i class="fa-solid fa-shield me-2"></i>Risk-Free Retail</p>
            <p><i class="fa-solid fa-truck-fast me-2"></i>Free Overnight Shipping, Hassle-Free Returns</p>
          </div> -->
        </div>
      </div>
      <div class="product-description-pd">
        <!-- <h3>PRODUCT DESCRIPTION</h3>
        <span>SKU 17740W14 </span>
        <p>This heart shaped 1.01 carat F color si1 clarity has a diamond grading report from IGI</p> -->
        <div class="mb-5">
          <div class="row gy-3">
            <div class="col-lg-8">
              <h5>DIAMOND DETAILS</h5>
              <table class="product-info-table w-100">
                <tr>
                  <td>Product Code</td>
                  <td>{{$solitaire['RefNo']}}</td>
                </tr>
                <tr>
                  <td>Shape</td>
                  <td>{{$solitaire['DisplayShape']}}</td>
                </tr>
                <tr>
                  <td>Carat</td>
                  <td>{{$solitaire['Weight']}}</td>
                </tr>
                <tr>
                  <td>Color</td>
                  <td>{{$solitaire['Color']}}</td>
                </tr>
                <tr>
                  <td>Clarity</td>
                  <td>{{$solitaire['Clarity']}}</td>
                </tr>
                <tr>
                  <td>Cut</td>
                  <td>{{$solitaire['DisplayCut']}}</td>
                </tr>
                <tr>
                  <td>Certificate</td>
                  <td>{{$solitaire['Cert']}}</td>
                </tr>
                <tr>
                  <td>Certificate Number</td>
                  <td>{{$solitaire['CertNo']}}</td>
                </tr>
                <tr>
                  <td>Measurements</td>
                  <td>{{$solitaire['Diameter']}}</td>
                </tr>
                <tr>
                  <td>Depth %</td>
                  <td>{{$solitaire['TopDepth']}}</td>
                </tr>
                <tr>
                  <td>Table %</td>
                  <td>{{$solitaire['Table']}}</td>
                </tr>
                <tr>
                  <td>Polish</td>
                  <td>{{$solitaire['DisplayPol']}}</td>
                </tr>
                <tr>
                  <td>Symmetry</td>
                  <td>{{$solitaire['Sym']}}</td>
                </tr>
                <tr>
                  <td>Fluorescence</td>
                  <td>{{$solitaire['DisplayFl']}}</td>
                </tr>
                <tr>
                  <td>Girdle</td>
                  <td>{{$solitaire['Girdle']}}</td>
                </tr>
                <tr>
                  <td>Culet</td>
                  <td>{{$solitaire['Culet']}}</td>
                </tr>
              </table>
            </div>
            <!-- <div class="col-lg-6">
              <h5>RING INFORMATION</h5>
              <table class="product-info-table w-100">
                <tr>
                  <td>Round</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Princess</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Cushion</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Emerald</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Oval</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Radiant</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Asscher</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Marquise</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Heart</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Pear</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Cushion Modified</td>
                  <td>0.30 - 6.00</td>
                </tr>
                <tr>
                  <td>Square Radiant</td>
                  <td>0.30 - 6.00</td>
                </tr>
              </table>
            </div> -->
          </div>
        </div>
        <!-- <div class="mb-4">
          <ul class="nav" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="quality-certificate-tab" data-bs-toggle="pill" data-bs-target="#quality-certificate" type="button" role="tab" aria-controls="quality-certificate" aria-selected="true">Shop With Confidence</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="payment-finance-tab" data-bs-toggle="pill" data-bs-target="#payment-finance" type="button" role="tab" aria-controls="payment-finance" aria-selected="false">Payments & Financing</button>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane quality-certificate fade show active" id="quality-certificate" role="tabpanel" aria-labelledby="quality-certificate-tab">
              <div class="row">
                <div class="col-lg-6">
                  <div class="">
                    <h6>Exceptional Quality and Certification</h6>
                    <p>All collections of diamonds sold by Diamond Sutra are guaranteed to be of the highest quality and
                      also include certification reports from either the Gemological Institute of America (GIA),
                      American Gem Society (AGS), or International Gemological Institute (IGI).</p>
                    <h6>Diamond Price Match</h6>
                    <p>We strive to offer diamonds at the best prices. Found a comparable diamond at a lower price?
                      Call us at 877-826-9866. We will honor the price as long as it fulfills our Price Match
                      Criteria.</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="">
                    <h6>Conflict Free Diamonds</h6>
                    <p>At Diamond Sutra, we’re proud to go above and beyond to offer you the best diamonds that have
                      been carefully selected from various origins as being ethically and environmentally responsible.
                      Therefore, all of our diamonds are warranted to be Conflict Free.</p>
                    <h6>Expertly Photographed</h6>
                    <p>Every diamond on diamondsutra.com is photographed in 360° HD and magnified up to 40 times,
                      creating a one-of-a-kind viewing experience <a href="#">Learn more.</a></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade payment-finance" id="payment-finance" role="tabpanel" aria-labelledby="payment-finance-tab">
              <div class="row">
                <div class="col-lg-6">
                  <h6>Wire Transfer</h6>
                  <p>Bank wire customers receive a 1.5% discount off their entire order.</p>
                  <h6>Credit Card & PayPal</h6>
                  <p>Pay securely using Visa, Amex, Master Card, Discover or PayPal.</p>
                </div>
                <div class="col-lg-6">
                  <h6>Diamond Sutra Special Financing</h6>
                  <p>Diamond Sutra offers financing options to help you with your purchase. <a href="#">How to
                      apply.</a></p>
                  <h6>Splitit</h6>
                  <p>Use your existing credit card to pay over time in 3 interest free installments. <a href="#">Learn
                      More.</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-5">
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Carat 1.01</button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="row">
                    <div class="col-md-9">
                      <p>The size of a diamond is proportional to its carat weight. When rough diamonds are cut and
                        polished into finished diamonds, up to 2/3 of the total carat weight may be lost. Since larger
                        rough gems of high quality are found less frequently than smaller rough gems of high quality,
                        a single two carat diamond will be more expensive than two one-carat diamonds of the same
                        quality.</p>
                    </div>
                    <div class="col-md-3">
                      <div class="text-center">
                        <img src="{{url('public/assets/img/ring-size.jpg')}}" class="img-fluid" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Color F</button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="row">
                    <div class="col-md-9">
                      <p>A diamond’s color is an important element of its quality. In a white diamond, the less body
                        color present, the greater the value of the diamond. The GIA grades diamonds on a scale of D
                        (colorless) to Z (noticeable color).</p>
                      <p>The predominant color you see in a diamond is yellow, which is caused by the trace element
                        nitrogen.</p>
                    </div>
                    <div class="col-md-3">
                      <div class="text-center">
                        <img src="{{url('public/assets/img/diamond-clr-img.jpg')}}" class="img-fluid" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Clarity
                  SI1</button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="row">
                    <div class="col-md-9">
                      <p>Clarity refers to the presence of imperfections, flaws and blemishes inside or on the surface
                        of a diamond.</p>
                      <p>The GIA grades diamond clarity under 10X magnification on a scale that ranges from Flawless
                        (FL) to I2-3 (Included). Diamonds with the least amount of flaws having the highest clarity
                        grading.</p>
                      <p>A diamond’s clarity has a significant impact on its value.</p>
                    </div>
                    <div class="col-md-3">
                      <div class="text-center">
                        <img src="{{url('public/assets/img/diamond-clarity.gif" class="img-fluid" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
</main>


@stop
@section('footer')
<script>
  $(document).on('click', '.thumb-image', function() {
    $('.video-play-section').addClass('d-none');
    $('.slider-content').removeClass('d-none');
    let src = $(this).attr('src');
    $('#xzoom-default').attr('src', src);
    $('#xzoom-default').attr('xoriginal', src);
    pause();
  })
  $(document).on('click', '.video-thumb-image', function() {
    $('.slider-content').addClass('d-none');
    $('.video-play-section').removeClass('d-none');
    play();
  });

  function playPause() {
    var myVideo = document.getElementById("video1");
    if (myVideo.paused)
      myVideo.play();
  }

  function pause() {
    var myVideo = document.getElementById("video1");
    if (myVideo.play)
      myVideo.pause();
  }

  function play() {
    var myVideo = document.getElementById("video1");
    if (myVideo.paused)
      myVideo.play();
  }

  const diamond = <?php echo json_encode($solitaire); ?>;
  const base_url = $('#base_url').val();
  $(document).on('click', '#select-diamond', function() {
    localStorage.setItem('selected_solitaire', JSON.stringify(diamond));
    console.log(diamond.solitaire_setting_product);
    let product = diamond.solitaire_setting_product;

    $.ajax({
      url: base_url + '/solitaire/select',
      method: 'POST',
      data: {
        diamond: diamond,
        _token: $('#token').val()
      },
      dataType: 'json',
      success: function(res) {
        window.location.href = base_url + '/design-your-own-diamond-'+product+'?cat=' + product + '&selected=1';
      }
    });

  });
</script>
@stop