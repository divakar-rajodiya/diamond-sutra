@extends('layouts.admin')
@section('header')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@stop
@section('content')
<div class="layout-sidenav-content">

    <div class="p-4 p-md-5">
        <button type="button" class="btn text-white" id="add_coupon_modal">Add New Coupon</button>
        <div class="col-lg-12">
            <div class="p-4"></div>
            <div class="table-responsive" id="coupon-table">

            </div>
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
            <div class="p-4"></div>
        </div>
    </div>


    <div class="modal fade" id="addCouponModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCouponModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCouponModalLabel">Add New Coupon</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="add_coupon_form" method="post" action="{{url('admin/coupon/add')}}">
                            @csrf
                            <div class="form-floating d-flex w-100 mb-3">
                                <input type="text" class="form-control bg-transparent" name="coupon_name" id="coupon_name" placeholder="coupon" value="">
                                <input type="hidden" id="is_valid_coupon" value="">
                                <label for="coupon_name">Coupon Code</label>
                                <button type="button" id="validate_coupon" class="btn btn-dark m-2">Validate</button>
                                <label for="validate_coupon">Coupon Code</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select bg-transparent" name="coupon_type" id="coupon_type" aria-label="Floating label select example">
                                    <option selected value="0">Discount on Total amount</option>
                                    <option value="1">Discount on Diamond</option>
                                    <option value="2">Discount on Making</option>
                                </select>
                                <label for="coupon_type">Coupon Type</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select bg-transparent" name="coupon_for" id="coupon_for" aria-label="Floating label select example">
                                    <option selected value="0">All Customers</option>
                                    <option value="1">For Specific</option>
                                </select>
                                <label for="coupon_for">Coupon For</label>
                            </div>

                            <div class="form-floating d-none mb-3" id="customer_mobile_section">
                                <input type="number" class="form-control bg-transparent" name="coupon_for_customer" id="coupon_for_customer" placeholder="Mobole No." value="" style="text-transform:uppercase">
                                <label for="coupon_for_customer">Customer Mobile No.</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select bg-transparent" name="discount_type" id="discount_type" aria-label="Floating label select example">
                                    <option value="0">Flat</option>
                                    <option value="1">Percentage</option>
                                </select>
                                <label for="discount_type">Discount Type</label>
                            </div>
                            <div class="form-floating w-100 mb-3">
                                <input type="number" class="form-control bg-transparent" name="discount" id="coupon_discount" placeholder="Discount" value="">
                                <label for="coupon_discount">Discount</label>
                            </div>
                            <div class="form-floating w-100 mb-3">
                                <input type="number" class="form-control bg-transparent" name="min_amount" id="min_amount" placeholder="Discount up to" value="">
                                <label for="min_amount">Order Min Amount</label>
                            </div>
                            <div class="form-floating w-100 mb-3 d-none" id="discount-up-to-div">
                                <input type="number" class="form-control bg-transparent" name="up_to_amount" id="up_to_amount" placeholder="Discount up to" value="">
                                <label for="up_to_amount">Discount up to</label>
                            </div>
                            <div class="form-floating w-100 mb-3">
                                <input type="number" class="form-control bg-transparent" name="quantity" id="quantity" placeholder="Quantity" value="">
                                <label for="quantity">Quantity</label>
                            </div>
                            <div class="form-floating w-100 mb-3">
                                <input type="date" class="form-control bg-transparent" name="expiry_date" id="expiry_date" placeholder="Expiry Date" value="">
                                <label for="expiry_date">Expiry Date</label>
                            </div>

                            <div class="form-floating d-flex w-100 mb-3">
                                <input type="text" class="form-control bg-transparent" name="coupon_note" id="coupon_note" placeholder="coupon note" value="">
                                <label for="coupon_note">Coupon Note</label>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <label class="form-check-label" for="coupon_status">Status</label>
                                <input class="form-check-input" type="checkbox" name="status" role="switch" id="coupon_status" checked="">
                            </div>
                            <button type="button" id="add_coupon_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCouponModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCouponModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editCouponModalLabel">Update Coupon</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_coupon_form" method="post" action="{{url('admin/coupon/update')}}">
                        @csrf
                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-floating d-flex w-100 mb-3">
                            <input type="text" class="form-control bg-transparent disabled" id="update_coupon_name" placeholder="coupon" value="" readonly disabled>
                            <!-- <input type="hidden" id="is_valid_coupon" value=""> -->
                            <label for="update_coupon_name">Coupon Code</label>
                            <!-- <button type="button" id="validate_coupon" class="btn btn-dark m-2">Validate</button> -->
                            <label for="validate_coupon">Coupon Code</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select bg-transparent" name="coupon_type" id="update_coupon_type" aria-label="Floating label select example">
                                <option value="0">Discount on Total amount</option>
                                <option value="1">Discount on Diamond</option>
                                <option value="2">Discount on Making</option>
                            </select>
                            <label for="update_coupon_type">Coupon Type</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select bg-transparent" name="coupon_for" id="update_coupon_for" aria-label="Floating label select example">
                                <option value="0">All Customers</option>
                                <option value="1">For Specific</option>
                            </select>
                            <label for="update_coupon_for">Coupon For</label>
                        </div>

                        <div class="form-floating d-none mb-3" id="update_customer_mobile_section">
                            <input type="number" class="form-control bg-transparent" name="coupon_for_customer" id="update_coupon_for_customer" placeholder="Mobile No." value="" step="0.01">
                            <label for="update_coupon_for_customer">Customer Mobile No.</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select bg-transparent" name="discount_type" id="update_discount_type" aria-label="Floating label select example">
                                <option value="0">Flat</option>
                                <option value="1">Percentage</option>
                            </select>
                            <label for="update_discount_type">Discount Type</label>
                        </div>

                        <div class="form-floating w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" name="discount" id="update_coupon_discount" placeholder="Discount" value="">
                            <label for="update_coupon_discount">Discount</label>
                        </div>

                        <div class="form-floating w-100 mb-3">
                            <input type="number" class="form-control bg-transparent" name="min_amount" id="update_min_amount" placeholder="On order Above" value="">
                            <label for="min_amount">Order Min Amount</label>
                        </div>
                        <div class="form-floating w-100 mb-3" id="update-up-to-amount-div">
                            <input type="text" class="form-control bg-transparent" name="up_to_amount" id="update_up_to_amount" placeholder="Discount up to" value="">
                            <label for="update_up_to_amount">Discount up to</label>
                        </div>

                        <div class="form-floating w-100 mb-3">
                            <input type="number" class="form-control bg-transparent" name="quantity" id="update_quantity" placeholder="Quantity" value="">
                            <label for="update_quantity">Quantity</label>
                        </div>

                        <div class="form-floating w-100 mb-3">
                            <input type="date" class="form-control bg-transparent" name="expiry_date" id="update_coupon_expiry_date" placeholder="Expiry Date" value="">
                            <label for="update_coupon_expiry_date">Expiry Date</label>
                        </div>

                        <div class="form-floating d-flex w-100 mb-3">
                            <input type="text" class="form-control bg-transparent" name="coupon_note" id="update_coupon_note" placeholder="coupon note" value="">
                            <label for="coupon_note">Coupon Note</label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <label class="form-check-label" for="update_coupon_status">Status</label>
                            <input class="form-check-input" type="checkbox" name="status" role="switch" id="update_coupon_status" checked="">
                        </div>

                        <button type="button" id="update_coupon_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteCouponModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteCouponModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-light text-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteCouponModalLabel">Delete Coupon</h1>
                    <button type="button" class="btn-close bg-white rounded-circle" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="delete_coupon_form" method="post" action="{{url('admin/coupon/delete')}}">
                        @csrf
                        <input type="hidden" name="delete_id" id="delete_id">
                        <div>
                            <p>Are you sure want to delete coupon?</p>
                        </div>
                        <button type="button" id="delete_coupon_btn" class="btn btn-lg fw-bold text-white text-uppercase w-100 rounded-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection
    @section('footer')
    <script>
        var couponListUrl = `{{url('admin/coupon/list')}}`;

        $(document).ready(function() {
            $(document).on('change', '#coupon_for', function() {
                let coupon_for = $(this).val();
                if (coupon_for == 1) {
                    $('#customer_mobile_section').removeClass('d-none');
                } else {
                    $('#customer_mobile_section').addClass('d-none');
                }
            });


            const inputField = document.getElementById("coupon_name");

            inputField.addEventListener("keyup", function(event) {
                event.preventDefault();
                inputField.value = inputField.value.toUpperCase();
            });


            $(document).on('change', '#discount_type', function() {
                let type = $(this).val();
                if (type == 1) {
                    $('#discount-up-to-div').removeClass('d-none');
                } else {
                    $('#discount-up-to-div').addClass('d-none');
                }
            });



        });
    </script>
    @stop