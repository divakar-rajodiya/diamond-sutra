<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forget Password</title>
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
                    <h3 class="mb-4 fw-bold">Forget Password</h3>
                    <form id="sign-up-form" method="post" action="{{url('forget-password')}}" onsubmit="return false;">
                        @csrf
                        
                        <div class="form-floating w-100 mb-3">
                            <input type="email" class="form-control bg-transparent" name="email" id="email" placeholder="Enter your registerd email" />
                            <label for="email">Enter your registerd email</label>
                        </div>
                        <button type="button" class="btn" id="sign-up-btn">Forget Password <span id="forget-password" style="display:none"><i
                                                class="fas fa-spinner fa-spin"></i></span></button>
                        <p class="switcher-text mt-3">Already have an account? <a href="{{url('login')}}">Sign in </a></p>
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
            $('#forget-password').show();
            $('#sign-up-btn').prop('disabled', true);
            $('#sign-up-form').ajaxForm(function(res) {
                Toast(res.msg, 3000, res.flag);
                $('#forget-password').hide();
                if (res.flag == 1) {
                    $('#sign-up-form ')[0].reset();
                    setTimeout(function() {
                        window.location.replace("{{url('login')}}");
                    }, 1000);
                }
                $('#sign-up-btn').prop('disabled', false);
            }).submit();
        })
    </script>
</body>

</html>