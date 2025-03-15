<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$header['title']}}</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel='icon' type='image/x-icon' href="{{url('/public/assets/img/favicon.png')}}" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.21.0/slimselect.css'>
    <link rel="stylesheet" href="{{url('public/assets/css/admin/admin_style.min.css')}}" />
    <input type="hidden" id="token" value="{{csrf_token()}}">
</head>

<body>

    <div class="loader" id="loader">
        <div class="loader-inner">
        </div>
    </div>

    <header>
        <nav class="cat-topnav navbar navbar-expand">
            <!-- Navbar Brand-->
            <a class="navbar-brand" href="index.html">
                <img src="{{url('public/assets/img/logo.png')}}" alt="" class="navbar-horizontal-logo">
                <img src="{{url('public/assets/img/logo-icon.png')}}" alt="" class="navbar-icon">
            </a>

            <h4 class="m-0 text-dark ms-4">{{$body['label']}}</h4>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{url('public/assets/img/avatar.png')}}" alt="avatar" class="img-fluid rounded-circle border" style="height: 40px;">
                        <div class="fs-6 text-dark mx-2">Admin <small class="d-block small text-dark">Admin</small></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item py-2" href="{{url('admin/profile')}}">
                                <i class="fa fa-user me-2"></i>Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{url('admin/logout')}}">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>


            <!-- Sidebar Toggle-->
            <button class="btn p-3 d-block d-lg-none" id="sidebarToggle">
                <span class="navbar-toggler-bars"></span>
                <span class="navbar-toggler-bars"></span>
                <span class="navbar-toggler-bars"></span>
            </button>
        </nav>
    </header>

    <div class="layout-sidenav">

        <div class="layout-sidenav-nav">
            <nav class="cat-sidenav accordion" id="sidenavAccordion">
                <div class="cat-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link {{\Request::is('admin/dashboard') ? 'active' : ''}}" href="{{url('/admin/dashboard')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-gauge-high"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link {{\Request::is('admin/user') ? 'active' : ''}}" href="{{url('/admin/user')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Users
                        </a>
                        <a class="nav-link {{\Request::is('admin/product/*') || \Request::is('admin/product') ? 'active' : ''}}" href="{{url('/admin/product')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-gem"></i></div>
                            Products
                        </a>
                        <a class="nav-link {{\Request::is('admin/category') ? 'active' : ''}}" href="{{url('/admin/category')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                            Category
                        </a>
                        <a class="nav-link {{\Request::is('admin/subcategory') ? 'active' : ''}}" href="{{url('/admin/subcategory')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                            Sub Category
                        </a>
                        <a class="nav-link {{\Request::is('admin/solitaire-price') ? 'active' : ''}}" href="{{url('/admin/solitaire-price')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-ticket"></i></div>
                            Solitaire Price
                        </a>
                        <a class="nav-link {{\Request::is('admin/order') ? 'active' : ''}}" href="{{url('/admin/order')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-ticket"></i></div>
                            Order
                        </a>
                        <a class="nav-link {{\Request::is('admin/pincode') ? 'active' : ''}}" href="{{url('/admin/pincode')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-thumbtack"></i></div>
                            Pincode
                        </a>
                        <a class="nav-link {{\Request::is('admin/coupon') ? 'active' : ''}}" href="{{url('/admin/coupon')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-ticket"></i></div>
                            Coupons
                        </a>
                        <a class="nav-link {{\Request::is('admin/banner') ? 'active' : ''}}" href="{{url('/admin/banner')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-panorama"></i></div>
                            Banners
                        </a>
                        <a class="nav-link {{\Request::is('admin/testimonial') ? 'active' : ''}}" href="{{url('/admin/testimonial')}}">
                            <div class="cat-nav-link-icon"><i class="fa-regular fa-star-half-stroke fa-fw"></i></div>
                            Testimonial
                        </a>
                        <a class="nav-link {{\Request::is('admin/product-review') ? 'active' : ''}}" href="{{url('/admin/product-review')}}">
                            <div class="cat-nav-link-icon"><i class="fa-regular fa-star-half-stroke fa-fw"></i></div>
                            Product Review
                        </a>
                        <a class="nav-link {{\Request::is('admin/contact-us') ? 'active' : ''}}" href="{{url('/admin/contact-us')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-address-book"></i></div>
                            Contact Us
                        </a>
                        <a class="nav-link {{\Request::is('admin/subscribe-us') ? 'active' : ''}}" href="{{url('/admin/subscribe-us')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-paper-plane"></i></div>
                            Newsletter
                        </a>
                        <a class="nav-link {{\Request::is('admin/settings') ? 'active' : ''}}" href="{{url('/admin/settings')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-gears"></i></div>
                            Settings
                        </a>
                        <!-- <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseBillList" aria-expanded="false" aria-controls="collapseBillList">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-diagram-project"></i></div>
                            Menu 2
                            <div class="cat-sidenav-collapse-arrow"><i class="fa-solid fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseBillList" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="cat-sidenav-menu-nested nav">
                                <a class="nav-link" href="">
                                    <div class="cat-nav-link-icon"><i class="fa-solid fa-star"></i></div>
                                    Sub Menu
                                </a>
                                <a class="nav-link" href="">
                                    <div class="cat-nav-link-icon"><i class="fa-solid fa-star"></i></div>
                                    Sub Menu 2
                                </a>
                                <a class="nav-link" href="">
                                    <div class="cat-nav-link-icon"><i class="fa-solid fa-star"></i></div>
                                    Sub Menu 3
                                </a>
                            </nav>
                        </div> -->
                    </div>
                </div>
            </nav>
        </div>
