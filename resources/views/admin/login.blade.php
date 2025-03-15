<!DOCTYPE html>
<html lang="en">

<head>
    <title>Log In</title>
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


    <div class="d-flex align-items-center justify-content-center vh-100 bg-light text-dark">
        <div class="row justify-content-center w-100">
            <div class="col-sm-7 col-md-6 col-lg-5 col-xl-4 col-xxl-3 text-center">
                <img class="mb-5" src="{{url('public/assets/img/logo.png')}}" style="width: 200px;">
                <div class="card p-4">
                    <h3 class="mb-4 fw-bold">Log In</h3>
                    @if(isset($errors) && $errors->first()!='')
                    <div class="alert alert-danger" style="text-align: center;">
                        <strong>{{$errors->first()}}</strong>
                    </div>
                    @endif
                    <form name="form" method='Post' action="{{URL::to('admin/login')}}">
                        @csrf
                        <div class="form-floating w-100 mb-3">
                            <input type="email" name="email" class="form-control bg-transparent" id="floatingInputGrid" placeholder="name@example.com" value="">
                            <label for="floatingInputGrid">Email address</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="password" name="password" class="form-control bg-transparent" id="floatingInputGrid2" placeholder="password" value="">
                            <label for="floatingInputGrid2">Password</label>
                        </div>
                        <button type="submit" class="btn btn-lg text-uppercase w-100 rounded-5 text-white">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{url('public/assets/js/admin/admin_common.min.js')}}"></script>