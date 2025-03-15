@extends('layouts.admin')
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
                    <form id="add_coupon_form" method="post" action="{{url('admin/coupon/add')}}"> 
                        @csrf
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="coupon_name" id="coupon_name" placeholder="coupon" value="">
                            <label for="coupon_name">Coupon Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select bg-transparent" name="discount_type" id="discount_type" aria-label="Floating label select example">
                                <option value="0">Flat</option>
                                <option value="1">Percentage</option>
                            </select>
                            <label for="discount_type">Discount Type</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="discount" id="coupon_discount" placeholder="Discount" value="">
                            <label for="coupon_discount">Discount</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="date" class="form-control bg-transparent" name="expiry_date" id="expiry_date" placeholder="Expiry Date" value="">
                            <label for="expiry_date">Expiry Date</label>
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
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="coupon_name" id="update_coupon_name" placeholder="coupon" value="">
                            <label for="update_coupon_name">coupon Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select bg-transparent" name="discount_type" id="update_discount_type" aria-label="Floating label select example">
                                <option value="0">Flat</option>
                                <option value="1">Percentage</option>
                            </select>
                            <label for="discount_type">Discount Type</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="name" class="form-control bg-transparent" name="discount" id="update_coupon_discount" placeholder="Discount" value="">
                            <label for="coupon_discount">Discount</label>
                        </div>
                        <div class="form-floating w-100 mb-3">
                            <input type="date" class="form-control bg-transparent" name="expiry_date" id="update_coupon_expiry_date" placeholder="Expiry Date" value="">
                            <label for="expiry_date">Expiry Date</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            
                            <input class="form-check-input" type="checkbox" name="status" role="switch" id="update_coupon_status" checked="">
                            <label class="form-check-label" for="update_coupon_status">Status</label>
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

    <script>
        var couponListUrl = `{{url('admin/coupon/list')}}`;
    </script>
    @endsection
    @section('footer')
    @stop