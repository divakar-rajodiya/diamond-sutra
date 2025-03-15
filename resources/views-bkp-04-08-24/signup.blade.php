<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{url('public/assets/img/favicon.png')}}">

    <link rel="stylesheet" href="{{url('public/assets/css/site/login.min.css')}}">
</head>

<body>
    <div class="loader" id="loader">
        <div class="loader-inner"></div>
    </div>

    <div class="login-wrapper d-flex align-items-center justify-content-center vh-100 bg-light text-dark">
        <div class="row justify-content-center w-100">
            <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 text-center position-relative">
                <a href="{{url('/')}}" class="d-block mb-4">
                    <img src="{{url('public/assets/img/vertical-black-logo.svg')}}" style="width: 300px" />
                </a>
                <div class="card p-4 shadow rounded-3 mt-5">
                    <h3 class="mb-4 fw-bold">Sign Up</h3>
                    <form id="sign-up-form" method="post" action="{{url('signup')}}" onsubmit="return false;">
                        @csrf
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" name="name" id="name" placeholder="john doe" />
                            <label for="name">Full Name *</label>
                        </div>
                        <!-- <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="last_name" placeholder="duo" />
                            <label for="last_name">Last Name</label>
                        </div> -->
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" name="phone_number" id="mobile" placeholder="1234567890" />
                            <label for="mobile">Mobile no *</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="email" class="form-control bg-transparent" name="email" id="email" placeholder="name@example.com" />
                            <label for="email">Email address</label>
                        </div>
                        <!-- <div class="form-floating w-100 mb-3">
                            <input type="password" class="form-control bg-transparent" name="password" id="password" placeholder="password" />
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="password" class="form-control bg-transparent" name="confirm_password" id="confirm_password" placeholder="confirm password" />
                            <label for="confirm_password">Confirm Password</label>
                        </div> -->
                        <div class="form-floating form-check w-100 mb-3">
                            <input type="checkbox" class="form-check-input" name="is_accept" id="is_accept" value="1"> <a href="{{url('terms-conditions')}}" target="_blank">Accept Terms of service</a>
                        </div>
                        <button type="button" class="btn" id="sign-up-btn">Sign Up</button>
                        <p class="switcher-text mt-3">Already have an account? <a href="{{url('login')}}">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{url('public/assets/js/site/login.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            $(".loader").fadeOut("slow");
        });
        $(document).on('click', '#sign-up-btn', function() {
            $('#sign-up-btn').prop('disabled', true);
            $('#sign-up-form').ajaxForm(function(res) {
                Toast(res.msg, 3000, res.flag);
                if (res.flag == 1) {
                    $('#sign-up-form ')[0].reset();
                    setTimeout(function() {
                        window.location.replace("{{url('verify-otp')}}/"+res.data.user_id);
                    }, 1000);
                }
                $('#sign-up-btn').prop('disabled', false);
            }).submit();
        })
    </script>
</body>

</html>