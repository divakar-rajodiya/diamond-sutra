@extends('layouts.admin')
@section('content')
@php
$setting = $body['setting'];
@endphp
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card p-4 bg-light text-dark">
                    <h3 class="mb-4 fw-bold">Settings</h3>
                    <form action="{{url('admin/save-settings')}}" method="post" id="save_setting_form">
                        @csrf
                        <input type="hidden" name="setting_type" value="general">
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="price_IJ_SI" name="price_IJ_SI" placeholder="Old Password" value="{{$setting['price_IJ_SI']}}">
                            <label for="price_IJ_SI">IJ SI Diamond</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="price_GH_SI" name="price_GH_SI" placeholder="Old Password" value="{{$setting['price_GH_SI']}}">
                            <label for="price_GH_SI">GH SI Diamond</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="price_GH_VS" name="price_GH_VS" placeholder="Old Password" value="{{$setting['price_GH_VS']}}">
                            <label for="price_GH_VS">GH VS Diamond</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="price_EF_VVS" name="price_EF_VVS" placeholder="Old Password" value="{{$setting['price_EF_VVS']}}">
                            <label for="price_EF_VVS">EF VVS Diamond</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="default_delivery_period" name="default_delivery_period" placeholder="Default Estimated Delivery Period" value="{{$setting['default_delivery_period']}}">
                            <label for="price_EF_VVS">Default Estimated Delivery Period</label>
                        </div>
                       
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="diamond_discount" name="diamond_discount" placeholder="diamond discount" value="{{$setting['diamond_discount']}}">
                            <label for="diamond_discount">Diamond Discount</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="making_discount" name="making_discount" placeholder="diamond discount" value="{{$setting['making_discount']}}">
                            <label for="making_discount">Making Charge Discount</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="usd_to_inr_rate" name="usd_to_inr_rate" placeholder="Usd exchange rate" value="{{$setting['usd_to_inr_rate']}}">
                            <label for="usd_to_inr_rate">USD to INR</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="gold_rate_14k" name="gold_rate_14k" placeholder="Gold rate 14k" value="{{$setting['gold_rate_14k']}}">
                            <label for="gold_rate_14k">Gold Rate 14K</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" id="gold_rate_18k" name="gold_rate_18k" placeholder="Gold rate 18l" value="{{$setting['gold_rate_18k']}}">
                            <label for="gold_rate_18k">Gold Rate 18K</label>
                        </div>
                        <button type="button" id="save_setting_btn" class="btn btn-lg gradient-btn text-white text-uppercase w-100 rounded-pill">Save</button>
                    </form>
                </div>
                <div class="p-4"></div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content bg-light text-dark">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-floating w-100 mb-3">
                                        <input type="email" class="form-control bg-transparent" id="floatingInputGrid" placeholder="name@example.com" value="">
                                        <label for="floatingInputGrid">Email address</label>
                                    </div>
                                    <div class="form-floating w-100 mb-3">
                                        <input type="password" class="form-control bg-transparent" id="floatingInputGrid2" placeholder="password" value="">
                                        <label for="floatingInputGrid2">Password</label>
                                    </div>
                                    <button type="button" class="btn btn-lg text-white text-uppercase w-100 rounded-5">Log In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('footer')
    @stop