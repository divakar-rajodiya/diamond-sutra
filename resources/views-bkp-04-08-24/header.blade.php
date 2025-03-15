<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$header['title']}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{url('public/assets/img/favicon.png')}}">

    @php
    $segment = URL::full();
    @endphp

    @if( strpos($segment, 'Bracelets') !== false)
        <meta property="title" content="Buy Gold and Diamond Bracelets | Buy Best Jewellery Designs Online | DiamondSutra" />
        <meta name="description" content="Explore an exquisite collection of handcrafted Bracelet and Bangle Designs at DiamondSutra ✓Certified ✓Money Back ✓Lifetime Exchange ✓Free Shipping ✓15 Days Free Return ✓Transparent Pricing ✓Exclusive Designs" />
        <meta name="keywords" content="bracelets, bangles, buy bracelets online, buy bangles online, bracelet designs, bangle designs, gold bracelets, gold jewellery, diamond bracelets, tennis bracelets, bracelet shopping in India" />
    @elseif(strpos($segment, 'Earrings') !== false)
        <meta property="title" content="Buy Gold and Diamond Earrings | Buy Best Jewellery Designs Online | DiamondSutra" />
        <meta name="description" content="Discover stunning handcrafted Earring Designs at DiamondSutra ✓Certified ✓Money Back ✓Lifetime Exchange ✓Free Shipping ✓15 Days Free Return ✓Transparent Pricing ✓Exclusive Designs" />
        <meta name="keywords" content="earrings, buy earrings online, earring designs, gold earrings, gold jewellery, solitaires earrings, solitaire studs, designer earrings, diamond earrings, earring shopping in India" />
    @elseif(strpos($segment, 'Pendants') !== false)
        <meta property="title" content="Buy Gold and Diamond Pendants | Buy Best Jewellery Designs Online | DiamondSutra" />
        <meta name="description" content="Find beautifully designed handcrafted Pendants at DiamondSutra ✓Certified ✓Money Back ✓Lifetime Exchange ✓Free Shipping ✓15 Days Free Return ✓Transparent Pricing ✓Exclusive Designs" />
        <meta name="keywords" content="pendants, buy pendants online, pendant designs, gold jewellery, gold pendants, tennis necklace, necklace designs, diamond necklaces, gold necklaces, necklace set, diamond pendants, pendant shopping in India" />
    @elseif(strpos($segment, 'select-solitaire-diamond') !== false || strpos($segment, 'matching/diamond-pair') !== false)
        <meta property="title" content="Design your own jewellery by selecting from wide range of solitaires | Buy Best Jewellery Designs Online | DiamondSutra" />     
        <meta name="description" content="Discover thousands of exquisite solitaires at DiamondSutra ✓360° HD Videos ✓Design your own jewellery with solitaires ✓Certified ✓Money Back ✓Lifetime Exchange ✓Free Shipping ✓15 Days Free Return ✓Transparent Pricing ✓Exclusive Designs" />
        <meta name="keywords" content="solitaires, buy solitaires online, solitaire designs, diamond solitaires, solitaire jewelry, solitaire shopping in India" />
    @else
        <meta property="title" content="Gold and Diamond Jewellery | Buy Best Jewellery Designs Online | DiamondSutra" />
        <meta property="description" content="DiamondSutra offers an latest collection of Gold and Certified Natural Diamond jewellery. Enjoy ✓Free Shipping ✓15 Days Free Return ✓Lifetime Exchange and ✓Transparent Pricing." />
        <meta name="keywords" content="diamond jewellery, gold jewellery, jewellery website, jewellery designs, fashion jewellery, indian jewellery, designer jewellery, diamond Jewellery,  fashion Jewellery, online jewellery shopping, online jewellery shopping india, jewellery websites, diamond jewellery india, gold jewellery online, Indian diamond jewellery" />
    @endif
    

    <link rel="stylesheet" href="{{url('public/assets/css/site/site.min.css')}}">
    <?php
    if (isset($header['css'])) {
        for ($i = 0; $i < count($header['css']); $i++) {
            if (strpos($header['css'][$i], "https://") !== FALSE || strpos($header['css'][$i], "http://") !== FALSE)
                echo '<link rel="stylesheet" href="' . $header['css'][$i] . '">';
            else
                echo '<link rel="stylesheet" href="' . \URL::to('/public/assets/css/' . $header['css'][$i]) . '">';
        }
    }
    ?>
    @yield('header')
</head>
@php
$category = app('category');
@endphp

<body>
    <input type="hidden" id="base_url" value="{{url('/')}}">
    <input type="hidden" id="token" value="{{csrf_token()}}">
    <div class="loader" id="loader">
        <div class="loader-inner"></div>
    </div>
    <!--  -->
    <!-- <div class="{{isset($_COOKIE['cookie_accept']) && $_COOKIE['cookie_accept'] ? '' : 'show'}}">
        <div class="toast-body">
            <h5>By continuing use this site, you agree to the <br><strong><a href="{{url('/privacy-policy')}}" style="color:#fff;">Privacy Policy.</a></strong></h5>
            <button type="button" id="acceptCookiePolicy" class="btn-close" data-bs-dismiss="toast" aria-label="Close">ok</button>
        </div>
    </div> -->
    <!--  -->

    <div class="top-black-bar bg-black">
        <div class="flip-container">
            <div class="flipper">
                <div class="front">
                    <!-- front content -->
                    <p class="text-center text-white text-uppercase fs-14 d-flex flex-wrap justify-content-center align-items-center">
                        20% OFF ON DIAMONDS</p>
                </div>
                <div class="back">
                    <!-- back content -->
                    <div class="text-uppercase fs-14 d-flex flex-wrap justify-content-center align-items-center gap-3">
                        <a href="" class="text-white mx-2">15-DAY RETURNS</a>
                        <a href="" class="text-white mx-2">LIFETIME EXCHANGE</a>
                        <a href="" class="text-white mx-2">FREE SHIPPING</a>
                        <a href="" class="text-white mx-2">TRANSPARENT PRICING</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="emailSubscribe" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="emailSubscribeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-light text-dark border-0 rounded-0">
                <button id="close-newsletter" type="button" class="btn-close rounded-circle position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row g-0 align-items-center">
                    <div class="col-lg-6">
                        <img src="{{url('public/assets/img/diamondsutra_subscribe.jpg')}}" alt="email-subscribe" class="img-fluid w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4">
                            <h2 class="fw-light m-0">JOIN THE CLUB</h2>
                            <h6 class="my-4">Unlock exclusive member deals and more – sign up now!</h6>
                            <form class="d-flex align-items-center gap-2 border p-2 fs-12">
                                <input type="email" class="form-control bg-transparent border-0 shadow-none" id="floatingInputGrid" placeholder="name@example.com" value="" required>
                                <button type="button" class="btn bg-black rounded-0 text-white fs-12 p-3"><i class="fa-solid fa-arrow-right"></i></button>
                            </form>
                            <p class="fs-12 mt-3">By signing up you confirm that you have read the Privacy Policy and agree that your
                                email and the provided information will be collected and used for the purposes of sending
                                news, promotions and updates via email.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <header class="main-header bg-white white-dot-bg wow fadeInDown position-relative"> -->
    <header class="main-header bg-white white-dot-bg position-sticky top-0">
        <div class="header-top p-2">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">
                    <div class="col-6 col-lg-4 col-sm-auto">
                        <div class="header-left-div">
                            <ul class="d-flex align-items-center justify-content-start list-unstyled">
                                <li class="text-dark d-none d-sm-block"><a href="tel:+919799975281" class="d-block text-dark"><b>+91 9799975281</b></a> <b>9:00AM - 9:00PM (IST)</b></li>
                                <li>
                                    <a href="mailto:info@diamondsutra.in" class="text-dark"><i class="fa-solid fa-envelope"></i> Mail</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-6 col-lg-4 col-sm-auto order-lg-1">
                        <div class="header-right-menu">
                            <ul class="right-menu-ul m-0">
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i>
                                    </a>
                                </li>
                                <li class="ur-user-links">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" >

                                        @if(\Auth::guard('user')->id())
                                        <img src="{{  (isset(Auth::guard('user')->user()->profile_image_url) ? Auth::guard('user')->user()->profile_image_url : url('public/assets/img/avatar.png')) }}" alt="avatar" class="img-fluid avatar">
                                        @else
                                        <img src="{{ url('public/assets/img/avatar.png') }}" alt="avatar" class="img-fluid avatar">
                                        @endif
                                        <div>
                                            @if(\Auth::guard('user')->id())
                                            <h6 class="user-name">{{ (isset(Auth::guard('user')->user()->name) ? Auth::guard('user')->user()->name :'Diamond Sutra User') }}</h6>
                                            @else
                                            <h6 class="user-name"></h6>
                                            @endif
                                        </div>
                                    </a>
                                    <ul class="user-menu ps-0" aria-labelledby="userDropdown">
                                        @if(!\Auth::guard('user')->id())
                                        <li><a href="{{url('login')}}">Login</a></li>
                                        <li><a href="{{url('sign-up')}}">Sign Up</a></li>
                                        @else
                                        <li><a href="{{url('user/profile')}}">Profile</a></li>
                                        <li><a href="{{url('user/orders')}}">My Orders</a></li>
                                        <li><a href="{{url('user/logout')}}">Logout</a></li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="d-flex align-items-center justify-content-center position-relative">
                            <button class="navbar-toggler text-black ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                            <a href="{{url('/')}}"><img src="{{url('public/assets/img/vertical-black-logo.svg')}}" class="header-logo w-100 img-fluid" alt="Diamond Sutra"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-header">
            <nav class="navbar navbar-expand-lg header-menu">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            @foreach($category as $c)
                            @if($c['id'] == 6 || $c['id'] == 5)
                            @continue
                            @endif
                            <li class="nav-item dropdown mega-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">{{$c['name']}}</a>
                                <div class="dropdown-menu">
                                    <div class="mega-menu-main-div">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>Shop By {{$c['name']}}</h5>
                                                        <ul>
                                                            @foreach($c['sub_category'] as $sc)
                                                            @if($c['id'] == 4 && $sc['name'] == 'Pendants without chain')
                                                            @continue
                                                            @endif
                                                            <li><a href="{{url('jewellery').'/'.$c['name'].'/'.str_replace(' ', '-',$sc['name'])}}">{{$sc['name']}}</a></li>
                                                            @endforeach
                                                            @if($c['id'] == 2)
                                                            <li>
                                                                <a href="{{url('jewellery/Bangles')}}"> Bangles </a>
                                                            </li>
                                                            @endif
                                                            <li><a href="{{url('jewellery').'/'.$c['name']}}">All {{$c['name']}}</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>Sort By</h5>
                                                        <ul>
                                                            <!--    <li>
                                                                <a href="#"> best selling </a>
                                                            </li> -->
                                                            <li>
                                                                <a href="{{url('jewellery').'/'.$c['name'].'?sort=popularity'}}"> highly rated </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery').'/'.$c['name'].'?sort=price'}}"> price low to high </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery').'/'.$c['name'].'?sort=price-desc'}}"> price high to low </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>By Price</h5>
                                                        <ul>
                                                            <li>
                                                                <a href="{{url('jewellery').'/'.$c['name'].'?range=0&to=10000'}}"> Below 10,000 </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery').'/'.$c['name'].'?range=10000&to=20000'}}"> Between 10k - 20k </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery').'/'.$c['name'].'?range=20000&to=30000'}}"> Between 20k - 30k</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery').'/'.$c['name'].'?range=30000&to=50000'}}"> Between 30k - 50k </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery').'/'.$c['name'].'?range=50000&to=1000000'}}"> 50,000 and Above</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mmd-img-box">
                                                    <img src="{{url('public/assets/img/'.strtolower($c['name']).'.jpg')}}" alt="img" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            <li class="nav-item dropdown mega-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">Solitaires</a>
                                <div class="dropdown-menu">
                                    <div class="mega-menu-main-div">
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>Solitaires Ring</h5>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <img src="{{url('public/assets/img/solitaire-ring.v1.webp')}}" alt="img" class="img-fluid">
                                                            </div>
                                                            <div class="col-6 text-center">
                                                                <a class="btn btn-outline-dark small-btn fw-bolder" href="{{url('design-your-own-diamond-rings?cat=rings')}}">Design your own</a>
                                                                <hr>
                                                                <a class="btn btn-outline-dark small-btn fw-bolder" href="{{url('solitaire-rings')}}">View all
                                                                    preset</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>Solitaires Pendants</h5>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <img src="{{url('public/assets/img/solitaire-pendant.v1.webp')}}" alt="img" class="img-fluid">
                                                            </div>
                                                            <div class="col-6 text-center">
                                                                <a class="btn btn-outline-dark small-btn fw-bolder" href="{{url('design-your-own-diamond-pendants?cat=pendants')}}">Design your own</a>
                                                                <hr>
                                                                <a class="btn btn-outline-dark small-btn fw-bolder" href="{{url('solitaire-pendants')}}">View all
                                                                    preset</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>Solitaires Earrings</h5>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <img src="{{url('public/assets/img/solitaire-earring.v1.webp')}}" alt="img" class="img-fluid">
                                                            </div>
                                                            <div class="col-6 text-center">
                                                                <a class="btn btn-outline-dark small-btn fw-bolder" href="{{url('design-your-own-diamond-earrings?cat=earrings')}}">Design your own</a>
                                                                <hr>
                                                                <a class="btn btn-outline-dark small-btn fw-bolder" href="{{url('solitaire-earrings')}}">View all
                                                                    preset</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="mmd-img-box">
                                                    <img src="{{url('public/assets/img/solitaires.jpg')}}" alt="img" class="img-fluid w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown mega-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">All Jewellery</a>
                                <div class="dropdown-menu">
                                    <div class="mega-menu-main-div">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>Shop By Product</h5>
                                                        <ul>
                                                            <li>
                                                                <a href="{{url('jewellery/Bangles')}}"> Bangles </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery/Bracelets')}}"> Bracelets </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery/Earrings')}}"> Earrings </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery/Pendants')}}"> Pendants </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('solitaire-rings')}}"> Solitaire Rings </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery/Rings/Office-Wear')}}"> Office wear Rings </a>
                                                            </li>
                                                           
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>Sort By</h5>
                                                        <ul>
                                                            <!-- <li>
                                                                <a href="#"> best selling </a>
                                                            </li> -->
                                                            <li>
                                                                <a href="{{url('jewellery/?sort=popularity')}}"> highly rated </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery/?sort=price')}}"> price low to high </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery/?sort=price-desc')}}"> price high to low </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>By Price</h5>
                                                        <ul>
                                                            <li>
                                                                <a href="{{url('jewellery?range=0&to=10000')}}"> Below 10,000 </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery?range=10000&to=20000')}}"> Between 10k - 20k </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery?range=20000&to=30000')}}"> Between 20k - 30k</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery?range=30000&to=50000')}}"> Between 30k - 50k </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{url('jewellery?range=50000&to=1000000')}}"> 50,000 and Above</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mmd-img-box">
                                                    <img src="{{url('public/assets/img/gold_jewellery.jpg')}}" alt="img" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown mega-dropdown">
                                <!-- <a class="nav-link dropdown-toggle" href="#" role="button" >Gifts</a>
                                <div class="dropdown-menu">
                                    <div class="mega-menu-main-div">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>Gifts By Occasion</h5>
                                                        <ul>
                                                            <li><a href="#">Anniversary</a></li>
                                                            <li><a href="#">Birthday</a></li>
                                                            <li><a href="#">Engagement</a></li>
                                                            <li><a href="#">Wedding</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>By Price Range</h5>
                                                        <ul>
                                                            <li><a href="#">Below 5,000</a></li>
                                                            <li><a href="#">Between 5k-10k</a></li>
                                                            <li><a href="#">Between 10k-20k</a></li>
                                                            <li><a href="#">Between 20k-30k</a></li>
                                                            <li><a href="#">30,000 and above</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="mega-menu-div">
                                                    <div class="mmd-box">
                                                        <h5>Gifts For Special Someone</h5>
                                                        <ul>
                                                            <li><a href="#">For HER<br>
                                                                    <small>Starting at Rs. 2,861/-</small></a></li>
                                                            <li><a href="#">For HIM<br>
                                                                    <small>Starting at Rs. 2,861/-</small></a></li>
                                                            <li><a href="#">For MOTHER<br>
                                                                    <small>Starting at Rs. 2,861/-</small></a></li>
                                                            <li><a href="#">For FATHER<br>
                                                                    <small>Starting at Rs. 2,861/-</small></a></li>
                                                            <li><a href="#">For WIFE<br>
                                                                    <small>Starting at Rs. 2,861/-</small></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="mmd-img-box">
                                                    <img src="{{url('public/assets/img/gift.jpg')}}" alt="img" class="img-fluid w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>


    <!-- Search Modal -->
    <div class="modal fade search-modal" id="searchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form action="#" class="product-search" onsubmit="return false">
                        <div class="input-group">
                            <input type="text" id="search-text" class="form-control" placeholder="Search products…">
                            <button type="button" id="search-btn" class="btn" data-bs-dismiss="modal"><i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>