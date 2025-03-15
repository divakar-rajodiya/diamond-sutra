<!DOCTYPE html>
<html lang="en">

<head>
  <title>Log In</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="{{url('public/assets/img/favicon.png')}}">

  <link rel="stylesheet" href="{{url('public/assets/css/site/login.min.css')}}">
</head>

<body>
  <input type="hidden" name="" id="redirect" value="{{$body['redirect']}}">
  <div class="loader" id="loader">
    <div class="loader-inner"></div>
  </div>


  <div class="login-wrapper d-flex align-items-center justify-content-center vh-100 bg-light text-dark">
    <div class="row justify-content-center w-100">

      <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 text-center position-relative">
        <a href="{{url('/')}}" class="mb-4 d-block">
          <img src="{{url('public/assets/img/vertical-black-logo.svg')}}" alt="" style="width: 300px">
        </a>
        <div class="card p-4 shadow rounded-3 mt-5">
          <h3 class="mb-4 fw-bold">Log In</h3>
          <ul class="nav nav-tabs row" id="loginTabs" role="tablist">
            <li class="nav-item col-md-6" role="presentation">
              <button class="nav-link w-100 active" id="mobileLogin-tab" data-bs-toggle="tab" data-bs-target="#mobileLogin" type="button" role="tab" aria-controls="mobileLogin" aria-selected="false">By Mobile</button>
            </li>
            <li class="nav-item col-md-6" role="presentation">
              <button class="nav-link w-100" id="emailLogin-tab" data-bs-toggle="tab" data-bs-target="#emailLogin" type="button" role="tab" aria-controls="emailLogin" aria-selected="true">By Email</button>
            </li>
          </ul>
          <div class="p-3"></div>
          <div class="tab-content" id="loginTabContent">
            <div class="tab-pane fade show active" id="mobileLogin" role="tabpanel" aria-labelledby="mobileLogin-tab">
              <form method="post" action="{{url('mobile-login')}}" class="" id="mobile-login-form" onsubmit="return false;">
                @csrf
                <div class="form-floating w-100 mb-3">
                  <input type="number" class="form-control bg-transparent" id="phone_number" name="phone_number" placeholder="name@example.com" value="">
                  <label for="phone_number">Mobile No.</label>
                </div>
                <button type="button" id="mobile-login-btn" class="btn">Send OTP</button>
              </form>
            </div>
            <div class="tab-pane fade" id="emailLogin" role="tabpanel" aria-labelledby="emailLogin-tab">
              <form method="post" action="{{url('login')}}" class="" id="login-form" onsubmit="return false;">
                @csrf
                <div class="form-floating w-100 mb-3">
                  <input type="email" class="form-control bg-transparent" id="email" name="email" placeholder="name@example.com" value="">
                  <label for="email">Email address</label>
                </div>
                <div class="form-floating w-100 mb-3">
                  <input type="password" class="form-control bg-transparent" id="password" name="password" placeholder="password" value="">
                  <label for="password">Password</label>
                </div>
                <p class="switcher-text forgot-password text-end"><a href="{{url('forget-password')}}">Forgot password?</a></p>
                <button type="button" id="login-btn" class="btn">Log In</button>
              </form>
            </div>

          </div>
          <p class="switcher-text mt-3">Don't have an account? <a href="{{url('sign-up')}}">Sign Up</a></p>
        </div>
      </div>
    </div>
  </div>

  <script src="{{url('public/assets/js/site/login.min.js')}}"></script>
  <script>
    jQuery(document).ready(function() {
      $(".loader").fadeOut("slow");
    });

    $(document).on('click', '#login-btn', function() {
      let redirect = $('#redirect').val();
      $('#login-btn').prop('disabled', true);
      $('#login-form').ajaxForm(function(res) {
        Toast(res.msg, 3000, res.flag);
        if (res.flag == 1) {
          $('#login-form ')[0].reset();
          setTimeout(function() {
            if(redirect === 'checkout') window.location.replace("{{url('/checkout')}}/");
            else window.location.replace("{{url('/')}}");
          }, 1000);
        }
        $('#login-btn').prop('disabled', false);
      }).submit();
    })
    $(document).on('click', '#mobile-login-btn', function() {
      $('#mobile-login-btn').prop('disabled', true);
      $('#mobile-login-form').ajaxForm(function(res) {
        Toast(res.msg, 3000, res.flag);
        if (res.flag == 1) {
          $('#mobile-login-form ')[0].reset();
          setTimeout(function() {
            window.location.replace("{{url('/verify-otp')}}/"+res.data.user_id);
          }, 1000);
        }
        $('#mobile-login-btn').prop('disabled', false);
      }).submit();
    })
  </script>
</body>

</html>