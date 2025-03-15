@extends('layouts.site')
@section('content')
@php
$user_info = $body['user_info'];
$checkoutProduct = $body['checkoutProduct'];
@endphp
<main>
    <div class="page-title">
        <div class="container">
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li> -->
                        <li class="breadcrumb-item"><a href="#">Billing and Delivery</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="wishlist">
        <div class="container">
            <div class="row gy-4">


                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <h4 class="mb-3">ORDER SUMMARY</h4>
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <th class="p-2 border-bottom"><strong>Item Details</strong></th>
                                <td class="p-2 text-end border-bottom"><strong>Item Totals</strong></td>
                            </tr>
                            @foreach($checkoutProduct['order_items'] as $item)
                            @php
                            $quantity = 1;
                            if(isset($item['quantity']) && $item['quantity'] != '') $quantity = $item['quantity'];
                            @endphp
                            <tr>
                                <th class="p-2">{{$item['name']}} <b>x</b> ({{$quantity}})</th>
                                <td class="p-2 text-end">{{\General::currency_format($item['product_buy_price_with_gst'])}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th class="p-2 fw-bold">Total ({{$checkoutProduct['total_items']}} Items)</th>
                                <td class="p-2 text-end fw-bold">{{\General::currency_format($checkoutProduct['item_total'])}}</td>
                            </tr>
                           
                            @if($checkoutProduct['discount_total'] > 0)
                            <tr>
                                <th class="p-2 text-success">Coupon Discount</th>
                                <td class="p-2 text-end text-success">{{\General::currency_format($checkoutProduct['discount_total'])}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th class="p-2 fw-bold">Total Payable</th>
                                <td class="p-2 text-end fw-bold">{{\General::currency_format($checkoutProduct['order_total'])}}</td>
                            </tr>
                            <tr>
                                <th class="p-2 border-bottom"><strong>SHIPPING</strong></th>
                                <td class="p-2 text-end border-bottom"><strong>FREE SHIPPING</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr class="m-0">
                </div>
                <div class="col-12">
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <h5 class="mb-3">BILLING ADDRESS</h5>
                            <form id="checkout-form" action="{{url('confirm-and-pay')}}" method="post" onsubmit="return false;">
                                @csrf
                                @php
                                $email = "";
                                $phone_number = "";
                                $name = "";
                                if(!empty($user_info))
                                {
                                $email = $user_info['email'];
                                $phone_number = $user_info['number'];
                                $name = $user_info['name'];

                                $pieces = explode(" ", $name);
                                }

                                @endphp
                                <div class="row gy-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-transparent" id="b-fname" name="b_fname" placeholder="First Name" value="{{ (isset($pieces[0]) ? $pieces[0] : '') }}">
                                                <label for="b-fname">First Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-transparent" id="b-lname" name="b_lname" placeholder="Last Name" value="{{ (isset($pieces[1]) ? $pieces[1] : '') }}">
                                                <label for="b-Lname">Last Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="number" class="form-control bg-transparent" id="b-phone_number" name="b_phone_number" placeholder="Mobile No." value="{{ $phone_number }}">
                                                <label for="b-phone_number">Mobile No.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-transparent" id="b-email" name="b_email" placeholder="Email " value="{{ $email }}">
                                                <label for="b-email">Email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-transparent" id="b-address" name="b_address" placeholder="Address" value="">
                                                <label for="b-address">Address</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-transparent pincode-check" id="b-pincode" name="b_pincode" placeholder="pincode / ZIP" value="">
                                                <label for="b-pincode">Pincode / ZIP</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-transparent" id="b-state" name="b_state" placeholder="state" value="">

                                                <label for="b-state">State</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="text" class="form-control bg-transparent" id="b-city" name="b_city" placeholder="city" value="">
                                                <label for="b-city">City</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-floating d-none shipping-display fs-14" id="b-shipping-date-section">
                                                <b>Estimated delivery by </b>
                                                <input type="hidden" name="" id="expected_delivery_date" value="">
                                                <span id="b-date">10-12-2024 </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- check total amount above 2 lakh -->
                                    <div class="col-12 d-none" id="pan-number-section">
                                        <div class="form-group">
                                            <label for="pannumber" class="form-label"><strong>As per the Govt of India rules, PAN is
                                                    mandatory for all orders worth RS. 2 lakhs or above.</strong></label>
                                            <input type="text" class="form-control bg-transparent p-3" id="pannumber" name="pannumber" placeholder="Enter your PAN number here">
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="col-12">
                                        <div class="form-check">
                                            <!-- <div class="form-floating"> -->
                                            <input type="checkbox" class="form-check-input" id="same-as-billing-check" name="same_shipping" placeholder="Same shipping address" value="1" checked>
                                            <label class="form-check-label" for="same-as-billing-check">Ship Items To The Above Billing Address</label>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- </form> -->
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">SHIPPING ADDRESS</h5>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" id="shipping-address-btn" disabled type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Your Shipping
                                            Address Details</button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <!-- <form action="#"> -->
                                            <div class="row gy-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control bg-transparent" id="s-fname" name="s_fname" placeholder="First Name" value="">
                                                            <label for="s-fname">First Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control bg-transparent" id="s-lname" name="s_lname" placeholder="Last Name" value="">
                                                            <label for="s-Lname">Last Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control bg-transparent" id="s-phone_number" name="s_phone_number" placeholder="Mobile No." value="">
                                                            <label for="s-phone_number">Mobile No.</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control bg-transparent" id="s-email" name="s_email" placeholder="company " value="">
                                                            <label for="s-email">Email</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control bg-transparent" id="s-address" name="s_address" placeholder="Address" value="">
                                                            <label for="s-address">Address</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control bg-transparent pincode-check" id="s-pincode" name="s_pincode" placeholder="pincode / ZIP" value="">
                                                            <label for="s-pincode">Pincode / ZIP</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control bg-transparent" id="s-state" name="s_state" placeholder="state" value="">

                                                            <label for="s-state">State</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control bg-transparent" id="s-city" name="s_city" placeholder="city" value="">
                                                            <label for="s-city">City</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="form-floating d-none shipping-display" id="s-shipping-date-section">
                                                            <b>Estimated delivery by : </b>
                                                            <span id="s-date">10-12-2024 </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button id="confirm-and-pay" class="btn btn-dark ">Procced to payment <span id="checkout" style="display:none"><i class="fa fa-spinner fa-spin"></i></span></button>
                </div>
            </div>
        </div>
    </div>
</main>
@stop
@section('footer')
<script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
<script>
    /* The redirect to autoplay page function */
    function redirect() {
        window.location.href = `{{ asset('/') }}`;
    }
    var initial = setTimeout(redirect, 1800000);
    console.log(initial);
    $(document).click(function(event) {
        clearTimeout(initial);
        initial = setTimeout(redirect, 1800000);
    });
    $(document).ready(function() {
        $('.pincode-check').on('input', function() {
            let display;
            if ($("#same-as-billing-check").is(":checked"))
                display = 'b';
            else
                display = 's';
            var pincode = $('#' + display + '-pincode').val();
            var state = $('#' + display + '-state').val();

            if (pincode.length === 6) {
                var base_url = $('#base_url').val();
                $.ajax({
                    url: base_url + '/pincode/check',
                    method: 'POST',
                    data: {
                        pincode: pincode,
                        state: state,
                        _token: $('#token').val()
                    },
                    success: function(res) {
                        if (res.flag === 1) {
                            $('#expected_delivery_date').val(res.data)
                            $('#make-checkout').removeAttr('disabled');
                            $('.shipping-display').addClass('d-none');
                            $('#' + display + '-date').text(res.data);
                            $('#' + display + '-shipping-date-section').removeClass('d-none');
                            $('#b-state').val(res.state);
                            $('#b-city').val(res.city);
                            $('#b-state').attr('readonly', true);
                            $('#b-city').attr('readonly', true);
                            $('#s-state').val(res.state);
                            $('#s-city').val(res.city);
                            $('#s-state').attr('readonly', true);
                            $('#s-city').attr('readonly', true);
                        } else {
                            $('#expected_delivery_date').val()
                            $('#make-checkout').attr('disabled', true);
                            $('#b-date').text('');
                            $('#s-date').text('');
                            $('#s-shipping-date-section').addClass('d-none');
                            $('#b-shipping-date-section').addClass('d-none');
                            Toast(res.msg, 3000, res.flag);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            }
        });


        calculateTotal();

        function calculateTotal() {
            let cart = JSON.parse(localStorage.getItem('cart')) || {};
            let appliedCoupon = JSON.parse(localStorage.getItem('appliedCoupon')) || null;

            let total = 0;
            let discount = 0;
            let itemCount = 0;

            $.each(cart, function(id, details) {
                total += details.final_price ? details.final_price : details.product_buy_price_with_gst;
                itemCount++;
            });

            if (total >= 200000) {
                $('#pan-number-section').removeClass('d-none');
            } else {
                $('#pan-number-section').addClass('d-none');
            }


        }



        $(document).on('click', '#confirm-and-pay', function() {
            $('#checkout').show();
            $("#make-checkout").prop("disabled", true);

            let base_url = $('#base_url').val();
            let token = $('#token').val();

            $("#checkout-form").ajaxForm(async function(res) {
                    $('#checkout').hide();
                    if (res.flag === 1) {
                        let orderAmount = await res.data.order_amount;
                        // $("#checkout-form")[0].reset();
                        // setTimeout(function () {
                        //     // window.location.href = $('#base_url').val() + "/order-detail/" + res.data.order_id
                        //     window.location.href = $('#base_url').val() + "/thank-you/" + res.data.order_id;
                        // }, 1000);

                        var value = new FormData();
                        var token = $("#token").val();
                        let expected_delivery_date = $('#expected_delivery_date').val();
                        value.append('_token', token);
                        value.append('expected_delivery_date', expected_delivery_date);
                        value.append('amount', orderAmount);
                        value.append('phone_no', $('#b-phone_number').val());
                        value.append('user_name', $('#b-fname').val() + ' ' + $('#b-lname').val());
                        value.append('email', $('#b-email').val());
                        $.ajax({
                            url: $('#base_url').val() + "/create-order",
                            type: 'post',
                            data: value,
                            contentType: false,
                            processData: false,
                            success: function(res) {
                                console.log(res)
                                if (res.flag == 1) {
                                    localStorage.removeItem('cart');
                                    localStorage.removeItem('appliedCoupon');
                                    localStorage.removeItem('selected_solitaire');
                                    const cashfree = Cashfree({
                                        mode: "sandbox" //or production, // sandbox
                                    });
                                    cashfree.checkout({
                                        paymentSessionId: res.payment_session_id,
                                    });
                                }
                            }
                        })
                    } else {
                        Toast(res.msg, 3000, res.flag);
                    }
                    $("#make-checkout").prop("disabled", false);
                })
                .submit();
        });

    });
</script>
@stop