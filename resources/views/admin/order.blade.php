@extends('layouts.admin')
@section('content')
<div class="layout-sidenav-content">
    <div class="p-4 p-md-5">
    <form id="search-order-form" action="#" onsubmit="return:false;">
        <div class="row d-flex align-items-end">
            <div class="col-md-2 col-6 mb-1">
                <label for="from_date">Order ID</label>
                <input class="date form-control bg-transparent" id="admin_order_id" name="admin_order_id" type="text">
            </div>
            <!-- <div class="col-md-2 col-6 mb-1">
                <label for="from_date">Product Name</label>
                <input class="date form-control bg-transparent" id="admin_product_name" name="admin_product_name" type="text">
            </div> -->
            <div class="col-md-2 col-6 mb-1">
                <label for="order_status">Order Status</label>
                <select class="form-select bg-transparent" name="admin_order_status" id="admin_order_status">
                    <option value=''>All</option>
                    <option value='0'>Order Received</option>
                    <option value='1'>Getting It Ready</option>
                    <option value='2'>Shipped</option>
                    <option value='3'>Delivered</option>
                    <option value='-1'>Cancelled</option>
                    <option value='4'>Initiated Return</option>
                    <option value='5'>Returned</option>
                </select>
            </div>
            <div class="col-md-3 col-6 mb-1">
                <label for="from_date">From Date</label>
                <input class="date form-control bg-transparent" id="from_date" type="text">
            </div>
            <div class="col-md-3 col-6 mb-1">
                <label for="to_date">To Date</label>
                <input class="date form-control bg-transparent" id="to_date" type="text">
            </div>
            <div class="col-md-2 col-6 mb-1">
                <button type="button" id="upload-csv-btn" title="Orders Filter" class="btn text-white text-uppercase rounded-5" onClick="submitData();"><i class="fa fa-filter" aria-hidden="true"></i></button>
                <button type="button" id="upload-csv-btn" title="Reset Filter" class="btn text-white text-uppercase rounded-5" onClick="clear_search_val();"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    </div>

    <div class="ps-5 pe-5">
        <div class="col-lg-12">
            <div class="table-responsive" id="order-table">

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

    <script>
        var orderListUrl = `{{url('admin/order/list')}}`;
    </script>
    @endsection
    @section('footer')

    <script>
       
    </script>
    @stop