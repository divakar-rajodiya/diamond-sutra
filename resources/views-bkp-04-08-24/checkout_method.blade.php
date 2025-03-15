@extends('layouts.site')
@section('content')
@php

@endphp
<main>

    <div class="wishlist">
        <div class="container">
            <div class="row gy-4 gy-md-5">
                <div class="col-lg-6">
                    <h4 class="mb-3">Select Checkout Method</h4>
                    <!-- <div class="p-4 border">
                        <form action="#">
                            <div class="mb-3">
                                <h5 class="fw-bold">CREATE AN ACCOUNT</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="account" id="createAc" checked>
                                    <label class="form-check-label" for="createAc">Flat rate</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h5 class="fw-bold">GUEST CHECKOUT</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="account" id="guestAc">
                                    <label class="form-check-label" for="guestAc">Free shipping</label>
                                </div>
                            </div>
                            <button class="btn primary-btn">continue</button>
                        </form>
                    </div> -->
                    <div class="p-4 border">
                        <div class="row justify-content-between gy-3">
                            <div class="col-md-6">
                                <!-- <form action="#" class=""> -->
                                    <div class="mb-3">
                                        <a href="{{url('login')}}?redirect=checkout">
                                            <h5 class="fw-bold">SIGN IN</h5>
                                        </a>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="fw-bold">GUEST CHECKOUT</h5>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="account" id="guestAc" checked>
                                            <label class="form-check-label" for="guestAc">Continue as guest</label>
                                        </div>
                                    </div>
                                    <a href="{{url('checkout?login_type=guest')}}" class="btn primary-btn continue-checkout-btn">continue</a>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop
@section('footer')


@stop