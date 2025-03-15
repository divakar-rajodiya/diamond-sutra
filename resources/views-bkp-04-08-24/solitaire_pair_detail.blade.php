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
                        <li class="breadcrumb-item active" aria-current="page">Solitaire Pair Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row gy-3 gy-md-4">

            <!-- Diamond 1 -->
            <div class="col-lg-6">
                <div class="d-flex align-items-center justify-content-between">
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
                    <div class="slider-content" id="slider-section-1">
                        <div class="xzoom-container h-100">
                            <a data-fancybox-trigger="gallery" href="javascript:;">
                                <img class="xzoom h-100 w-100 image-1" id="xzoom-default" src="{{$solitaire[0]['ImageLink']}}" xoriginal="{{$solitaire[0]['ImageLink']}}" />
                            </a>
                        </div>
                    </div>
                    <div class="video-play-section w-100 h-100 d-flex justify-content-center d-none" id="video-section-1">
                        <video id="video1" class="h-100 w-100 " width="638" height="340" controls autoplay muted loop playsinline>
                            <source id="video-source-1" src="{{$solitaire[0]['VideoLink']}}" type="video/mp4">
                            <source id="video-source-2" src="{{$solitaire[0]['VideoLink']}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="slider-thumb">
                        <div class="slide"><img src="{{$solitaire[0]['ImageLink']}}" alt="" class="img-fluid thumb-image thumb-image-1" data-id="1"></div>
                        @if($solitaire[0]['VideoLink'] != '')
                        <div class="slide"><img src="{{url('public/assets/img/video-thumb.png')}}" alt="" class="img-fluid video-thumb-image" data-id="1"></div>
                        @endif
                        @if($solitaire[0]['Cert'] == 'GIA')
                        <div class="slide"><a target="_blank" href="{{$solitaire[0]['CertLink']}}"><img src="{{url('public/assets/img/gia-certificate.jpg')}}" alt="" class="img-fluid"></a></div>
                        @elseif($solitaire[0]['Cert'] == 'IGI')
                        <div class="slide"><a target="_blank" href="{{$solitaire[0]['CertLink']}}"><img src="{{url('public/assets/img/igi-certificate.png')}}" alt="" class="img-fluid"></a></div>
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

                <div class="product-info-panel">
                    <h3 class="product-info-title" style="text-transform:uppercase">{{$solitaire[0]['Weight'] . ' CARAT ' .$solitaire[0]['DisplayShape'] .' DIAMOND'}}</h3>
                    <div class="mb-3 d-flex gap-2">
                        <span>{{$solitaire[0]['Color']}} Color</span><span>|</span>
                        <span>{{$solitaire[0]['Clarity']}} Clarity</span>
                    </div>
                    <div class="product-info-price mb-3">
                        <span class="subtotal-price">{{\General::currency_format($solitaire[0]['Price'])}}</span>
                    </div>
                </div>
            </div>

            <!-- Diamond 2 -->
            <div class="col-lg-6">
                <div class="d-flex align-items-center justify-content-between">
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
                    <div class="slider-content" id="slider-section-2">
                        <div class="xzoom-container h-100">
                            <a data-fancybox-trigger="gallery" href="javascript:;">
                                <img class="xzoom h-100 w-100 image-1" id="xzoom-default" src="{{$solitaire[1]['ImageLink']}}" xoriginal="{{$solitaire[1]['ImageLink']}}" />
                            </a>
                        </div>
                    </div>
                    <div class="video-play-section w-100 h-100 d-flex justify-content-center d-none" id="video-section-2">
                        <video id="video2" class="w-100 h-100 " width="638" height="340" controls autoplay muted loop playsinline>
                            <source id="video-source-3" src="{{$solitaire[1]['VideoLink']}}" type="video/mp4">
                            <source id="video-source-4" src="{{$solitaire[1]['VideoLink']}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="slider-thumb">
                        <div class="slide"><img src="{{$solitaire[1]['ImageLink']}}" alt="" class="img-fluid thumb-image thumb-image-1" data-id="2"></div>
                        @if($solitaire[1]['VideoLink'] != '')
                        <div class="slide"><img src="{{url('public/assets/img/video-thumb.png')}}" alt="" class="img-fluid video-thumb-image" data-id="2"></div>
                        @endif
                        @if($solitaire[1]['Cert'] == 'GIA')
                        <div class="slide"><a target="_blank" href="{{$solitaire[1]['CertLink']}}"><img src="{{url('public/assets/img/gia-certificate.jpg')}}" alt="" class="img-fluid"></a></div>
                        @elseif($solitaire[1]['Cert'] == 'IGI')
                        <div class="slide"><a target="_blank" href="{{$solitaire[1]['CertLink']}}"><img src="{{url('public/assets/img/igi-certificate.png')}}" alt="" class="img-fluid"></a></div>
                        @endif
                    </div>
                </div>

                <div class="product-info-panel">
                    <h3 class="product-info-title" style="text-transform:uppercase">{{$solitaire[1]['Weight'] . ' CARAT ' .$solitaire[1]['DisplayShape'] .' DIAMOND'}}</h3>
                    <div class="mb-3 d-flex gap-2">
                        <span>{{$solitaire[1]['Color']}} Color</span><span>|</span>
                        <span>{{$solitaire[1]['Clarity']}} Clarity</span>
                    </div>
                    <div class="product-info-price mb-3">
                        <span class="subtotal-price">{{\General::currency_format($solitaire[1]['Price'])}}</span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="cart-btn-group my-4 text-center">
                    <button class="btn primary-btn large-btn " id="select-diamond">Select This Pair</button>
                    <a href="javascript:history. back()" class="btn large-btn  btn-outline-dark">Select Another Pair</a>
                </div>
            </div>

            <div class="product-description-pd">
                <div class="mb-5">
                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <h5>SOLITAIRE DETAILS</h5>
                            <table class="product-info-table w-100">
                                <tr>
                                    <td>Product Code</td>
                                    <td>{{$solitaire[0]['RefNo']}}</td>
                                </tr>
                                <tr>
                                    <td>Shape</td>
                                    <td>{{$solitaire[0]['DisplayShape']}}</td>
                                </tr>
                                <tr>
                                    <td>Carat</td>
                                    <td>{{$solitaire[0]['Weight']}}</td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td>{{$solitaire[0]['Color']}}</td>
                                </tr>
                                <tr>
                                    <td>Clarity</td>
                                    <td>{{$solitaire[0]['Clarity']}}</td>
                                </tr>
                                <tr>
                                    <td>Cut</td>
                                    <td>{{$solitaire[0]['DisplayCut']}}</td>
                                </tr>
                                <tr>
                                    <td>Certificate</td>
                                    <td>{{$solitaire[0]['Cert']}}</td>
                                </tr>
                                <tr>
                                    <td>Certificate Number</td>
                                    <td>{{$solitaire[0]['CertNo']}}</td>
                                </tr>
                                <tr>
                                    <td>Measurements</td>
                                    <td>{{$solitaire[0]['Diameter']}}</td>
                                </tr>
                                <tr>
                                    <td>Depth %</td>
                                    <td>{{$solitaire[0]['TopDepth']}}</td>
                                </tr>
                                <tr>
                                    <td>Table %</td>
                                    <td>{{$solitaire[0]['Table']}}</td>
                                </tr>
                                <tr>
                                    <td>Polish</td>
                                    <td>{{$solitaire[0]['Pol']}}</td>
                                </tr>
                                <tr>
                                    <td>Symmetry</td>
                                    <td>{{$solitaire[0]['Sym']}}</td>
                                </tr>
                                <tr>
                                    <td>Fluorescence</td>
                                    <td>{{$solitaire[0]['FL']}}</td>
                                </tr>
                                <tr>
                                    <td>Girdle</td>
                                    <td>{{$solitaire[0]['Girdle']}}</td>
                                </tr>
                                <tr>
                                    <td>Culet</td>
                                    <td>{{$solitaire[0]['Culet']}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <h5>SOLITAIRE DETAILS</h5>
                            <table class="product-info-table w-100">
                                <tr>
                                    <td>Product Code</td>
                                    <td>{{$solitaire[1]['RefNo']}}</td>
                                </tr>
                                <tr>
                                    <td>Shape</td>
                                    <td>{{$solitaire[1]['DisplayShape']}}</td>
                                </tr>
                                <tr>
                                    <td>Carat</td>
                                    <td>{{$solitaire[1]['Weight']}}</td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td>{{$solitaire[1]['Color']}}</td>
                                </tr>
                                <tr>
                                    <td>Clarity</td>
                                    <td>{{$solitaire[1]['Clarity']}}</td>
                                </tr>
                                <tr>
                                    <td>Cut</td>
                                    <td>{{$solitaire[1]['DisplayCut']}}</td>
                                </tr>
                                <tr>
                                    <td>Certificate</td>
                                    <td>{{$solitaire[1]['Cert']}}</td>
                                </tr>
                                <tr>
                                    <td>Certificate Number</td>
                                    <td>{{$solitaire[1]['CertNo']}}</td>
                                </tr>
                                <tr>
                                    <td>Measurements</td>
                                    <td>{{$solitaire[1]['Diameter']}}</td>
                                </tr>
                                <tr>
                                    <td>Depth %</td>
                                    <td>{{$solitaire[1]['TopDepth']}}</td>
                                </tr>
                                <tr>
                                    <td>Table %</td>
                                    <td>{{$solitaire[1]['Table']}}</td>
                                </tr>
                                <tr>
                                    <td>Polish</td>
                                    <td>{{$solitaire[1]['Pol']}}</td>
                                </tr>
                                <tr>
                                    <td>Symmetry</td>
                                    <td>{{$solitaire[1]['Sym']}}</td>
                                </tr>
                                <tr>
                                    <td>Fluorescence</td>
                                    <td>{{$solitaire[1]['FL']}}</td>
                                </tr>
                                <tr>
                                    <td>Girdle</td>
                                    <td>{{$solitaire[1]['Girdle']}}</td>
                                </tr>
                                <tr>
                                    <td>Culet</td>
                                    <td>{{$solitaire[1]['Culet']}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>


@stop
@section('footer')
<script>
    $(document).on('click', '.thumb-image', function() {
        var section = $(this).data('id');
        $('#video-section-' + section).addClass('d-none');
        $('#slider-section-' + section).removeClass('d-none');

        // let src = $(this).attr('src');
        // $('#xzoom-default').attr('src', src);
        // $('#xzoom-default').attr('xoriginal', src);
        pause();
    })
    $(document).on('click', '.video-thumb-image', function() {
        var sectionVideo = $(this).data('id');
        $('#slider-section-' + sectionVideo).addClass('d-none');
        $('#video-section-' + sectionVideo).removeClass('d-none');
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
            url: base_url + '/solitaire/pair/select',
            method: 'POST',
            data: {
                diamond: diamond,
                _token: $('#token').val()
            },
            dataType: 'json',
            success: function(res) {
                window.location.href = base_url + '/design-your-own-diamond-earrings?cat=' + product + '&selected=1';
            }
        });

    });
</script>
@stop