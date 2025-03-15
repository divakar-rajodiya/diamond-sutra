<!DOCTYPE html>
<html lang="en">

<head>
    <title>404 Page Not Found</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel='icon' type='image/x-icon' href="{{url('public/assets/img/favicon.png')}}" />
    <link rel="stylesheet" href="{{url('public/assets/css/admin/admin_style.min.css')}}" />
</head>

<body>
    <div class="loader" id="loader">
        <div class="loader-inner">
        </div>
    </div>

    <!-- <div class="d-flex align-items-center justify-content-center vh-100 text-dark">
        <div class="row justify-content-center w-100">
            <div class="col-md-7 col-lg-4">
                <div class="border rounded-5 py-5 bg-light shadow-lg text-center">
                    <h1 class="fw-bolder">404</h1>
                    <h3 class="text-uppercase mb-5 fw-lighter">Ooop! Page not found.</h3>
                    <a href="{{url('/')}}" class="btn text-white rounded-5 py-3 px-5 text-uppercase">Back to Home</a>
                </div>
            </div>
        </div>
    </div> -->

    <div class="d-flex align-items-center justify-content-center vh-100 text-dark text-center">
        <div class="row justify-content-center w-100">
            <div class="col-md-7 col-lg-4">
                <img src="{{url('public/assets/img/404.svg')}}" alt="404" class="opacity-25">
                <h1 class="text-uppercase my-5 fw-lighter">Ooop! Page not found.</h1>
                <a href="{{url('/')}}" class="btn primary-btn large-btn text-uppercase">Back to Home</a>
            </div>
        </div>
    </div>

</body>

<script src="{{url('public/assets/js/admin/admin_common.min.js')}}"></script>