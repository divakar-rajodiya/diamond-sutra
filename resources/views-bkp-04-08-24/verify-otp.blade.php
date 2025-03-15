<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $header['title'] }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ url('public/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/site/login.min.css') }}">
    <input type="hidden" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="base_url" value="{{ url('/') }}">
</head>

<body>
    <div class="loader" id="loader">
        <div class="loader-inner"></div>
    </div>

    <div class="login-wrapper d-flex align-items-center justify-content-center vh-100 bg-light text-dark">
        <div class="row justify-content-center w-100">
            <div class="col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 text-center position-relative">
                <a href="{{ url('/') }}" class="mb-4 d-block">
                    <img src="{{ url('public/assets/img/vertical-black-logo.svg') }}" alt=""
                        style="width: 300px">
                </a>
                <div class="card p-4 shadow rounded-3 mt-5">
                    <h3 class="mb-4 fw-bold">Verify OTP</h3>
                    <form method="post" action="{{ url('verify-user-otp') }}" class="" id="verify-otp-form"
                        onsubmit="return false;">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id" value="{{ $body['user_id'] }}">
                        <div class="form-floating w-100 mb-3">
                            <input type="number" class="form-control bg-transparent" id="otp" name="otp"
                                placeholder="enter otp" value="">
                            <label for="otp">OTP</label>
                        </div>
                        <p class="switcher-text text-end cursor-pointer"><button type="button" id="resendOtpBtn" class="btn d-none">Resend Otp </button><span
                                id="future-date"></span></p>
                        <button type="button" id="verify-otp-btn" class="btn">Verify</button>
                    </form>
                    <div id="otp-text" class="alert alert-warning text-center d-none mt-3" role="alert">
                        Remaining OTP attempts: <span class="otp-attempts">3</span>/3
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('public/assets/js/site/login.min.js') }}"></script>
    <script src="{{ url('public/assets/js/site/jquery.countdownTimer.js') }}"></script>
    <script>
        sixtyTimer();
        let otpCount = 3;
        $('#otp-text').removeClass('d-none')
        function sixtyTimer() {
            $('#future-date').countdowntimer({
                seconds: 60,
                loop: false,
                size: "lg",
                // borderColor: '#ff0000',
                fontColor: '#ff0000',
                backgroundColor: '#fff',
                timeUp: function() {
                    if (otpCount > 0) {
                        toggleResendTrue();
                    } else {
                        $('#verify-otp-btn').prop('disabled', true);
                        Swal.fire('error', 'OTP expired!');
                    }
                }
            });
        }

        function toggleResendTrue() {
            $('#future-date').addClass('d-none');
            $('#verify-otp-btn').addClass('d-none');
            $('#verify-otp-btn').prop('disabled', true);

            $('#resendOtpBtn').removeClass('d-none');
            $('#resendOtpBtn').prop('disabled', false);
        }

        function toggleResendFalse() {
            $('#future-date').removeClass('d-none');
            $('#verify-otp-btn').removeClass('d-none');
            $('#verify-otp-btn').prop('disabled', false);

            $('#resendOtpBtn').addClass('d-none');
            $('#resendOtpBtn').prop('disabled', true);
        }

        $(document).ready(function() {
            $(".loader").fadeOut("slow");
            var resendOtpBtn = $('#resendOtpBtn');

            // Start the timer when the link is clicked
            resendOtpBtn.on('click', function(e) {
                e.preventDefault();
                if (!resendOtpBtn.hasClass('disabled')) {
                    // startTimer();
                    let base_url = $('#base_url').val();
                    let token = $('#token').val();
                    let userId = $('#user_id').val();
                    let otpType = 0;
                    otpCount -= 1;
                    $.ajax({
                        type: 'POST',
                        url: base_url + '/resend-otp',
                        // dataType: 'json',
                        data: {
                            user_id: userId,
                            otp_type: otpType,
                            _token: token
                        },
                        // contentType: "application/json",
                        // async:false,
                        success: function(res) {
                            sixtyTimer();
                            toggleResendFalse();
                            $('.otp-attempts').html(otpCount);
                            Toast(res.msg, 3000, res.flag);
                        },
                    });
                    // console.log('Resending OTP...');
                }
            });
        });

        $(document).on('click', '#verify-otp-btn', () => {
            $('#verify-otp-btn').prop('disabled', true);
            $('#verify-otp-form').ajaxForm(function(res) {
                Toast(res.msg, 3000, res.flag);
                if (res.flag == 1) {
                    $('#verify-otp-form ')[0].reset();
                    setTimeout(function() {
                        window.location.replace("{{ url('/') }}");
                    }, 1000);
                }
                $('#verify-otp-btn').prop('disabled', false);
            }).submit();
        })
    </script>
</body>

</html>
